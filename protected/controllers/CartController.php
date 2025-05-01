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
				'actions'=>array('index','view', 'add', 'mycart'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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

		// Validate basic input
		if (!$productId || $quantity < 1) {
			Yii::app()->user->setFlash('error', 'Invalid product or quantity.');
			$this->redirect(['product/index']);
			return;
		}

		if (Yii::app()->user->isGuest) {
			// Store in session cart for guest
			$cart = Yii::app()->session['cart'] ?? [];

			if (isset($cart[$productId])) {
				$cart[$productId] += $quantity;
			} else {
				$cart[$productId] = $quantity;
			}

			Yii::app()->session['cart'] = $cart;
			Yii::app()->user->setFlash('success', 'Product added to cart (guest).');
		} else {
			// Authenticated user: store in DB
			$userId = Yii::app()->user->id;

			$existingCart = Cart::model()->findByAttributes([
				'customer_id' => $userId,
				'product_id' => $productId,
			]);

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

		$this->redirect(['product/index']); // or go back to product/view
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


}
