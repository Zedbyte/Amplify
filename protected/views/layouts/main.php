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

	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen">
	<?php $this->widget('application.widgets.Navbar'); ?>
	<?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
		<div 
			x-data="{ show: true }" 
			x-show="show" 
			x-init="setTimeout(() => show = false, 4000)" 
			x-transition
			class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 px-5 py-3 rounded-lg shadow-lg text-sm font-medium flex items-center gap-2
				<?php echo $key === 'success' ? 'bg-green-100 text-green-800' : ''; ?>
				<?php echo $key === 'error' ? 'bg-red-100 text-red-800' : ''; ?>
				<?php echo $key === 'info' ? 'bg-blue-100 text-blue-800' : ''; ?>
				<?php echo $key === 'warning' ? 'bg-yellow-100 text-yellow-800' : ''; ?>"
		>
			<?php
				// Choose icon based on the key
				$icon = match($key) {
					'success' => 'check-circle',
					'error' => 'warning-circle',
					'info' => 'info',
					'warning' => 'warning',
					default => 'bell',
				};
			?>
			<i class="ph ph-<?php echo $icon; ?> text-lg"></i>
			<?php echo CHtml::encode($message); ?>
		</div>
	<?php endforeach; ?>


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
