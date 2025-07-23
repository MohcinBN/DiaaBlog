<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Comments') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Commentator Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Comment Content
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Comment Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Approve/Reject
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $comment->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $comment->content }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($comment->status === 'approved')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1.5 rounded dark:bg-green-900 dark:text-green-300">Approved</span>
                                    @elseif($comment->status === 'rejected')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1.5 rounded dark:bg-red-900 dark:text-red-300">Rejected</span>
                                    @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded dark:bg-gray-700 dark:text-gray-300">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $comment->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    <form id="status-form-{{ $comment->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select
                                            name="status"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            onchange="document.getElementById('status-form-{{ $comment->id }}').action = this.value === 'approved' ? '{{ route('comments.approve', $comment->id) }}' : '{{ route('comments.reject', $comment->id) }}'; document.getElementById('status-form-{{ $comment->id }}').submit()">
                                            <option value="" disabled selected>Select action</option>
                                            @if($comment->status !== 'approved')
                                            <option value="approved">Approve</option>
                                            @endif
                                            @if($comment->status !== 'rejected')
                                            <option value="rejected">Reject</option>
                                            @endif
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return deleteResource('Comment')">
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
                    {{ $comments->links() }}
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