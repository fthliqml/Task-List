<?php

use Illuminate\Support\Facades\Route;

// Sending a blade template named index and send data as a second argument
Route::get('/', function () {
    return view("index", [
        'name' => "Iqmal"
    ]);
});

// Route /hello
Route::get("/hello", function () {
    return "hello";
})->name('hello'); // naming a route

// Redirect route
/*
Route::get("/halo", function () {
    return redirect("/hello");
});
 */

// redirect route with name of the route
Route::get("/halo", function () {
    return redirect()->route("hello");
});

// Dynamic route (params)
Route::get("/greet/{name}", function ($name) {
    return "Hello $name!";
});

// Use View if we doesn't need sending data to views
Route::view('/tasks/create', 'create')->name("tasks.create");

Route::get("/tasks/{id}", function ($id) use ($tasks) {
    $task = collect($tasks)->firstWhere('id', $id);

    if (!$task) {
        abort(404);
    };

    return view('show', ["task" => $task]);
});

// If user try to access route that doesn't exist
Route::fallback(function () {
    return "Still got somewhere!";
});
