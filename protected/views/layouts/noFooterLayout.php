<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/output.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet">

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png" type="image/x-icon">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="flex flex-col min-h-screen">

	<!-- Main Content -->
	<main class="flex-1">
		<?php echo $content; ?>
	</main>

<script src="https://unpkg.com/@phosphor-icons/web"></script>

</body>
</html>
