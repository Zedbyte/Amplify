<?php
/** @var Navbar $this */
$routes = $this->getRoutes();

$currentRoute = Yii::app()->controller->getRoute();
$isGuest = Yii::app()->user->isGuest;
$cartItems = $this->getCart();
?>

<nav class="bg-white border-b border-gray-200 relative top-0 w-full py-3">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
      <!-- Logo -->
      <a class="flex items-center" href="<?php echo Yii::app()->createUrl('/site/index'); ?>">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png"
        alt="Amplify's Logo"
        class="h-14 object-contain" />
      </a>

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:space-x-6">
          <?php foreach ($routes as $item):
            $isActive = strpos($currentRoute, trim($item['route'], '/')) !== false;
          ?>
          <a href="<?php echo Yii::app()->createUrl($item['route'], $item['params'] ?? []); ?>"
            class="text-gray-700 hover:text-gray-900 <?php echo $isActive ? 'font-semibold underline' : ''; ?>">
              <?php echo CHtml::encode($item['label']); ?>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Right Icons -->
      <div class="flex items-center space-x-10">
        <span class="flex items-center space-x-4">
          <a href="#" class="text-gray-700 hover:text-gray-900">
            <i class="ph ph-magnifying-glass text-xl"></i>
          </a>
          <a href="<?php echo Yii::app()->createUrl('cart/mycart'); ?>" class="relative text-gray-700 hover:text-gray-900">
              <i class="ph ph-shopping-cart text-xl"></i>

              <?php $cartCount = is_array($cartItems) ? count($cartItems) : count($cartItems); ?>
              <?php if ($cartCount > 0): ?>
                  <span class="absolute -top-2 -right-2 text-xs bg-red-500 text-white rounded-full px-1">
                      <?php echo $cartCount; ?>
                  </span>
              <?php endif; ?>
          </a>
          <a href="#" class="relative text-gray-700 hover:text-gray-900">
            <i class="ph ph-heart text-xl"></i>
            <span class="absolute -top-2 -right-2 text-xs">1</span>
          </a>
        </span>

        <span>
          <?php if ($isGuest): ?>
            <a href="<?php echo Yii::app()->createUrl('/site/login'); ?>" class="text-gray-700 hover:text-gray-900">
              <i class="ph ph-user text-xl"></i>
              <span class="ml-1 font-semibold">Login/Register</span>
            </a>
          <?php else: ?>
            <a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>" class="text-gray-700 hover:text-gray-900">
              <span class="ml-1 font-semibold">Logout</span>
            </a>
          <?php endif; ?>
        </span>
      </div>

      <!-- Mobile Menu Button -->
      <div class="md:hidden flex items-center">
        <button id="mobile-menu-button" class="text-gray-700 hover:text-gray-900 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden">
    <?php foreach ($routes as $item): ?>
      <a href="<?php echo Yii::app()->createUrl($item['route'], $item['params'] ?? []); ?>"
        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
        <?php echo CHtml::encode($item['label']); ?>
      </a>
    <?php endforeach; ?>

    <?php if ($isGuest): ?>
      <a href="<?php echo Yii::app()->createUrl('/site/login'); ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
      <a href="<?php echo Yii::app()->createUrl('/site/register'); ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Register</a>
    <?php else: ?>
      <a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
    <?php endif; ?>
  </div>
</nav>

<script>
  const btn = document.getElementById('mobile-menu-button');
  const menu = document.getElementById('mobile-menu');
  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>
