<?php

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
		);
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'createCheckoutSession', 'success', 'cancel', 'stripeWebhook'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
			$this->redirect($session->url);
		} catch (Exception $e) {
			Yii::log("Stripe Error: " . $e->getMessage(), CLogger::LEVEL_ERROR);
			Yii::app()->user->setFlash('error', 'Stripe checkout failed.');
			$this->redirect(['order/view', 'id' => $order->id]);
		}
	}

	/**
	 * After the payment process in Stripe.
	 */
	public function actionSuccess()
	{
		Yii::app()->user->setFlash('success', 'Payment successful!');
		var_dump("Payment successful! Create a View Page for this. ");exit;
		$this->render('success');
	}

	
	public function actionCancel()
	{
		Yii::app()->user->setFlash('error', 'Payment was cancelled.');
		var_dump("Payment failed! Create a View Page for this. ");exit;
		$this->render('cancel');
	}


	/**
	 * 
	 * Webhook Configuration to send Email to LateNode
	 * 
	 */

	public function actionStripeWebhook()
	{
		$payload = @file_get_contents("php://input");
		$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
		$secret = Yii::app()->params['stripe.webhookSecret']; // set in config

		require_once(dirname(Yii::app()->basePath) . '/../vendor/autoload.php');

		try {
			$event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $secret);
		} catch(\UnexpectedValueException $e) {
			// Invalid payload
			http_response_code(400);
			exit();
		} catch(\Stripe\Exception\SignatureVerificationException $e) {
			// Invalid signature
			http_response_code(400);
			exit();
		}

		// Handle the event
		if ($event->type === 'checkout.session.completed') {
			$session = $event->data->object;

			$orderId = $session->metadata->order_id;
			$order = Order::model()->findByPk($orderId);

			if ($order) {
				$order->status = 1; // paid
				$order->updated_at = new CDbExpression('NOW()');
				$order->save(false);

				// Send email via LateNode
				$email = $order->customer->email; // assumes relation
				$message = "Hi, your payment was successful. Your order #{$order->id} is now being processed.";
				LateNodeService::sendEmail($email, 'Payment Successful', $message);
			}
		}

		http_response_code(200);
	}
}
