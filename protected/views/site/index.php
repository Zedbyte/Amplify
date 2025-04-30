<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="https://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="https://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p> -->

<section class="bg-black rounded-3xl p-8 md:p-16 flex flex-col md:flex-row items-center justify-between overflow-hidden w-9/12 mx-auto mt-6">
	<!-- Text Content -->
	<div class="text-white max-w-lg">
		<h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
		Buy your<br>
		<span class="text-white">dream guitar</span>
		</h1>
		<div class="flex space-x-8 mt-8 text-lg">
		<div class="flex flex-col items-start">
			<span class="font-bold text-2xl">50+</span>
			<span class="text-gray-400 text-sm">Guitar selections</span>
		</div>
		<div class="border-l border-gray-600 h-full"></div>
		<div class="flex flex-col items-start">
			<span class="font-bold text-2xl">100+</span>
			<span class="text-gray-400 text-sm">Buyers</span>
		</div>
		</div>

		<!-- Search Box -->
		<div class="mt-8">
		<div class="relative">
			<input type="text" placeholder="What are you looking for?" class="w-full rounded-lg px-3 py-4 text-black focus:outline-none bg-white" />
			<button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black text-white py-2 px-3 rounded-md hover:bg-gray-800">
				<i class="ph ph-magnifying-glass text-2xl"></i>
			</button>
		</div>
		</div>
	</div>

	<!-- Guitar and Circle -->
	<div class="relative w-full md:w-auto flex justify-end mt-8 md:mt-0">
    	<!-- Circle Background -->
    	<div class="absolute bottom-0 right-0 w-[600px] h-[500px] bg-stone-800 rounded-t-full rounded-l-full translate-x-1/20 translate-y-1/4"></div>
    
    	<!-- Guitar Image -->
    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png" alt="Guitar" class="relative z-10 w-80 md:w-[450px] object-contain" />
    </div>
</section>

<section class="py-16 bg-white">
	<div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-10 gap-8 items-center">
		
		<!-- Left Column (30%) -->
		<div class="md:col-span-3">
			<h2 class="text-3xl md:text-4xl font-extrabold mb-4">
				Best Selling<br>Guitars
			</h2>
			<p class="text-gray-600 mb-6">
				Check our different guitar styles!
			</p>
			<a href="#" class="inline-flex items-center px-6 py-3 bg-black text-white rounded-full hover:bg-gray-800">
				See more
				<i class="ph ph-arrow-right ml-2"></i>
			</a>
		</div>

		<!-- Right Column (70%) -->
		<div class="md:col-span-7 grid grid-cols-3 gap-6">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png" alt="Guitar 1" class="object-contain w-full" />
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png" alt="Guitar 2" class="object-contain w-full" />
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png" alt="Guitar 3" class="object-contain w-full" />
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png" alt="Guitar 4" class="object-contain w-full" />
		</div>

	</div>
</section>
