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

    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">delete</button>
    </form>
@endsection
