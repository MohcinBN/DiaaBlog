<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $page->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="prose max-w-none">
                        {!! $page->content !!}
                    </div>
                    
                    @auth
                        @if(Auth::user()->is_admin == 1)
                            <div class="mt-8 pt-4 border-t border-gray-200">
                                <a href="{{ route('static-pages.edit', $page) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Edit Page
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
