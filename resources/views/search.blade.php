@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

<section class="pt-24 pb-12 px-4 bg-white">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 border-l-4 border-orange-500 pl-4">search results for "{{ $search }}"</h2>
        @if($results->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($results as $result)
              <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-200">
                <a href="{{ route($result->type === 'post' ? 'posts.show' : 'photos.show', $result->slug) }}" class="block overflow-hidden">
                  @if($result->featured_image)
                    <img src="{{ $result->featured_image }}" alt="{{ $result->title }}" class="w-full h-56 object-cover hover:scale-105 transition duration-300">
                  @endif
                  <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $result->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ $result->excerpt }}</p>
                    <a href="{{ route($result->type === 'post' ? 'posts.show' : 'photos.show', $result->slug) }}" 
                        class="text-blue-500 hover:underline">
                        See More
                    </a>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @else
          <p>No results found for "{{ $search }}"</p>
        @endif
      </div>
    </section>

