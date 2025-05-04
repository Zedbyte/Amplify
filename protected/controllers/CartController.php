<?php

class CartController extends Controller
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
				'actions'=>array('index','view', 'add', 'mycart', 'delete', 'updateQuantity'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'checkout', 'createCheckoutSession'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new Cart;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
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

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
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
		if (Yii::app()->user->isGuest) {
			// Handle guest cart deletion from session
			$sessionCart = Yii::app()->session['cart'] ?? [];

			// Find product ID key that matches the session cart item
			if (array_key_exists($id, $sessionCart)) {
				unset($sessionCart[$id]);
				Yii::app()->session['cart'] = $sessionCart;
			}

		} else {
			// Authenticated user - delete from DB
			$model = $this->loadModel($id);

			// Ensure the cart belongs to the current user
			if ($model->customer_id == Yii::app()->user->id) {
				$model->delete();
			} else {
				throw new CHttpException(403, 'Unauthorized deletion attempt.');
			}
		}

		// If not AJAX, redirect
		if (!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['myCart']);
		}
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cart');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cart('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cart']))
			$model->attributes=$_GET['Cart'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cart the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cart::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cart $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	/**
	 * Function to handle adding items to the cart
	 */
	public function actionAdd()
	{
		$productId = (int)$_POST['product_id'];
		$quantity = (int)$_POST['quantity'];

		if (!$productId || $quantity < 1) {
			Yii::app()->user->setFlash('error', 'Invalid product or quantity.');
			$this->redirect(['product/index']);
			return;
		}

		$product = Product::model()->findByPk($productId);
		if (!$product) {
			Yii::app()->user->setFlash('error', 'Product not found.');
			$this->redirect(['product/index']);
			return;
		}

		if (Yii::app()->user->isGuest) {
			$cart = Yii::app()->session['cart'] ?? [];
			$existingQty = $cart[$productId] ?? 0;

			if (!CartHelper::isQuantityAvailable($productId, $quantity, $existingQty)) {
				Yii::app()->user->setFlash('error', 'Quantity exceeds available stock.');
			} else {
				$cart[$productId] = $existingQty + $quantity;
				Yii::app()->session['cart'] = $cart;
				Yii::app()->user->setFlash('success', 'Product added to cart (guest).');
			}

		} else {
			$userId = Yii::app()->user->id;
			$existingCart = Cart::model()->findByAttributes([
				'customer_id' => $userId,
				'product_id' => $productId,
			]);
			$existingQty = $existingCart ? $existingCart->quantity : 0;

			if (!CartHelper::isQuantityAvailable($productId, $quantity, $existingQty)) {
				Yii::app()->user->setFlash('error', 'Quantity exceeds available stock.');
			} else {
				if ($existingCart) {
					$existingCart->quantity += $quantity;
					$existingCart->updated_at = new CDbExpression('NOW()');
					$existingCart->save();
					Yii::app()->user->setFlash('success', 'Cart updated.');
				} else {
					$cart = new Cart();
					$cart->customer_id = $userId;
					$cart->product_id = $productId;
					$cart->quantity = $quantity;
					$cart->created_at = new CDbExpression('NOW()');
					$cart->updated_at = new CDbExpression('NOW()');
					$cart->save();
					Yii::app()->user->setFlash('success', 'Product added to cart.');
				}
			}
		}

		$this->redirect(['product/index']);
	}


	
	/**
	 * Displays the user's cart.
	 */
	public function actionMyCart()
	{
		$subtotal = 0;
		$deliveryFee = 700;

		if (!Yii::app()->user->isGuest) {
			$criteria = new CDbCriteria();
			$criteria->compare('customer_id', Yii::app()->user->id);

			$cartItems = Cart::model()->findAll($criteria);

			foreach ($cartItems as $item) {
				$product = Product::model()->findByPk($item->product_id);
				if ($product) {
					$subtotal += $product->price * $item->quantity;
				}
			}

			$dataProvider = new CActiveDataProvider('Cart', [
				'criteria' => $criteria,
				'pagination' => ['pageSize' => 10],
			]);

			$this->render('myCart', [
				'dataProvider' => $dataProvider,
				'guestCart' => null,
				'subtotal' => $subtotal,
				'deliveryFee' => $deliveryFee,
			]);
			return;
		}

		// Guest cart handling
		$sessionCart = Yii::app()->session['cart'] ?? [];

		if (empty($sessionCart)) {
			$this->render('myCart', [
				'dataProvider' => null,
				'guestCart' => null,
				'subtotal' => 0,
				'deliveryFee' => $deliveryFee,
			]);
			return;
		}

		$productIds = array_keys($sessionCart);
		$products = Product::model()->findAllByPk($productIds);

		foreach ($products as $product) {
			$qty = $sessionCart[$product->id] ?? 1;
			$subtotal += $product->price * $qty;
		}

		$this->render('myCart', [
			'dataProvider' => null,
			'guestCart' => $products,
			'quantities' => $sessionCart,
			'subtotal' => $subtotal,
			'deliveryFee' => $deliveryFee,
		]);
	}


	/**
	 * Updates the quantity of a product in the cart.
	 */
	public function actionUpdateQuantity()
	{
		if (!Yii::app()->request->isPostRequest) {
			throw new CHttpException(400, 'Invalid request.');
		}
	
		$data = json_decode(file_get_contents('php://input'), true);
	
		$productId = (int)($data['product_id'] ?? 0);
		$quantity = (int)($data['quantity'] ?? 1);
		$cartId   = (int)($data['cart_id'] ?? 0);
	
		if (!$productId || $quantity < 1) {
			echo CJSON::encode(['status' => 'error', 'message' => 'Invalid input']);
			Yii::app()->end();
		}
	
		$product = Product::model()->findByPk($productId);
		if (!$product) {
			echo CJSON::encode(['status' => 'error', 'message' => 'Product not found']);
			Yii::app()->end();
		}
	
		if (!Yii::app()->user->isGuest) {
			$cart = Cart::model()->findByPk($cartId);
			if (!$cart || $cart->customer_id != Yii::app()->user->id) {
				echo CJSON::encode(['status' => 'error', 'message' => 'Unauthorized']);
				Yii::app()->end();
			}
	
			if (!CartHelper::isQuantityAvailable($productId, $quantity)) {
				echo CJSON::encode(['status' => 'error', 'message' => 'Exceeds stock']);
				Yii::app()->end();
			}
	
			$cart->quantity = $quantity;
			$cart->updated_at = new CDbExpression('NOW()');
			$cart->save();
	
		} else {
			$cart = Yii::app()->session['cart'] ?? [];
	
			if (isset($cart[$productId])) {
				if (!CartHelper::isQuantityAvailable($productId, $quantity)) {
					$quantity = $product->stock; // fallback to max allowed
				}
				$cart[$productId] = $quantity;
				Yii::app()->session['cart'] = $cart;
			}
		}
	
		echo CJSON::encode(['status' => 'success']);
		Yii::app()->end();
	}


	/**
	 * 
	 * Fucntion to checkout the cart
	 * 
	 */

	public function actionCheckout()
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect(['site/login']);
			return;
		}
	
		$customerId = Yii::app()->user->id;
		$cartItems = Cart::model()->findAllByAttributes(['customer_id' => $customerId]);
		if (empty($cartItems)) {
			Yii::app()->user->setFlash('error', 'Your cart is empty.');
			$this->redirect(['cart/myCart']);
			return;
		}
	
		$subtotal = 0;
		$deliveryFee = 700;
		$orderItems = [];
	
		foreach ($cartItems as $item) {
			$product = Product::model()->findByPk($item->product_id);
			if (!$product || $item->quantity > $product->stock) {
				Yii::app()->user->setFlash('error', 'Product unavailable or stock insufficient.');
				$this->redirect(['cart/myCart']);
				return;
			}
	
			$price = $product->price;
			$subtotal += $price * $item->quantity;
	
			$orderItems[] = [
				'product_id' => $product->id,
				'quantity' => $item->quantity,
				'price' => $price,
			];
		}
		
		$total = $subtotal + $deliveryFee;
	
		// Create Order
		$order = new Order();
		$order->customer_id = $customerId;
		$order->order_date = new CDbExpression('NOW()');
		$order->total_price = $total;
		$order->status = 0;
		$order->is_received = 0; // false
		$order->payment_id = 1;
		$order->shipment_id = 1;
		$order->created_at = new CDbExpression('NOW()');
		$order->updated_at = new CDbExpression('NOW()');
		if ($order->save()) {
			foreach ($orderItems as $itemData) {
				$orderItem = new OrderItem();
				$orderItem->order_id = $order->id;
				$orderItem->product_id = $itemData['product_id'];
				$orderItem->quantity = $itemData['quantity'];
				$orderItem->price = $itemData['price'];
				$orderItem->status = 0;
				$orderItem->created_at = new CDbExpression('NOW()');
				$orderItem->updated_at = new CDbExpression('NOW()');
				if (!$orderItem->save()) {
					Yii::app()->user->setFlash('error', 'Failed to save an order item.');
					$order->delete(); // Rollback
					$this->redirect(['cart/myCart']);
					return;
				}
			}
	
			// Clear cart
			Cart::model()->deleteAllByAttributes(['customer_id' => $customerId]);
	
			// Redirect to order view or Stripe checkout
			$this->redirect(['order/createCheckoutSession', 'orderId' => $order->id]);
		} else {
			Yii::app()->user->setFlash('error', 'Failed to create order.');
			$this->redirect(['cart/myCart']);
		}
	}
	

}
