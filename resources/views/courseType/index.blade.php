<x-layouts.app :title="__('Course Type')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Course Types</h2>

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

        <a href="{{ route('courseTypes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Course Type</a>

        <table class="w-full mt-4 border">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2">ID</th>
                <th class="p-2">Name</th>
                <th class="p-2">Category</th>
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($courseTypes as $courseType)
                <tr class="border-t">
                    <td class="p-2 text-center">{{ $courseType->id }}</td>
                    <td class="p-2 text-center">{{ $courseType->name }}</td>
                    <td class="p-2 text-center">{{ $courseType->category->name ?? 'N/A' }}</td>
                    <td class="p-2 text-center">
                        <a href="{{ route('courseTypes.edit', $courseType) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('courseTypes.destroy', $courseType) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this course type?')" class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $courseTypes->links() }}
        </div>
    </div>
</x-layouts.app>
