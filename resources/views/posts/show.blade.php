@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

    @if($post)
    <div class="pt-10 mt-10 text-center w-full">
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover rounded mb-4">
                @endif
                <h3 class="text-xl font-bold mb-2">
                    <span class="hover:text-orange-400 transition">
                            {{ $post->title }}
                    </span>
                </h3>

                <p class="text-gray-600 mb-4">
                    {{ $post->content }}
                </p>
    </div>
@endif


@endsection
