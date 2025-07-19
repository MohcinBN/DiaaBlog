@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')
  <!-- Hero Section -->
  <section class="pt-24 pb-16 px-4">
    <div class="container mx-auto text-center">
      <h1 class="text-4xl md:text-6xl font-bold mb-6">Welcome to <span class="text-orange-500">DiaaBlog</span></h1>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
        A simple, clean blog sharing thoughts, ideas, and experiences.
      </p>
      <div class="flex justify-center space-x-4">
        <a href="{{ route('posts.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
          Browse Articles
        </a>
        <a href="#gallery" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
          View Gallery
        </a>
      </div>
    </div>
  </section>

  <!-- Featured Posts -->
  @isset($posts)
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Latest Articles</h2>
        
        @if($posts->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
              <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                @if($post->featured_image)
                  <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-56 object-cover">
                @else
                  <img src="{{ asset('images/default-post.jpg') }}" alt="Default image" class="w-full h-56 object-cover">
                @endif

                <div class="p-6">
                  <h3 class="text-2xl font-bold mb-2">{{ $post->title }}</h3>
                  <p class="text-gray-700 mb-4">
                    {{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}
                  </p>
                  <a href="{{ route('posts.show', $post->slug) }}" class="text-orange-500 font-semibold hover:underline">
                    Read more
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-center text-gray-600 text-lg">No articles available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset

  <!-- Gallery Section -->
  @isset($photos)
    <section id="gallery" class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Photo Gallery</h2>
        
        @if($photos->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($photos as $photo)
              <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                @if($photo->image)
                  <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-64 object-cover">
                @endif
                <div class="p-6">
                  <h3 class="text-2xl font-bold mb-2">{{ $photo->title }}</h3>
                  <p class="text-gray-700 mb-4">
                    {{ \Illuminate\Support\Str::limit($photo->caption, 150, '...') }}
                  </p>
                  <a href="{{ route('photos.show', $photo->slug) }}" class="text-orange-500 font-semibold hover:underline">
                    View details
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-center text-gray-600 text-lg">No photos available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset

  <!-- Videos Section -->
  @isset($latestVideos)
    @if($latestVideos->count() > 0)
      <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
          <h2 class="text-3xl font-bold mb-6">Latest Videos</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestVideos as $video)
              <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                <h3 class="text-xl font-semibold mb-2">{{ $video['title'] }}</h3>
                <div class="relative" style="padding-top: 56.25%;">
                  <iframe
                    class="absolute top-0 left-0 w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/{{ $video['videoId'] }}"
                    frameborder="0"
                    allowfullscreen>
                  </iframe>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif
  @endisset
@endsection