<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Project;
use App\Notifications\ProjectEventNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $events = $project->events;
        $locations = Location::all();

        return view('users.events.index', compact('events', 'project', 'locations'));
    }

    public function create(Project $project)
    {
        $locations = Location::all();
        return view('users.events.create', compact('project', 'locations'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            // 'date' => 'required|date',
            // 'time' => 'required',
            'location' => 'required',
            // 'max_attendees' => 'required|integer|min:1',
        ]);

        $event = new Event([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->start_time,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'created_by' => Auth::user()->id
        ]);

        $event->project()->associate($project);
        $event->save();
        $event->attendees()->attach(Auth::user());


        $project = Project::find($event->project_id);
        $subscribers = $project->subscribers;

        Notification::send($subscribers, new ProjectEventNotification($event));

        return redirect()->route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->with('attendees')->first();

        return view('users.events.show', compact('event'));
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
        $event = Event::find($request->event_id);

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }

        if ($event->organizer->id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You do not have permission to update Events not yours');
        }

        $event->name = $request->name;
        $event->date = $request->start_time;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->description = $request->description;

        $event->update();

        return redirect()->back()->with('success', 'Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        $event->delete();

        return redirect()->back()->with('success', 'Event deleted succesfully');
    }

    public function signup(Event $event, Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->back()->with('error', 'You need to be logged in before registering for an event');
        }

        $attendance = $event->attendees()->where('user_id', $user->id)->first();

        if (!$attendance) {
            $event->attendees()->attach($user->id);
            $attendance = $event->attendees()->where('user_id', $user->id)->first();
        }

        return redirect()->back()->with('success', 'You have successfully signed up for this event.');

        // return view('events.signup', [
        //     'event' => $event
        // ]);
    }

    // Remove user from event
    public function cancel(Event $event)
    {
        $event->attendees()->detach(auth()->user());

        return redirect()->back()->with('success', 'You have cancelled your attendance for the event.');
    }

    public function getEvents()
    {
        $events = Event::all();

        $eventList = [];

        foreach ($events as $event) {
            $eventList[] = [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->date,
                'end' => $event->date,
                'url' => route('events.show', $event),
                'backgroundColor' => '#7280f3',
            ];
        }

        return response()->json($eventList);
    }

    public function calendar(Request $request)
    {
        $projects = Project::all();
        $events = Event::with('project')->get();

        // Get filter value from query string or use default value
        $filter = $request->query('filter', 'all');

        if ($filter == 'subscribed') {
            // Get subscribed events only
            $events = Auth::user()->events()->with('project')->get();
        } elseif ($filter == 'project') {
            // Get events for selected project
            $projectId = $request->query('project');
            if ($projectId) {
                $events = Event::where('project_id', $projectId)->with('project')->get();
            }
        }

        // dd($events, $filter);

        return view('calendar', compact('events', 'projects', 'filter'));
    }
}
