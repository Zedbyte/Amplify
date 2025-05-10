<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$rows = Yii::app()->db->createCommand()
		->select('product_id, SUM(quantity) as total_sold')
		->from('tbl_order_item')
		->group('product_id')
		->order('total_sold DESC')
		->limit(4)
		->queryAll();
	
	
		$bestSellingProducts = [];
		foreach ($rows as $row) {
			$product = Product::model()->findByPk($row['product_id']);
			// var_dump($product);exit;
			if ($product) {
				$product->total_sold = $row['total_sold'];
				$bestSellingProducts[] = $product;
			}
		}
		
	
		$this->render('index', [
			'bestSellingProducts' => $bestSellingProducts,
		]);
	}



	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{	
		// Set the layout for the login page (No Footer)
		$this->layout = '//layouts/noFooterLayout';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				MigrateSessionCart::migrateGuestCartToUser();
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	/**
	 * Displays the registration page
	 * @return void
	 */
	public function actionRegister()
	{

		// Set the layout for the login page (No Footer)
		$this->layout = '//layouts/noFooterLayout';

		$model = new RegisterForm();
		if (isset($_POST['RegisterForm'])) {
			$model->attributes = $_POST['RegisterForm'];
			if ($model->register()) {
				Yii::app()->user->setFlash('success', 'Registration successful. You can now login.');
				$this->redirect(array('site/login'));
			}
		}

		$this->render('register', ['model' => $model]);
	}


	/**
	 * Displays the registration page for admin
	 * @return void
	 */
	public function actionRegisterAdmin()
	{
		// Check if the current user is logged in and is an admin (role 2)
		if (Yii::app()->user->isGuest || Yii::app()->user->role != 2) {
			throw new CHttpException(403, 'You are not authorized to access this page.');
		}
	
		$model = new RegisterAdminForm();
	
		if (isset($_POST['RegisterAdminForm'])) {
			$model->attributes = $_POST['RegisterAdminForm'];
			if ($model->register()) {
				Yii::app()->user->setFlash('success', 'Admin account created.');
				$this->redirect(array('site/login'));
			}
		}
	
		$this->render('registerAdmin', ['model' => $model]);
	}
	
	/**
	 * Displays the admin dashboard
	 */
	public function actionAdminDashboard()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role != 2) {
			throw new CHttpException(403, 'You are not authorized to access this page.');
		}

		$this->render('adminDashboard');
	}
}