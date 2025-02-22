@extends('layouts.app')

@section('title', $task->title)

@section('content')


    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="link">⬅️ Go back to the
            task list!</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    {{-- if exist --}}
    @isset($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endisset

    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} • Updated
        {{ $task->updated_at->diffForHumans() }}</p>

    <p class="font-medium mb-5 {{ $task->completed ? 'text-green-500' : 'text-red-500' }}">
        {{ $task->completed ? 'Completed' : 'Not Completed' }}
    </p>

    <div class="flex gap-3">
        {{-- Laravel automatically take the primary key when we passed a model into route --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="btn">Edit</a>

        <form method="POST" action="{{ route('tasks.toggle-complete', compact('task')) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>

@endsection
