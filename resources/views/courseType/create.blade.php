<x-layouts.app :title="__('Course Types')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Create Course Type</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('courseTypes.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Course Type Name</label>
            <input type="text" name="name" class="border p-2 w-full mb-4" value="{{ old('name') }}" required>

            <label class="block mb-2">Category</label>
            <select name="category_id" class="border p-2 w-full mb-4" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ route('courseTypes.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </form>
    </div>
</x-layouts.app>

