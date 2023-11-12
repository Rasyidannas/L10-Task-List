<?php

use App\Http\Requests\TaskRequest;
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
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

//this is for show create content
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

//this is for show edit tasks with model binding, so you will not using findOrFail static method
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

//this is for send new task
Route::post('/tasks', function (TaskRequest $request) {
    //this is for validation data input with save data
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!'); //this is for flash message
})->name('tasks.store');

//this is for send edit task
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    //this is for validation data input with update data
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!'); //this is for flash message
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

//this is for 404 page
Route::fallback(function () {
    return "Still got somewhere";
});
