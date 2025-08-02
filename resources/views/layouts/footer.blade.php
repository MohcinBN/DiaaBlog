<footer class="bg-gray-50 border-t border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top section with categories and newsletter -->
    <div class="py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Categories -->
      <div class="col-span-2">
        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Categories</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
          <div>
            <a href="{{ route('posts.index') }}" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Articles</a>
            <a href="#gallery" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Gallery</a>
            <a href="#videos" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Videos</a>
          </div>
          <div>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Technology</a>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Lifestyle</a>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Travel</a>
          </div>
          <div>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Food</a>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Health</a>
            <a href="#" class="text-base text-gray-600 hover:text-orange-500 block mb-2">Fitness</a>
          </div>
        </div>
      </div>
      
      <!-- Newsletter -->
      <div>
        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Subscribe to our newsletter</h3>
        @include('News-letters.embed-form')
      </div>
    </div>
    
    <!-- Bottom section with copyright and social links -->
    <div class="py-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center">
      <div class="mb-4 md:mb-0">
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
      </div>
      
      <div class="flex space-x-6">
        <a href="#" class="text-gray-400 hover:text-orange-500">
          <span class="sr-only">Twitter</span>
          <i class="fab fa-twitter fa-lg"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-orange-500">
          <span class="sr-only">Instagram</span>
          <i class="fab fa-instagram fa-lg"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-orange-500">
          <span class="sr-only">GitHub</span>
          <i class="fab fa-github fa-lg"></i>
        </a>
      </div>
    </div>
  </div>
</footer>
