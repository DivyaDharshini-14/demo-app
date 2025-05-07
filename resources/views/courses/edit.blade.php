<x-layouts.app :title="__('Edit Course')">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Edit Course</h2>
            <a href="{{ route('courses.index') }}"
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

        <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            dd('')
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Course Name</label>
                <input type="text" name="name" id="name" class="border p-2 w-full rounded"
                       value="{{ old('name', $course->name) }}" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Slug</label>
                <input readonly type="text" name="slug" id="slug" class="border p-2 w-full rounded"
                       value="{{ old('slug', $course->slug) }}">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" class="border p-2 w-full rounded" required>{{ old('description', $course->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Category</label>
                <select name="category_id" class="border p-2 w-full rounded" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Course Type</label>
                <select name="course_type_id" class="border p-2 w-full rounded" required>
                    @foreach ($courseTypes as $type)
                        <option value="{{ $type->id }}" {{ old('course_type_id', $course->course_type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail" class="border p-2 w-full rounded">
                @if ($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="mt-2 w-32 h-auto rounded">
                @endif
            </div>

            <div>
                <label class="block mb-1 font-semibold">Video URL</label>
                <input type="url" name="video" class="border p-2 w-full rounded"
                       value="{{ old('video', $course->video) }}" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Author</label>
                <select name="author_id" class="border p-2 w-full rounded" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('author_id', $course->author_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">User</label>
                <select name="user_id" class="border p-2 w-full rounded" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $course->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded shadow hover:bg-green-600 transition duration-300">
                    Update
                </button>
                <a href="{{ route('courses.index') }}"
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
