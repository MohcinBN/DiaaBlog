@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

  <!-- Gallery Section -->
  @isset($galleries)
    <section id="gallery" class="pt-24 pb-12 px-4 bg-white">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">All Photo Gallery</h2>
        
        @if($galleries->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($galleries as $gallery)
              <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-200">
                <a href="{{ route('photos.show', $gallery->slug) }}" class="block overflow-hidden">
                  @if($gallery->image)
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-56 object-cover hover:scale-105 transition duration-300">
                  @endif
                </a>
                <div class="p-4">
                  <div class="text-xs text-gray-500 mb-2">{{ $gallery->created_at->format('F j, Y') }}</div>
                  <h3 class="text-lg font-bold mb-2 hover:text-orange-500">
                    <a href="{{ route('photos.show', $gallery->slug) }}">{{ $gallery->title }}</a>
                  </h3>
                  <p class="text-gray-600 text-sm mb-3">
                    {{ \Illuminate\Support\Str::limit($gallery->caption, 100, '...') }}
                  </p>
                  <a href="{{ route('photos.show', $gallery->slug) }}" class="text-orange-500 text-sm font-medium hover:text-orange-600">
                    View details →
                  </a>
                </div>
              </div>
            @endforeach
          </div>
          <div class="mt-12 text-center">
            {{ $galleries->links() }}
          </div>
        @else
          <p class="text-center text-gray-600 text-lg py-12">No galleries available at the moment.</p>
        @endif
      </div>
    </section>
  @endisset