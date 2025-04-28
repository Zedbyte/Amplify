<?php
// File: protected/components/navbar.php
?>

<nav class="bg-white border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <span class="text-xl font-bold">Amplify</span>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:space-x-6">
        <a href="#" class="text-gray-700 hover:text-gray-900">Home</a>

        <div class="relative group">
          <button class="text-gray-700 hover:text-gray-900 inline-flex items-center">
            Shop
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <!-- Dropdown (optional) -->
          <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 py-2 w-40">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Category 1</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Category 2</a>
          </div>
        </div>

        <a href="#" class="text-gray-700 hover:text-gray-900">About</a>
        <a href="#" class="text-gray-700 hover:text-gray-900">Blog</a>
        <a href="#" class="text-gray-700 hover:text-gray-900">Contact</a>
      </div>

      <!-- Right Icons -->
      <div class="flex items-center space-x-4">
        <a href="#" class="flex items-center text-gray-700 hover:text-gray-900">
          <i class="ph ph-user text-xl"></i>
          <span class="ml-1 font-semibold">Login / Register</span>
        </a>
        <a href="#" class="text-gray-700 hover:text-gray-900">
          <i class="ph ph-magnifying-glass text-xl"></i>
        </a>
        <a href="#" class="relative text-gray-700 hover:text-gray-900">
          <i class="ph ph-shopping-cart text-xl"></i>
          <span class="absolute -top-2 -right-2 text-xs bg-red-500 text-white rounded-full px-1">1</span>
        </a>
        <a href="#" class="relative text-gray-700 hover:text-gray-900">
          <i class="ph ph-heart text-xl"></i>
          <span class="absolute -top-2 -right-2 text-xs">1</span>
        </a>
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
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Shop</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Blog</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pages</a>
  </div>
</nav>

<!-- Include Phosphor Icons -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
