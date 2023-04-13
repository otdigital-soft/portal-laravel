<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('home', compact('projects'));
    }

    public function project($slug)
    {
        $project = Project::where('slug', $slug)->with(['blogPosts.creator', 'events'])->first();
        return view('project', compact('project'));
    }

    public function showBlogPostDetails($slug)
    {
        $post = BlogPost::where('slug', $slug)->first();

        return view('blog-post-detail', compact('post'));
    }

    // public function calendar()
    // {
    //     $projects = Project::all();
    //     return view('calendar', compact('projects'));
    // }

    public function calendar(Request $request)
    {
        // get all projects for filtering
        $projects = Project::all();

        // get all subscribed events of the authenticated user
        $subscribed_events = Auth::user()->events()->pluck('events.id')->toArray();

        // start building the query for events
        $events_query = Event::query();

        // apply project filter if it is set
        if ($request->has('project')) {
            $events_query->where('project_id', $request->project);
        }

        // apply subscribed events filter if it is set
        if ($request->has('subscribed') && $request->subscribed == true) {
            $events_query->whereIn('id', $subscribed_events);
        }

        // apply all events filter if it is set
        if ($request->has('all') && $request->all == true) {
            // $events_query->whereNotIn('id', $subscribed_events);
        }

        // get all events that match the filters
        $events = $events_query->get();

        // transform events into the format expected by the calendar
        $transformed_events = $events->map(function ($event) {
            return [
                'title' => $event->name,
                'start' => Carbon::parse($event->start_time)->format('Y-m-d H:i:s'),
                'end' => Carbon::parse($event->end_time)->format('Y-m-d H:i:s'),
                'url' => route('events.show', $event),
            ];
        });

        // set the filter value based on the selected filters
        $filter = ['all' => false, 'subscribed' => false, 'project' => null];
        if ($request->has('subscribed') && $request->subscribed == true) {
            $filter['subscribed'] = true;
        } elseif (
            $request->has('all') && $request->all == true
        ) {
            $filter['all'] = true;
        } elseif ($request->has('project')) {
            $project = Project::find($request->project);
            if ($project) {
                $filter['project'] = $project->id;
            }
        }

        // pass data to the view
        return view('calendar', compact('transformed_events', 'projects', 'filter'));
    }
}
