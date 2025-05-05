<x-layouts.app :title="__('Edit Category')">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Edit Category</h2>
            <a href="{{ route('categories.index') }}"
               class="relative inline-block px-6 py-2 font-bold text-white bg-gradient-to-r from-blue-500 to-purple-500 rounded-md overflow-hidden shadow-lg group transition">
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700 blur-sm"></span>
                <span class="relative z-10">← Back</span>
            </a>
        </div>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Category Name</label>
                <input type="text" name="name" id="name"
                       class="border p-2 w-full rounded"
                       value="{{ old('name', $category->name) }}" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Slug</label>
                <input readonly type="text" name="slug" id="slug"
                       class="border p-2 w-full rounded"
                       value="{{ old('slug', $category->slug) }}">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="px-6 py-2 bg-green-500 text-white font-semibold rounded shadow hover:bg-green-600 transition duration-300">
                    Update
                </button>
                <a href="{{ route('categories.index') }}"
                   class="ml-4 text-gray-700 underline hover:text-blue-600 transition">
                    Cancel
                </a>
            </div>
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
