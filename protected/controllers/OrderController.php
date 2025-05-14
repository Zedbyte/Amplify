<?php

use Stripe\Stripe;
use Stripe\Webhook;

class OrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'postOnly + stripeWebhook',
			'postOnly + emailSent',
		);
	}

	public function beforeAction($action)
	{
		if ($action->id === 'stripeWebhook') {
			Yii::app()->request->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'stripeWebhook', 'emailSent'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'createCheckoutSession', 'success', 'cancel', 'checkoutRedirect'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'approveOrder'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->role == 2',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// Load the order with related models
		$model = Order::model()->with('shipment', 'payment', 'orderItems.product')->findByPk($id);

		if (!$model) {
			throw new CHttpException(404, 'Order not found.');
		}

		// Prepare order item details
		$products = [];
		foreach ($model->orderItems as $item) {
			$products[] = [
				'product_id' => $item->product_id,
				'name'       => $item->product->name ?? 'N/A',
				'price'      => $item->price,
				'quantity'   => $item->quantity,
				'subtotal'   => $item->price * $item->quantity,
			];
		}

		$this->render('view', [
			'order'         => $model,
			'shipment'      => $model->shipment,
			'payment'       => $model->payment,
			'products'      => $products,
			'paymentIntent' => $model->reference_id, // Pass as string, not Stripe object
		]);
	}



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->status = 0;

		if ($model->save(false)) { // Skip validation if not needed
			// Optionally log the soft-delete
			Yii::log("Soft-deleted product ID $id", CLogger::LEVEL_INFO);
		} else {
			Yii::log("Failed to soft-delete product ID $id", CLogger::LEVEL_ERROR);
		}

		if (!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$userId = Yii::app()->user->id;
		$userRole = Yii::app()->user->role; // assuming 'role' is available via Yii::app()->user

		$criteria = new CDbCriteria();
		$criteria->order = 'created_at DESC';

		// 🚫 Only apply customer filtering if not admin
		if ($userRole != 2) {
			$customer = Customer::model()->findByAttributes(['user_id' => $userId]);

			if (!$customer) {
				throw new CHttpException(403, 'You are not authorized to view orders.');
			}

			$criteria->compare('customer_id', $customer->id);
		}

		// 🔍 Filter by status
		$filter = $_GET['filter'] ?? 'pending';

		switch ($filter) {
			case 'shipped':
				$criteria->compare('status', 2);
				break;
			case 'accepted':
				$criteria->compare('status', 1);
				break;
			case 'pending':
				$criteria->compare('status', 0);
				break;
			case 'all':
			default:
				// No status filter
				break;
		}

		$dataProvider = new CActiveDataProvider('Order', [
			'criteria' => $criteria,
			'pagination' => ['pageSize' => 10],
		]);

		$this->render('index', ['dataProvider' => $dataProvider]);
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Function to create a Stripe Checkout session
	 */
	public function actionCreateCheckoutSession($orderId)
	{
		$order = Order::model()->findByPk($orderId);
		if (!$order) {
			throw new CHttpException(404, 'Order not found.');
		}

		try {
			$session = StripeService::createCheckoutSession($order);
			Yii::log("Stripe Checkout Session created: " . $session->url, CLogger::LEVEL_INFO);
			$this->redirect($session->url);
		} catch (Exception $e) {
			Yii::log("Stripe Error: " . $e->getMessage(), CLogger::LEVEL_ERROR);
			Yii::app()->user->setFlash('error', 'Stripe checkout failed.');
			$this->redirect(['order/view', 'id' => $order->id]);
		}
	}


	//Bypass AJAX (due to CLIst) CORS Error in order/_view.php checkout button 
	public function actionCheckoutRedirect($orderId)
	{
		if (Yii::app()->request->isAjaxRequest) {
			// Force redirect via JS
			echo CJSON::encode(['url' => $this->createUrl('order/createCheckoutSession', ['orderId' => $orderId])]);
			Yii::app()->end();
		}

		// Normal redirect
		$this->redirect(['order/createCheckoutSession', 'orderId' => $orderId]);
	}

	/**
	 * After the payment process in Stripe.
	 */
	public function actionSuccess($order_id, $session_id = null)
	{
		require_once dirname(Yii::app()->basePath) . '/vendor/autoload.php';
		\Stripe\Stripe::setApiKey(Yii::app()->params['stripe.secretKey']);

		$stripeSession = null;
		$stripePaymentIntent = null;

		if ($session_id) {
			try {
				$stripeSession = \Stripe\Checkout\Session::retrieve($session_id);
				if (isset($stripeSession->payment_intent)) {
					$stripePaymentIntent = \Stripe\PaymentIntent::retrieve($stripeSession->payment_intent);
				}
			} catch (Exception $e) {
				Yii::log('Stripe error during session lookup: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
			}
		}


		$userId = Yii::app()->user->id;

		// Step 1: Get the customer associated with the current user
		$customer = Customer::model()->findByAttributes(['user_id' => $userId]);
		if (!$customer) {
			throw new CHttpException(403, 'Customer not found.');
		}

		// Step 2: Load the order (with eager loading for shipment, payment, and items)
		$order = Order::model()->with('shipment', 'payment', 'orderItems.product')->findByPk($order_id);

		// Step 3: Validate ownership and status
		if (!$order || $order->customer_id != $customer->id || $order->status != 1) {
			throw new CHttpException(403, 'Access denied or invalid order. Order ID: ' . $order_id . 'Order Status: ' . $order->status);
		}

		// Step 4: Collect associated data
		$order->reference_id = $stripePaymentIntent->id;
		if ($order->save(false)) {
			Yii::log('Order reference_id set to: ' . $order->reference_id, CLogger::LEVEL_INFO);
		}
		$shipment = $order->shipment;  // via relation
		$payment  = $order->payment;   // via relation
		$items    = $order->orderItems; // via relation
		$products = [];

		foreach ($items as $item) {
			$products[] = [
				'product_id' => $item->product_id,
				'name'       => $item->product->name ?? 'N/A',
				'price'      => $item->price,
				'quantity'   => $item->quantity,
				'subtotal'   => $item->price * $item->quantity,
			];
		}

		// Step 5: Pass everything to the success view
		$this->render('success', [
			'order'    => $order,
			'shipment' => $shipment,
			'payment'  => $payment,
			'products' => $products,
			'paymentIntent' => $stripePaymentIntent,
		]);
	}

	
	public function actionCancel()
	{
		Yii::app()->user->setFlash('error', 'Payment was cancelled.');
		Yii::log('Payment was cancelled.', CLogger::LEVEL_WARNING);
		$this->render('cancel');
	}


	/**
	 * 
	 * Webhook Configuration to send Email to LateNode (Stripe Local CLI)
	 * 
	 */
	// public function actionStripeWebhook()
	// {	

	// 	$autoloadPath = dirname(Yii::app()->basePath) . '/vendor/autoload.php';
    //     if (file_exists($autoloadPath)) {
    //         require_once($autoloadPath);
    //     } else {
    //         throw new CHttpException(500, 'Stripe SDK not found. Please run composer install.');
    //     }

	// 	$payload = @file_get_contents('php://input');
	// 	$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? null;
	// 	$secret = Yii::app()->params['stripe.webhookSecret'];
	
	// 	Yii::log("Stripe Webhook Hit", CLogger::LEVEL_INFO);
	// 	Yii::log("Payload: $payload", CLogger::LEVEL_INFO);
	
	// 	try {
	// 		Stripe::setApiKey(Yii::app()->params['stripe.secretKey']);
	
	// 		if (!$sigHeader) {
	// 			throw new Exception('Missing Stripe Signature header.');
	// 		}
	
	// 		$event = Webhook::constructEvent($payload, $sigHeader, $secret);
	
	// 		Yii::log("Webhook Type: " . $event->type, CLogger::LEVEL_INFO);
	
	// 		if ($event->type === 'checkout.session.completed') {
	// 			$session = $event->data->object;
	// 			$orderId = $session->metadata->order_id ?? null;
	
	// 			Yii::log("Session Order ID: $orderId", CLogger::LEVEL_INFO);
	
	// 			if ($orderId) {
	// 				$order = Order::model()->findByPk($orderId);
	// 				if ($order) {
	// 					$order->status = 1;
	// 					$order->updated_at = new CDbExpression('NOW()');
	// 					$order->save();
	
	// 					Yii::log("Order #$orderId marked as paid.", CLogger::LEVEL_INFO);
	
	// 					LateNodeService::sendOrderConfirmation($order);
	// 				} else {
	// 					throw new Exception("Order not found: $orderId");
	// 				}
	// 			} else {
	// 				throw new Exception("Missing order_id in session metadata.");
	// 			}
	// 		}
	
	// 		http_response_code(200);
	// 	} catch (Exception $e) {
	// 		Yii::log("Stripe Webhook error: " . $e->getMessage(), CLogger::LEVEL_ERROR);
	// 		http_response_code(400);
	// 	}
	// }
	

	/**
	 * Webhook to handle Stripe events (Ngrok)
	 */
	public function actionStripeWebhook()
	{	
		Yii::log("Stripe Webhook Hit", CLogger::LEVEL_INFO);
		$rawInput = file_get_contents('php://input');
		Yii::log("Stripe Webhook Raw Input: " . $rawInput, CLogger::LEVEL_INFO);

		// fallback for debugging
		if (empty($rawInput)) {
			$rawInput = json_encode($_POST); // fallback in case it's form-data
			Yii::log("Using fallback \$_POST: " . print_r($_POST, true), CLogger::LEVEL_INFO);
		}
	
		$data = json_decode($rawInput, true);
		Yii::log("Decoded Webhook Data: " . print_r($data, true), CLogger::LEVEL_INFO);
	
		$orderId = $data['order_id'] ?? null;
		$status = $data['payment_status'] ?? null;
	
		Yii::log("Order ID: $orderId | Payment Status: $status", CLogger::LEVEL_INFO);
	
		if ($orderId && $status === 'paid') {
        	$order = Order::model()->findByPk($orderId);
			if (!$order) {
				Yii::log("Order not found: $orderId", CLogger::LEVEL_ERROR);
			} else {
				// Use helper methods
				$payment = OrderHelper::createPayment($order);
				$shipment = OrderHelper::createShipment($order);

				if ($payment && $shipment) {
					Yii::log("Order #$orderId marked as paid. Payment and shipment created.", CLogger::LEVEL_INFO);

					// Update order status
					$orderItems = OrderItem::model()->with('product')->findAllByAttributes(['order_id' => $order->id]);

					$productDetails = [];
					foreach ($orderItems as $item) {
						$productDetails[] = [
							'product_id'   => $item->product_id,
							'name'         => $item->product->name ?? 'Unknown',
							'quantity'     => $item->quantity,
							'price'        => $item->price,
							'total'        => $item->price * $item->quantity,
						];
					}

					$productHTML = $this->renderProductHTML($productDetails);
					
					Yii::log("Product Details: " . CJSON::encode([
						'status' => 'success',
						'order_id' => $order->id,
						'products' => $productDetails,
						'productHTML' => $productHTML,
					]), CLogger::LEVEL_INFO);


					echo CJSON::encode([
						'status' => 'success',
						'order_id' => $order->id,
						'products' => $productDetails,
						'productHTML' => $productHTML,
					]);

					Yii::app()->end();
				} else {
					Yii::log("Failed to create payment or shipment for Order #$orderId", CLogger::LEVEL_ERROR);
				}
			}
		} else {
			Yii::log("Invalid webhook payload: Order ID: $orderId | Status: $status", CLogger::LEVEL_ERROR);
		}

	
		Yii::log("Stripe Webhook processing failed.", CLogger::LEVEL_WARNING);
		Yii::app()->user->setFlash('error', 'Stripe Webhook processing failed.');
		echo CJSON::encode(['status' => 'failed']);
		Yii::app()->end();
	}


	/**
	 * Webhook to handle Email Sent
	 */
	public function actionEmailSent()
	{
		if (Yii::app()->request->isPostRequest) {
			$emailStatus = Yii::app()->request->getPost('email_status');
			$orderId = Yii::app()->request->getPost('order_id');

			if ($emailStatus === 'SENT' && $orderId) {
				$order = Order::model()->findByPk((int)$orderId);

				if (!$order) {
					throw new CHttpException(404, 'Order not found.');
				}

				// Update order status to 2 (shipped)
				// $order->status = 2;

				if ($order->save(false)) {
					// Update related shipment (if exists)
					if ($order->shipment_id) {
						$shipment = Shipment::model()->findByPk($order->shipment_id);
						if ($shipment) {
							//$shipment->status = 1; // in transit
							$shipment->save(false);
						}
					}

					echo CJSON::encode(['success' => true, 'message' => 'Status updated.']);
					Yii::app()->end();
				} else {
					echo CJSON::encode(['success' => false, 'message' => 'Failed to update order.']);
					Yii::app()->end();
				}
			}
		}

		throw new CHttpException(400, 'Invalid request.');
	}

	private function renderProductHTML($products)
	{
		$html = '';
		foreach ($products as $product) {
			$html .= '
			<div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee;">
				<div>
					<p style="margin: 0; font-weight: 600;">' . htmlspecialchars($product['name']) . '</p>
					<p style="margin: 0; color: #666;">Qty: ' . $product['quantity'] . '</p>
				</div>
				<div style="font-weight: 600;">₱' . number_format($product['price'], 2) . '</div>
			</div>';
		}
		return $html;
	}

	/**
	 * 
	 * Approve Order (Update to Shipped)
	 * 
	 */
	public function actionApproveOrder($id)
	{
		$order = Order::model()->findByPk($id);

		if ($order === null || $order->status != 1) {
			throw new CHttpException(404, 'Order is either null or not paid.');
		}

		if ($order->status == 1) { // Accepted/Paid
			$order->status = 2; // Shipped
			if ($order->save()) {
				Yii::app()->user->setFlash('success', 'Order approved and marked as shipped.');
			}
		}

		$this->redirect(['order/view', 'id' => $id]);
	}
}
