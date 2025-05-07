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
            <input type="text" name="name" id="name" class="border p-2 w-full mb-4" value="{{ old('name', $courseType->name ?? '') }}" required>

            <label class="block mb-2">Slug</label>
            <input readonly type="text" name="slug" id="slug" class="border p-2 w-full mb-4" value="{{ old('slug', $courseType->slug ?? '') }}">

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            nameInput.addEventListener('input', function () {
                const baseSlug = nameInput.value.trim().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');

                slugInput.value = baseSlug ? `${baseSlug}-slug` : '';
            });
        });
    </script>
</x-layouts.app>

