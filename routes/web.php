<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('tasks.index'));
});

Route::get('/tasks', function () {
    return view('index', [ //latest() is query builder laravel
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

//this is for show create content
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

//this is for show edit tasks
Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', ['task' => Task::findOrFail($id)]);
})->name('tasks.edit');

Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

//this is for send new task
Route::post('/tasks', function (Request $request) {
    //this is for validation data input
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully!'); //this is for flash message
})->name('tasks.store');

//this is for send edit task
Route::put('/tasks/{id}', function ($id, Request $request) {
    //this is for validation data input
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    //this is for find task by id and not found will go 404 page
    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!'); //this is for flash message
})->name('tasks.update');

//this is for 404 page
Route::fallback(function () {
    return "Still got somewhere";
});
