<header class="fixed top-0 left-0 right-0 bg-white border-b border-gray-100 shadow-sm z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo and site name -->
      <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('home') }}" class="flex items-center">
          <span class="text-xl font-bold text-orange-500">{{ config('app.name') }}</span>
        </a>
      </div>
      
      <!-- Primary Navigation -->
      <div class="hidden md:flex items-center space-x-1">
        <a href="{{ route('all-posts') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-150">Articles</a>
        <a href="{{ route('all-galleries') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-150">Gallery</a>
        @auth
        <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-150">Dashboard</a>
        @endauth
      </div>
      
      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-orange-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
          <span class="sr-only">Open main menu</span>
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </div>
  
  <!-- Mobile menu, show/hide based on menu state -->
  <div class="md:hidden hidden mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-100">
      <a href="{{ route('posts.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Articles</a>
      <a href="#gallery" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Gallery</a>
      <a href="#videos" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Videos</a>
    </div>
  </div>
</header>

<script>
  // Mobile menu toggle
  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('.mobile-menu-button');
    const menu = document.querySelector('.mobile-menu');
    
    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  });
</script>
