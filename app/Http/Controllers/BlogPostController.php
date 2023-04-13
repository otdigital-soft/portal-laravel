<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Project;
use App\Notifications\ProjectBlogPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // Show the form for creating a new blog post
    public function create(Project $project = null)
    {
        return view('users.blog-posts.create', compact('project'));
    }

    // Store a newly created blog post in storage
    public function store(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blogPost = new BlogPost();
        $blogPost->title = $validatedData['title'];
        $blogPost->slug = Str::slug($validatedData['title']);
        $blogPost->content = $validatedData['content'];
        $blogPost->project_id = $project->id;
        $blogPost->user_id = auth()->user()->id;

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

            // Save the file to the public/post_images folder
            $file->move(public_path('blogPost_images'), $filenameToStore);

            // Save the path to the file in the database
            $blogPost->image_path = 'blogPost_images/' . $filenameToStore;
        }

        $blogPost->save();

        $project = Project::find($blogPost->project_id);
        $subscribers = $project->subscribers;

        Notification::send($subscribers, new ProjectBlogPostNotification($blogPost));

        return redirect()->route('projects.show', $project)->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->first();

        // return view('blog-post-detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogPost = BlogPost::where('id', $id)->first();
        return view('users.blog-posts.edit', compact('blogPost'));
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
        $post = BlogPost::find($request->blog_post_id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        if ($post->creator->id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You do not have permission to update Post');
        }

        $post->title = $request->title;
        $post->content = $request->content;

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

            // Save the file to the public/post_images folder
            $file->move(public_path('blogPost_images'), $filenameToStore);

            // Save the path to the file in the database
            $post->image_path = 'blogPost_images/' . $filenameToStore;

        }

        $post->update();

        return redirect()->back()->with('success', 'Blog Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::find($id);

        $blogPost->delete();

        return redirect()->back()->with('success', 'Blog Post deleted succesfully');
    }
}
