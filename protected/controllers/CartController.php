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
				'actions'=>array('create','update'),
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

		$stockAvailable = (int)$product->stock;

		if (Yii::app()->user->isGuest) {
			$cart = Yii::app()->session['cart'] ?? [];
			$existingQty = $cart[$productId] ?? 0;
			$newTotal = $existingQty + $quantity;

			if ($newTotal > $stockAvailable) {
				Yii::app()->user->setFlash('error', 'Quantity exceeds available stock.');
			} else {
				$cart[$productId] = $newTotal;
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
			$newTotal = $existingQty + $quantity;

			if ($newTotal > $stockAvailable) {
				Yii::app()->user->setFlash('error', 'Quantity exceeds available stock.');
			} else {
				if ($existingCart) {
					$existingCart->quantity = $newTotal;
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
		if (!Yii::app()->user->isGuest) {
			$criteria = new CDbCriteria();
			$criteria->compare('customer_id', Yii::app()->user->id);

			$dataProvider = new CActiveDataProvider('Cart', [
				'criteria' => $criteria,
				'pagination' => ['pageSize' => 10],
			]);

			$this->render('myCart', ['dataProvider' => $dataProvider, 'guestCart' => null]);
			return;
		}

		// Guest cart handling
		$sessionCart = Yii::app()->session['cart'] ?? [];

		if (empty($sessionCart)) {
			$this->render('myCart', ['dataProvider' => null, 'guestCart' => null]);
			return;
		}

		$productIds = array_keys($sessionCart);
		$products = Product::model()->findAllByPk($productIds);

		$this->render('myCart', ['dataProvider' => null, 'guestCart' => $products, 'quantities' => $sessionCart]);
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

		if (!Yii::app()->user->isGuest) {
			$cart = Cart::model()->findByPk($cartId);
			if (!$cart || $cart->customer_id != Yii::app()->user->id) {
				echo CJSON::encode(['status' => 'error', 'message' => 'Unauthorized']);
				Yii::app()->end();
			}

			$product = Product::model()->findByPk($productId);
			if ($quantity > $product->stock) {
				echo CJSON::encode(['status' => 'error', 'message' => 'Exceeds stock']);
				Yii::app()->end();
			}

			$cart->quantity = $quantity;
			$cart->updated_at = new CDbExpression('NOW()');
			$cart->save();

		} else {
			// Guest cart (session)
			$cart = Yii::app()->session['cart'] ?? [];
			if (isset($cart[$productId])) {
				$product = Product::model()->findByPk($productId);
				$cart[$productId] = min($quantity, $product->stock);
				Yii::app()->session['cart'] = $cart;
			}
		}

		echo CJSON::encode(['status' => 'success']);
		Yii::app()->end();
	}

}
