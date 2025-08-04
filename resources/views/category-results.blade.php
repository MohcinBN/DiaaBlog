@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

  <!-- Featured Posts -->
  @isset($posts)
    <section class="pt-24 pb-12 px-4 bg-white">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">Articles in {{ $category }}</h2>
        
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
            {{ $posts->links() }}
          </div>
        @else
          <p class="text-center text-gray-600 text-lg py-12">No articles available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset