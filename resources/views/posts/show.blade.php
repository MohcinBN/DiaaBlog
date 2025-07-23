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

    <h2 class="text-xl font-bold mb-4">Comments</h2>
    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif
    <div class="space-y-4">
        @foreach ($post->comments()->where('status', 'approved')->get() as $comment)
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-bold">{{ $comment->name }}</p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-4 comment-form">
        <h2 class="text-xl font-bold mb-4">Add a Comment</h2>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Comment</label>
                <textarea name="content" id="content" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-200">Submit</button>
        </form>
    </div>
</div>
@endif


@endsection