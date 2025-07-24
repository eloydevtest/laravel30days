<?php

use Illuminate\Support\Facades\Route;

use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //$jobs = Job::with('employer')->paginate(5); //Menos eficiente. Puedes ver el número total de registros.
    $jobs = Job::with('employer')->latest()->simplePaginate(5); //Más eficiente que el anterior. Puedes acceder a una página en concreto.
    //$jobs = Job::with('employer')->cursorPaginate(5); //Más eficiente que los anteriores. Para muchos registros. No puedes acceder a una página en concreto
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function (){
    return view('jobs.create');
});

Route::post('/jobs/', function (){
    //dd(request()->all());
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
