<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        //$jobs = Job::with('employer')->paginate(5); //Menos eficiente. Puedes ver el número total de registros.
        $jobs = Job::with('employer')->latest()->simplePaginate(5); //Más eficiente que el anterior. Puedes acceder a una página en concreto.
        //$jobs = Job::with('employer')->cursorPaginate(5); //Más eficiente que los anteriores. Para muchos registros. No puedes acceder a una página en concreto

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
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
    }

    public function edit(Job $job)
    {
        if (Auth::guest())
        {
            return redirect('/login');
        }

        if ($job->employer->user->isNot(Auth::user()))
        {
            abort(403);
        }
        
            return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        //Autorizar (en espera)

        //Validación
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

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
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        //Autorizar (en espera)

        //Eliminar
        $job->delete();

        //redirigir
        return redirect('/jobs');
    }
}
