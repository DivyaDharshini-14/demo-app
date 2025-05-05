<x-layouts.app :title="__('authors')">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">Create authors</h2>

        @if ($errors->any())
            <ul class="text-red-500 mb-4">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf

            <label class="block mb-2">authors Name</label>
            <input type="text" name="name" class="border p-2 w-full mb-4" value="{{ old('name') }}" required>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ route('authors.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </form>
    </div>
</x-layouts.app>
