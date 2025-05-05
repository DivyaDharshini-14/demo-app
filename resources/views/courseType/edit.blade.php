<x-layouts.app :title="__('Course Type')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Edit Course Type</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('courseTypes.update', $courseType) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Course Type Name</label>
            <input type="text" name="name" class="border p-2 w-full mb-4" value="{{ old('name', $courseType->name) }}" required>

            <label class="block mb-2">Category</label>
            <select name="category_id" class="border p-2 w-full mb-4" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $courseType->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('courseTypes.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </form>
    </div>
</x-layouts.app>
