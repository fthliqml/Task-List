<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("tasks.index");
});

Route::get('/tasks', function () {
    return view("index", [
        // "tasks" => Task::all()
        // "tasks" => Task::latest()->where('completed', true)->get()
        "tasks" => Task::latest()->get() // get recent data first
    ]);
})->name("tasks.index");

// Use View if we doesn't need sending data to views
Route::view('/tasks/create', 'create')->name("tasks.create");

Route::get("/tasks/{task}", function (Task $task) {
    return view('show', compact("task")); // compact : Automatically create array asosiatif
})->name("tasks.show");

Route::get("/tasks/{task}/edit", function (Task $task) {
    return view("edit", [
        "task" => $task // automatically find data by id
    ]);
})->name("tasks.edit");

Route::post('/tasks', function (TaskRequest $request) {
    // create new task and store it to database
    $task = Task::create($request->validated());

    return redirect()->route("tasks.show", ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route("tasks.show", ['task' => $task->id])
        ->with('success', 'Task edited successfully!'); // flash message, accept in view using session()
})->name('tasks.update');

// If user try to access route that doesn't exist
Route::fallback(function () {
    return "Still got somewhere!";
});
