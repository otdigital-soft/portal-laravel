<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(10);
        return view('locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $location = new Location();

        $location->name = $request->name;
        // $location->description = $request->description;

        $location->save();

        return redirect()->back()->with('success', 'New Location added');
    }


    public function update(Request $request, $location_id)
    {

        $location = Location::find($location_id);

        $location->name = $request->name;
        // $location->description = $request->description;

        $location->update();

        return redirect()->back()->with('success', 'Location Updated');
    }

    public function delete(Request $request, $location_id)
    {
        $location = Location::find($location_id);

        $location->delete();

        return redirect()->back()->with('success', 'Location Deleted');
    }
}
