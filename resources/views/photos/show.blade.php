@extends('layouts.frontend')

@section('title', 'Welcome')

@section('content')

            <div class="pt-10 mt-10 text-center w-full">
                @if($photo->image)
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-40 object-cover rounded mb-4">
                @endif

                <h3 class="text-xl font-bold mb-2">
                    <span class="hover:text-orange-400 transition">
                        {{ $photo->title }}
                    </span>
                </h3>

                <h3 class="text-xl font-bold mb-2">
                    <span class="hover:text-orange-400 transition">
                        {{ $photo->caption }}
                    </span>
                </h3>

                <p class="text-gray-600 mb-4">
                    {{ $photo->content }}
                </p>
            </div>


    <div class="mt-24"></div>


    @endsection