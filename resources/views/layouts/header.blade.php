<header class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 z-50">
  <nav class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('home') }}" class="text-xl font-medium text-gray-900">
          {{ config('app.name') }}
        </a>
      </div>
      
      <div class="hidden md:flex space-x-8">
        <a href="{{ route('posts.index') }}" class="text-gray-500 hover:text-gray-900">Articles</a>
        <a href="#gallery" class="text-gray-500 hover:text-gray-900">Gallery</a>
        <a href="#videos" class="text-gray-500 hover:text-gray-900">Videos</a>
      </div>
    </div>
  </nav>
</header>
