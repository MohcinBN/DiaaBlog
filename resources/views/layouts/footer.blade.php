<footer class="bg-gray-50 border-t border-gray-200">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center">
      <div class="mb-4 md:mb-0">
        <p class="text-gray-600">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
      </div>

      <div>
        @include('News-letters.embed-form')
      </div>
      
      <div class="flex space-x-6">
        <a href="#" class="text-gray-500 hover:text-gray-900">
          <span class="sr-only">Twitter</span>
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="text-gray-500 hover:text-gray-900">
          <span class="sr-only">Instagram</span>
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="text-gray-500 hover:text-gray-900">
          <span class="sr-only">GitHub</span>
          <i class="fab fa-github"></i>
        </a>
      </div>
    </div>
  </div>
</footer>
