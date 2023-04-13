<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Conversation;
use App\Models\Location;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        // $categoryId = $request->input('category');
        // $locationId = $request->input('location');
        $ads = Ad::filterByTitleCategorySubcategoryAndLocation(
            $request->input('title'),
            $request->input('category_id'),
            $request->input('location_id'),
            $request->input('subcategory_id')
        )->paginate(10);

        $categories = Category::all();
        $locations = Location::all();
        return view('ads', compact('ads', 'categories', 'locations'));
    }

    public function show(Ad $ad)
    {
        $ad->increment('views');

        $ads = Ad::all();
        $categories = Category::all();
        $locations = Location::all();
        return view('ad-details', compact('ad', 'ads', 'categories', 'locations'));
    }

    public function getAdsBySubcategory(Subcategory $subcategory)
    {
        $ads = $subcategory->ads;

        return view('subcategory', [
            'subcategory' => $subcategory,
            'ads' => $ads,
        ]);
    }

    public function conversations()
    {
        $user = auth()->user();

        $adsWithConversation = Conversation::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with(['ad.conversations.messages', 'users', 'messages' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1);
            }])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('ad_id')
            ->map(function ($conversations) {
                return $conversations->first();
            });

        return view('users.conversations.index', compact('adsWithConversation'));
    }
}
