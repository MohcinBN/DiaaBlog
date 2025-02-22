<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Photo Gallery') }}: {{ $photo->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('photos.update', $photo) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required value="{{ old('title', $photo->title) }}">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
                            <textarea name="caption" id="caption" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('caption', $photo->caption) }}</textarea>
                            @error('caption')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Current Images</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                @foreach($photo->images as $image)
                                    <div class="relative">
                                        <img src="{{ str_starts_with($image->path, 'http') ? $image->path : Storage::url($image->path) }}" alt="" class="w-full h-32 object-cover rounded-lg">
                                        @if($image->is_primary)
                                            <span class="absolute top-0 right-0 bg-green-500 text-white text-xs px-2 py-1 rounded-bl-lg">Primary</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700">Add More Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*" 
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-gray-50 file:text-gray-700
                                          hover:file:bg-gray-100">
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="replace_images" id="replace_images" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="replace_images" class="text-sm text-gray-700">Replace all existing images</label>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Update Photo Gallery') }}
                            </button>
                            <a href="{{ route('photos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
