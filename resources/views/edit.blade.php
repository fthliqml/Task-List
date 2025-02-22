@extends('layouts.app')

@section('content')
    {{-- compact : ['task' => $task] --}}
    @include('form', compact('task'))
@endsection
