@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p>{{ $task->description }}</p>

    {{-- if exist --}}
    @isset($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endisset

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <p>
        {{ $task->completed ? 'Completed' : 'Not Completed' }}
    </p>

    <div>
        {{-- Laravel automatically take the primary key when we passed a model into route --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
    </div>

    <div>
        <form method="POST" action="{{ route('tasks.toggle-complete', compact('task')) }}">
            @csrf
            @method('PUT')
            <button type="submit">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>
    </div>

    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
