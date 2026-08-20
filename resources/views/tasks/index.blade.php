@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + New Task
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse($tasks as $task)
        <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-4 mb-3 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-2xl hover:scale-110 transition">
                        {{ $task->is_completed ? '✅' : '⬜' }}
                    </button>
                </form>
                <div>
                    <h3 class="{{ $task->is_completed ? 'line-through text-gray-500' : 'font-semibold' }}">
                        {{ $task->title }}
                    </h3>
                    @if($task->description)
                        <p class="text-gray-600 text-sm">{{ $task->description }}</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">✏️</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center py-8 text-gray-500">
            <p class="text-xl">No tasks yet! 🎯</p>
            <p class="mt-2">Create your first task to get started.</p>
        </div>
    @endforelse
</div>
@endsection