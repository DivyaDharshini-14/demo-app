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
            <input type="text" name="name" class="border p-2 w-full mb-4" value="{{ old('name', $author->name) }}" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('authors.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </form>
    </div>
</x-layouts.app>
