<x-layouts.app :title="__('Category')">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Todos</h1>
        <ul class="space-y-2">
            @foreach($todos as $todo)
                <li class="p-4 bg-white shadow rounded">
                    <div class="flex justify-between">
                        <span>{{ $todo['title'] }}</span>
                        <span class="text-sm {{ $todo['completed'] ? 'text-green-600' : 'text-red-600' }}">
                            {{ $todo['completed'] ? 'Done' : 'Pending' }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</x-layouts.app>
