@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')

    <div class="mt-2 mb-4">
        <a href="{{ route('tasks.create') }}" class="link">Add Task!</a>
    </div>

    <div>
        @forelse ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                    @class(['font-normal', 'line-through' => $task->completed])>{{ "{$task->id}. {$task->title}" }}
                </a>
            </div>
        @empty
            <div>There are no tasks!</div>
        @endforelse
    </div>

    @if ($tasks->count())
        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    @endif

@endsection
