<x-layouts.app :title="__('Category')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Edit Category</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Category Name</label>
            <input type="text" name="name" class="border p-2 w-full mb-4" value="{{ old('name', $category->name) }}" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('categories.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </form>
    </div>
</x-layouts.app>
