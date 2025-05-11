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
		<?php echo $content; ?>
	</main>

<script src="https://unpkg.com/@phosphor-icons/web"></script>

</body>
</html>
