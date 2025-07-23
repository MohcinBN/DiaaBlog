@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

@if($post)
<div class="mt-10 container mx-auto">
    <h1 class="text-xl font-bold mb-4 text-center">
        <span class="hover:text-orange-400 transition">
            {{ strip_tags($post->title) }}
        </span>
    </h1>

    @if($post->featured_image)
    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover rounded mb-4">
    @endif

    <p class="text-gray-600 mb-4">
        {{ strip_tags($post->content) }}
    </p>
</div>
@endif


@endsection