<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);

        return view('admin.projects.index', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $project = new Project();
        $project->title = $validatedData['title'];
        $project->slug = Str::slug($validatedData['title']);
        $project->description = $validatedData['description'];

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            // Get the filename with the extension
            $filenameWithExt = $file->getClientOriginalName();

            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get the extension
            $extension = $file->getClientOriginalExtension();

            // Create a unique filename
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            // Save the file to the public/project_images folder
            $file->move(public_path('project_images'), $filenameToStore);

            // Save the path to the file in the database
            $project->image_path = 'project_images/' . $filenameToStore;
        }

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created succesfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id', $id)->with(['subscribers', 'blogPosts', 'events'])->first();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $project = Project::find($request->project_id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        if (optional(auth()->user()->role)->name != 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to update Projects.');
        }

        $project->title = $request->title;
        $project->description = $request->description;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            // Get the filename with the extension
            $filenameWithExt = $file->getClientOriginalName();

            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get the extension
            $extension = $file->getClientOriginalExtension();

            // Create a unique filename
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            // Save the file to the public/project_images folder
            $file->move(public_path('project_images'), $filenameToStore);

            // Save the path to the file in the database
            $project->image_path = 'project_images/' . $filenameToStore;
        }

        $project->update();

        return redirect()->back()->with('success', 'Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggleSubscription(Request $request, Project $project)
    {
        $user = $request->user();

        if ($user->subscribedProjects->contains($project)) {
            $user->subscribedProjects()->detach($project);
            $on_subscription = false;
        } else {
            $user->subscribedProjects()->attach($project);
            $on_subscription = true;
        }

        return response()->json(['on_subscription' => $on_subscription]);
    }

    public function subscribe(Project $project)
    {
        $user = Auth::user();

        $user->subscribedProjects()->attach($project->id);

        return back()->with('success', 'You have subscribed to the project!');
    }

    public function unsubscribe(Project $project)
    {
        $user = Auth::user();

        $user->subscribedProjects()->detach($project->id);

        return back()->with('success', 'You have unsubscribed from the project.');
    }
}
