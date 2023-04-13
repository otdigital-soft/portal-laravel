<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Models\Location;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category');
        $locationId = $request->input('location');

        $ads = $request->user()->ads()->paginate(10);

        return view('users.ads.indexes', compact('ads'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $locations = Location::all();

        return view('users.ads.create', compact('subcategories', 'locations', 'categories'));
    }

    public function store(Request $request)
    {
        $ad = new Ad();
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        // $ad->category_id = $request->input('category_id');
        $ad->subcategory_id = $request->input('subcategory_id');
        $ad->user_id = auth()->user()->id;
        $ad->save();

        $ad->locations()->sync($request->input('locations'));

        // Check if files were uploaded
        if ($request->hasFile('file')) {
            $files = $request->file('file');

            foreach ($files as $file) {
                // Get the filename with the extension
                $filenameWithExt = $file->getClientOriginalName();

                // Get just the filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                // Get the extension
                $extension = $file->getClientOriginalExtension();

                // Create a unique filename
                $filenameToStore = $filename . '_' . time() . '.' . $extension;

                // Save the file to the public/ad_images folder
                $file->move(public_path('ad_images'), $filenameToStore);

                // Save the path to the file in the database
                $adImage = new AdImage();
                $adImage->filename = 'ad_images/' . $filenameToStore;
                $ad->images()->save($adImage);
            }
        }

        return redirect()->route('user.ads')->with('success', 'Ads Created');
    }

    public function toggleFavorite(Request $request, Ad $ad)
    {
        $user = $request->user();

        if ($user->favorites->contains($ad)) {
            $user->favorites()->detach($ad);
            $is_favorite = false;
        } else {
            $user->favorites()->attach($ad);
            $is_favorite = true;
        }

        return response()->json(['is_favorite' => $is_favorite]);
    }

    public function getFavoriteAds()
    {
        $user = auth()->user();

        $ads = $user->favorites()->with('subcategory')->paginate(10);

        return view('users.ads.favorites', compact('ads'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $ad = Ad::find($request->ad_id);

        if (!$ad) {
            return redirect()->back()->with('error', 'Ad not found');
        }

        if ($ad->user->id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You do not have permission to update Ads not yours');
        }

        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->price = $request->price;

        if ($request->hasFile('image')) {
            // Delete the existing image(s) and store the new one
            // $ad->clearMediaCollection();
            // $ad->addMediaFromRequest('image')->toMediaCollection();
            $ad->images->each(function ($image) {
                $image->delete();
            });

            $file = $request->file('image');

            // Get the filename with the extension
            $filenameWithExt = $file->getClientOriginalName();

            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get the extension
            $extension = $file->getClientOriginalExtension();

            // Create a unique filename
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            // Save the file to the public/ad_images folder
            $file->move(public_path('ad_images'), $filenameToStore);

            // Save the path to the file in the database
            $adImage = new AdImage();
            $adImage->filename = 'ad_images/' . $filenameToStore;
            $ad->images()->save($adImage);
        }

        // $ad->save();

        $ad->update();

        return redirect()->back()->with('success', 'Ad Updated');
    }

    public function delete(Request $request, $ad_id)
    {
        $ad = Ad::find($ad_id);

        if (!$ad) {
            return redirect()->back()->with('error', 'Ad not found');
        }

        if ($ad->user->id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You do not have permission to delete Ads not yours');
        }

        $ad->delete();

        return redirect()->back()->with('success', 'Ad Deleted');
    }
}
