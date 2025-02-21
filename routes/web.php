<?php

use App\Models\Task;
use Illuminate\Http\Request;
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

Route::get("/tasks/{id}", function ($id) {
    return view('show', ["task" => Task::findOrFail($id)]);
})->name("tasks.show");

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ], [
        'title.required' => "Judul tidak boleh kosong!",
        'description.required' => "Deskripsi tidak boleh kosong!",
        'long_description.required' => "Deskripsi panjang tidak boleh kosong!"
    ]);

    // create new task model
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // insert data
    $task->save();

    return redirect()->route("tasks.show", ['id' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// If user try to access route that doesn't exist
Route::fallback(function () {
    return "Still got somewhere!";
});
