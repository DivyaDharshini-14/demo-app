<x-layouts.app :title="__('Course')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">{{ isset($course) ? 'Edit' : 'Create' }} Course</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ isset($course) ? route('courses.update', $course) : route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($course)) @method('PUT') @endif

            <label class="block mb-2">Course Name</label>
            <input type="text" name="name" id="name" class="border p-2 w-full mb-4" value="{{ old('name', $course->name ?? '') }}" required>

            <label class="block mb-2">Slug</label>
            <input readonly type="text" name="slug" id="slug" class="border p-2 w-full mb-4" value="{{ old('slug', $course->slug ?? '') }}">

            <label class="block mb-2">Description</label>
            <textarea name="description" class="border p-2 w-full mb-4" required>{{ old('description', $course->description ?? '') }}</textarea>

            <label class="block mb-2">Category</label>
            <select name="category_id" class="border p-2 w-full mb-4" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2">Course Type</label>
            <select name="course_type_id" class="border p-2 w-full mb-4" required>
                <option value="">-- Select Type --</option>
                @foreach($courseTypes as $type)
                    <option value="{{ $type->id }}" {{ old('course_type_id', $course->course_type_id ?? '') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2">Thumbnail (Image)</label>
            <input type="file" name="thumbnail" class="border p-2 w-full mb-4" {{ isset($course) ? '' : 'required' }}>
            @if(isset($course) && $course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="mb-4 w-32 h-auto" alt="Current Thumbnail">
            @endif

            <label class="block mb-2">Video URL</label>
            <input type="url" name="video" class="border p-2 w-full mb-4" value="{{ old('video', $course->video ?? '') }}" required>

            <label class="block mb-2">Author</label>
            <select name="author_id" class="border p-2 w-full mb-4" required>
                <option value="">-- Select Author --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('author_id', $course->author_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2">User</label>
            <select name="user_id" class="border p-2 w-full mb-4" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $course->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($course) ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('courses.index') }}" class="ml-2 text-gray-700">Cancel</a>
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

