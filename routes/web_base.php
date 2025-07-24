<?php

//INFO
//Este archivo sólo es para comparar con el original que utiliza model binding

use Illuminate\Support\Facades\Route;

use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    //$jobs = Job::with('employer')->paginate(5); //Menos eficiente. Puedes ver el número total de registros.
    $jobs = Job::with('employer')->latest()->simplePaginate(5); //Más eficiente que el anterior. Puedes acceder a una página en concreto.
    //$jobs = Job::with('employer')->cursorPaginate(5); //Más eficiente que los anteriores. Para muchos registros. No puedes acceder a una página en concreto
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function (){
    return view('jobs.create');
});

// Store
Route::post('/jobs/', function (){
    //dd(request()->all());

    //Validación
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Show
/*Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});*/

//Show utilizando Model Binding

Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});



// Edit
Route::get('/jobs/{id}/edit', function ($id) {

    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {

    //Validación
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    //Autorizar (en espera)
    
    
    //Actualizar
    $job = Job::findOrFail($id);
    
    $job->update([
        'title' => request()->title,
        'salary' => request()->salary
    ]);

    //Alternativamente 
    /*
    $job->title = request()->title;
    $job->salary = request()->salary;
    $job->save();
    */

    //redirigir
    return redirect('/jobs/'. $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {

    //Autorizar (en espera)

    //Eliminar
    $job = Job::findOrFail($id);
    $job->delete();

    //redirigir
    return redirect('/jobs');
    
});

Route::get('/contact', function () {
    return view('contact');
});
