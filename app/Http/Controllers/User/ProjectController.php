<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->name == 'leader') {
            $projects = Project::paginate(10);
        } else {
            $projects = auth()->user()->subscribedProjects()->paginate(10);
        }
        return view('users.projects.index', compact('projects'));
    }
}
