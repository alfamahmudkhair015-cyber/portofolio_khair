<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        $projects = Project::latest()->take(3)->get();

        return view('home', compact('projects'));
    }

    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        $projects = Project::latest()->get();

        return view('projects', compact('projects'));
    }

    public function show(Project $project)
    {
        $others = Project::where('id', '!=', $project->id)->latest()->take(2)->get();

        return view('project-show', compact('project', 'others'));
    }

    public function contact()
    {
        return view('contact');
    }
}
