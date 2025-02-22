<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
        </div>
        <div>
            <a href="{{ route('posts.create') }}" type="button" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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
                    {{ $post->created_at }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->updated_at }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('posts.edit', $post->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return deleteResource('Article')">Delete</button>
                    </form>
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
