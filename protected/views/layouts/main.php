<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"> -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"> -->

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/output.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet">

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png" type="image/x-icon">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="flex flex-col min-h-screen">
	<?php $this->widget('application.widgets.Navbar'); ?>

	<!-- <div id="mainmenu"> -->
		<?php //$this->widget('zii.widgets.CMenu',array(
			// 'items'=>array(
			// 	array('label'=>'Home', 'url'=>array('/site/index')),
			// 	array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			// 	array('label'=>'Contact', 'url'=>array('/site/contact')),
			// 	array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			// 	array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			// ),
		//)); ?>
	</div><!-- mainmenu -->
	<?php //if(isset($this->breadcrumbs)):?>
		<?php //$this->widget('zii.widgets.CBreadcrumbs', array(
			//'links'=>$this->breadcrumbs,
		//)); ?><!-- breadcrumbs -->
	<?php //endif?>

	<!-- Main Content -->
	<main class="flex-1">
		<?php echo $content; ?>
	</main>

	<!-- Footer -->
	<?php $this->widget('application.widgets.Footer'); ?>


<script src="https://unpkg.com/@phosphor-icons/web"></script>

</body>
</html>
