@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')
  <!-- Hero Section with Featured Post -->
  <section class="pt-24 pb-12 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to <span class="text-orange-500">DiaaBlog</span></h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
          A simple, clean blog sharing thoughts, ideas, and experiences.
        </p>
      </div>
      
      <!-- Category Navigation -->
      <div class="flex flex-wrap justify-center gap-2 mb-12">
        <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-medium transition duration-150">
          All Articles
        </a>
        <a href="#gallery" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-medium transition duration-150">
          Gallery
        </a>
        <a href="#videos" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-medium transition duration-150">
          Videos
        </a>
        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-medium transition duration-150">
          Technology
        </a>
        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-medium transition duration-150">
          Lifestyle
        </a>
      </div>
      
      <!-- Call to Action -->
      <div class="flex justify-center space-x-4 mb-8">
        <a href="{{ route('posts.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition duration-150">
          Browse All Articles
        </a>
        <a href="#gallery" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-6 rounded-md transition duration-150">
          View Gallery
        </a>
      </div>

      <div class="text-center">
        Or search for a specific article
          <form action="{{ route('search') }}" method="get" class="w-1/2 mx-auto flex border rounded-md p-2 mt-4 focus:outline-none">
            <input type="text" name="search" id="search" placeholder="Search..." class="flex-grow border-none focus:outline-none">
            <button class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md" type="submit">Search</button>
          </form>
      </div>
    </div>
  </section>

  <!-- Featured Posts -->
  @isset($posts)
    <section class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">Latest Articles</h2>
        
        @if($posts->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
              <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-200">
                <a href="{{ route('posts.show', $post->slug) }}" class="block overflow-hidden">
                  @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-56 object-cover hover:scale-105 transition duration-300">
                  @else
                    <img src="{{ asset('images/default-post.jpg') }}" alt="Default image" class="w-full h-56 object-cover hover:scale-105 transition duration-300">
                  @endif
                </a>
                <div class="p-4">
                  <div class="text-xs text-gray-500 mb-2">{{ $post->created_at->format('F j, Y') }}</div>
                  <h3 class="text-lg font-bold mb-2 hover:text-orange-500">
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                  </h3>
                  <p class="text-gray-600 text-sm mb-3">
                    {{ strip_tags(\Illuminate\Support\Str::limit($post->content, 100, '...')) }}
                  </p>
                  <a href="{{ route('posts.show', $post->slug) }}" class="text-orange-500 text-sm font-medium hover:text-orange-600">
                    Read more →
                  </a>
                </div>
              </div>
            @endforeach
          </div>
          
          <div class="mt-12 text-center">
            <a href="{{ route('posts.index') }}" class="inline-block border border-gray-300 hover:border-orange-500 text-gray-700 hover:text-orange-500 font-medium py-2 px-6 rounded-md transition duration-150">
              View All Articles
            </a>
          </div>
        @else
          <p class="text-center text-gray-600 text-lg py-12">No articles available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset

  <!-- Gallery Section -->
  @isset($photos)
    <section id="gallery" class="py-12 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">Photo Gallery</h2>
        
        @if($photos->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($photos as $photo)
              <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-200">
                <a href="{{ route('photos.show', $photo->slug) }}" class="block overflow-hidden">
                  @if($photo->image)
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-56 object-cover hover:scale-105 transition duration-300">
                  @endif
                </a>
                <div class="p-4">
                  <div class="text-xs text-gray-500 mb-2">{{ $photo->created_at->format('F j, Y') }}</div>
                  <h3 class="text-lg font-bold mb-2 hover:text-orange-500">
                    <a href="{{ route('photos.show', $photo->slug) }}">{{ $photo->title }}</a>
                  </h3>
                  <p class="text-gray-600 text-sm mb-3">
                    {{ \Illuminate\Support\Str::limit($photo->caption, 100, '...') }}
                  </p>
                  <a href="{{ route('photos.show', $photo->slug) }}" class="text-orange-500 text-sm font-medium hover:text-orange-600">
                    View details →
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-center text-gray-600 text-lg py-12">No photos available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset

  <!-- Videos Section -->
  @isset($latestVideos)
    @if($latestVideos->count() > 0)
      <section id="videos" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4">
          <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">Latest Videos</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestVideos as $video)
              <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-200">
                <div class="relative" style="padding-top: 56.25%;">
                  <iframe
                    class="absolute top-0 left-0 w-full h-full"
                    src="https://www.youtube.com/embed/{{ $video['videoId'] }}"
                    frameborder="0"
                    allowfullscreen>
                  </iframe>
                </div>
                <div class="p-4">
                  <div class="text-xs text-gray-500 mb-2">{{ now()->format('F j, Y') }}</div>
                  <h3 class="text-lg font-bold hover:text-orange-500">{{ $video['title'] }}</h3>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif
  @endisset
  
  <!-- Newsletter CTA -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
      <p class="text-gray-600 mb-8">Subscribe to our newsletter to receive the latest updates and content.</p>
      <div class="max-w-md mx-auto">
        @include('News-letters.embed-form')
      </div>
    </div>
  </section>
@endsection