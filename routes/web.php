<?php

use Illuminate\Support\Facades\Route;

use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //$jobs = Job::with('employer')->paginate(5); //Menos eficiente. Puedes ver el número total de registros.
    //$jobs = Job::with('employer')->simplePaginate(5); //Más eficiente que el anterior. Puedes acceder a una página en concreto.
    $jobs = Job::with('employer')->cursorPaginate(5); //Más eficiente que los anteriores. Para muchos registros. No puedes acceder a una página en concreto
    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
