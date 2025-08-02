<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Articles') }}
                </h2>
            </div>
            <div>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Write New Post
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
            <div class="ps-3 pe-3 pt-3 pb-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <span class="font-medium"> {{ session()->get('success') }} </span>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Post Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Content
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Featured image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categories
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Updated At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $post->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ Str::limit($post->content, 50) }}
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ str_starts_with($post->featured_image, 'http') ? $post->featured_image : Storage::url($post->featured_image) }}" alt="" width="100" height="100">
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($post->categories->pluck('name') as $categoryName)
                                        <li class="list-disc">{{ $categoryName }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->updated_at }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return deleteResource('Article')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px text-base h-10">
                    {{ $posts->links() }}
                </ul>
            </nav>
        </div>
    </div>

    @push('scripts')
    <script>
        function deleteResource(resourceType) {
            if (confirm('Are you sure you want to delete this ' + resourceType + '?')) {
                return true;
            }
            return false;
        }
    </script>
    @endpush

</x-app-layout>