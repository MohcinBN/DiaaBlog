<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('posts.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required value="{{ old('title') }}">
                            @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content') }}</textarea>
                            @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div>
                                <label for="category_ids" class="block text-sm font-medium text-gray-700">Categories</label>
                                <div x-data="multiSelect()" class="mt-1 relative" x-ref="dropdown">
                                    <!-- Selected items display -->
                                    <div class="flex flex-wrap gap-2 p-2 min-h-10 border border-gray-300 rounded-md bg-white">
                                        <template x-for="id in selectedCategories" :key="id">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                <span x-text="categories.find(c => c.id === id).name"></span>
                                                <button @click="removeSelected(id)" type="button" class="ml-1.5 inline-flex text-indigo-500 hover:text-indigo-700">
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>
                                        <button @click="toggle()" type="button" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <span x-text="open ? 'Close' : 'Add Categories'"></span>
                                            <svg class="ml-1.5 h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute bottom-full mb-1 z-50 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                        <ul x-ref="list" class="divide-y divide-gray-200">
                                            <template x-for="category in categories" :key="category.id">
                                                <li class="px-4 py-2 hover:bg-gray-50 cursor-pointer flex items-center">
                                                    <input type="checkbox"
                                                        name="categories[]"
                                                        :value="category.id"
                                                        :id="'category-'+category.id"
                                                        @change="toggleOption(category.id)"
                                                        :checked="isSelected(category.id)"
                                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                    <label :for="'category-'+category.id" x-text="category.name" class="ml-3 block text-sm text-gray-700"></label>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                                @error('categories')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end mt-4">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Create New Post
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initCKEditor('#content', {
                height: '400px',
            }).then(editor => {
                // Handle form submission
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    const content = editor.getData();
                    if (!content.trim()) {
                        e.preventDefault();
                        alert('Content field is required');
                    }
                });
            });
        });

        function multiSelect() {
            return {
                open: false,
                selectedCategories: [],
                categories: <?php echo json_encode($categories); ?>,
                toggle() {
                    this.open = !this.open
                },
                isSelected(id) {
                    return this.selectedCategories.includes(id)
                },
                toggleOption(id) {
                    if (this.isSelected(id)) {
                        this.selectedCategories = this.selectedCategories.filter(item => item !== id)
                    } else {
                        this.selectedCategories.push(id)
                        this.$nextTick(() => {
                            this.$refs.list.scrollTop = this.$refs.list.scrollHeight
                        })
                    }
                },
                removeSelected(id) {
                    this.selectedCategories = this.selectedCategories.filter(item => item !== id)
                }
            }
        }
    </script>
    @endpush
</x-app-layout>