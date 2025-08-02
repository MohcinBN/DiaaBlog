@extends('layouts.frontend')

@section('title', $post->title ?? 'Article')

@section('content')

@if($post)
<!-- Article Header Section -->
<div class="max-w-4xl mx-auto px-4 pt-24 pb-8">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-500">Home</a> / 
        <a href="{{ route('posts.index') }}" class="hover:text-orange-500">Articles</a> / 
        <span>{{ $post->title }}</span>
    </div>
    
    <!-- Article Title -->
    <h1 class="text-3xl md:text-4xl font-bold mb-4">
        {{ strip_tags($post->title) }}
    </h1>
    
    <!-- Article Meta -->
    <div class="flex items-center text-sm text-gray-500 mb-8">
        <span>{{ $post->created_at->format('F j, Y') }}</span>
        @if($post->category)
        <span class="mx-2">•</span>
        <a href="#" class="hover:text-orange-500">{{ $post->category->name }}</a>
        @endif
    </div>
    
    <!-- Featured Image -->
    @if($post->featured_image)
    <div class="mb-8">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover rounded-lg shadow-md">
    </div>
    @endif
    
    <!-- Article Content -->
    <div class="prose prose-lg max-w-none mb-12">
        {!! $post->content !!}
    </div>

    <h2 class="text-xl font-bold mb-4">Comments</h2>
    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif
    <div class="space-y-4">
        @foreach ($post->comments()->where('status', 'approved')->where('parent_id', null)->get() as $comment)
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-bold">{{ $comment->name }}</p>
                <p>{{ $comment->content }}</p>
                <div class="pt-4">
                @if($comment->children->isNotEmpty())
                    @foreach ($comment->children()->where('status', 'approved')->get() as $childComment)
                        <div class="pl-8 bg-gray-200 p-4 rounded">
                            <p class="font-bold">{{ $childComment->name }}</p>
                            <p>{{ $childComment->content }}</p>
                        </div>
                    @endforeach
                @endif
                </div>
                <div x-data="{showReplyForm: false}">
                <button @click="showReplyForm = !showReplyForm"  class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-200 mt-4">
                    Add reply on this comment
                </button>
                <div x-show="showReplyForm" class="mt-4">
                    <form action="{{ route('comments.reply.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                        <div class="mb-4">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                        </div>
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-200 mt-4">Reply</button>
                    </form>
                </div>
            </div>
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