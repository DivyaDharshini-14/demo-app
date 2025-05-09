<x-layouts.app :title="__('Author')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Edit Author</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('authors.update', $author) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Author Name</label>
            <input type="text" name="name" id="name" class="border p-2 w-full mb-4" value="{{ old('name', $author->name) }}" required>

            <label class="block mb-1 font-semibold">Slug</label>
            <input readonly type="text" name="slug" id="slug" class="border p-2 w-full rounded"
                   value="{{ old('slug', $author->slug) }}">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('authors.index') }}" class="ml-2 text-gray-700">Cancel</a>
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
