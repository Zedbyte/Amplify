<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>

<div class="max-w-6xl mx-auto px-4 py-10 font-sans">

    <!-- What is amplify? -->
    <div class="flex flex-col md:flex-row items-center gap-8 py-16">
        <div class="flex-1 space-y-4">
            <h1 class="text-4xl font-bold text-gray-900">What is amplify?</h1>
            <p class="text-gray-700">We provide high-quality instruments and gear, making it easier for musicians of all levels to create, perform, and inspire.</p>
            <p class="text-gray-700">With Amplify, you don't just buy music equipment—you become part of a community that fuels passion and creativity.</p>
        </div>
        <div class="flex-1">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/record_player.png" alt="Record Player" class="rounded-lg shadow-lg w-full max-w-md mx-auto">
        </div>
    </div>

    <!-- Why amplify -->
    <div class="text-center py-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Why 'amplify'?</h2>
        <p class="text-gray-700 max-w-3xl mx-auto">Amplify isn't just about making music louder—it's about expanding creativity, passion, and expression. Music has the power to inspire and connect, and just like an amplifier boosts sound, we aim to elevate every musician’s journey.</p>
    </div>

    <!-- Our Story -->
    <div class="flex flex-col md:flex-row items-center gap-8 py-16">
        <div class="flex-1 space-y-4">
            <h2 class="text-3xl font-bold text-gray-900">Our Story</h2>
            <p class="text-gray-700"><strong>Amplify</strong> started as a late-night idea between three friends — <strong>Mark, Kenneth, and Andreas</strong> — who shared one big frustration: finding quality, affordable instruments was way too hard.</p>
            <p class="text-gray-700">After a jam session in a small practice room, they realized they weren’t alone. Musicians everywhere faced the same struggles. So they teamed up — blending business insight, hands-on craftsmanship, and technical know-how — to create something better.</p>
            <p class="text-gray-700 font-semibold">What began with a few instruments and local feedback quickly grew into Amplify: not just a store, but a space to support creativity, community, and musicianship.</p>
        </div>
        <div class="flex-1">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register_banner.png" alt="Band Photo" class="rounded-lg shadow-lg w-full max-w-md mx-auto">
        </div>
    </div>

    <!-- Meet the Band -->
    <div class="text-center py-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Meet the Band</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
            <!-- Kenneth -->
            <div class="space-y-2">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/kenneth.png" alt="Kenneth" class="w-32 h-32 rounded-full mx-auto object-cover shadow">
                <p class="font-bold">Kenneth Amurao</p>
                <p class="text-gray-600">Band Manager</p>
                <p class="text-sm text-gray-500 italic">Project Manager</p>
            </div>
            <!-- Mark -->
            <div class="space-y-2">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mark.png" alt="Mark" class="w-32 h-32 rounded-full mx-auto object-cover shadow">
                <p class="font-bold">Mark Jerome Santos</p>
                <p class="text-gray-600">Sound Engineer</p>
                <p class="text-sm text-gray-500 italic">Backend Developer</p>
            </div>
            <!-- Andreas -->
            <div class="space-y-2">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/andreas.png" alt="Andreas" class="w-32 h-32 rounded-full mx-auto object-cover shadow">
                <p class="font-bold">Andreas Luy</p>
                <p class="text-gray-600">Stage Designer</p>
                <p class="text-sm text-gray-500 italic">Frontend Developer</p>
            </div>
        </div>
    </div>

</div>