@extends('layouts.frontend')

@section('title', $photo->title ?? 'Photo')

@section('content')

<!-- Photo Header Section -->
<div class="max-w-4xl mx-auto px-4 pt-24 pb-8">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-500">Home</a> / 
        <a href="#gallery" class="hover:text-orange-500">Gallery</a> / 
        <span>{{ $photo->title }}</span>
    </div>
    
    <!-- Photo Title -->
    <h1 class="text-3xl md:text-4xl font-bold mb-4">
        {{ $photo->title }}
    </h1>
    
    <!-- Photo Meta -->
    <div class="flex items-center text-sm text-gray-500 mb-8">
        <span>{{ $photo->created_at->format('F j, Y') }}</span>
    </div>
    
    <!-- Photo Caption -->
    <div class="text-xl text-gray-700 mb-8 font-medium">
        {{ $photo->caption }}
    </div>
    
    <!-- Photo Images -->
    @if($photo->images)
        <div class="mb-8 grid grid-cols-1 gap-4">
            @foreach($photo->images as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $photo->title }}" class="w-full h-auto object-cover rounded-lg shadow-md">
            @endforeach
        </div>
    @endif
    
    <!-- Photo Content -->
    <div class="prose prose-lg max-w-none mb-12">
        {!! $photo->content !!}
    </div>
</div>

@endsection