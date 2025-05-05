<x-layouts.app :title="__('Category')">
    <div class="container font-mono">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold mb-4">Categories</h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add
                Category</a>
        </div>

        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 1000)"
                x-show="show"
                x-transition
                class="fixed top-4 right-4 bg-green-100 text-green-700 border border-green-300 px-4 py-2 rounded shadow-lg z-50"
            >
                <div class="flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 ml-4 font-bold">×</button>
                </div>
            </div>
        @endif


        <table class="w-full mt-4 border">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2">ID</th>
                <th class="p-2">Name</th>
                {{--                <th class="p-2">Slug</th>--}}
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $index => $category)
                <tr class="border-t">
                    <td class="p-2 text-center">{{ $index + 1 }}</td>
                    <td class="p-2 text-center">{{ $category->name }}</td>
                    {{--                    <td class="p-2">{{ $category->slug }}</td>--}}
                    <td class="p-2 text-center" x-data="{ open: false }">
                        <!-- Edit Button -->
                        <a href="{{ route('categories.edit', $category) }}"
                           class="text-white px-2 py-1 rounded bg-gradient-to-l from-blue-700 to-sky-500 text-xs">
                            Edit
                        </a>

                        <!-- Delete Button (opens modal) -->
                        <button @click="open = true"
                                class="ml-2 text-white px-2 py-1 rounded bg-gradient-to-l from-red-500 to-orange-700 text-xs">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div x-show="open"
                             x-cloak
                             class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded shadow-md w-80">
                                <h2 class="text-lg font-semibold mb-4">Delete Category</h2>
                                <p class="mb-4 text-sm text-gray-700">Are you sure you want to delete this category?</p>
                                <div class="flex justify-end space-x-2">
                                    <button @click="open = false"
                                            class="px-3 py-1 bg-gray-300 text-gray-800 rounded text-sm hover:bg-gray-400">
                                        Cancel
                                    </button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                            Confirm
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-layouts.app>
