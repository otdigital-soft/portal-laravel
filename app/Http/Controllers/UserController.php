<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $user = auth()->user();
        $save = $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);

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

            // Save the file to the public/ad_images folder
            $file->move(public_path('profile_images'), $filenameToStore);

            // Save the path to the file in the database
            $user->update([
                'image_path' => 'profile_images/' . $filenameToStore
            ]);
        }

        if ($save) {
            session()->flash('success', 'Profile Updated successfully');
            return back();
        } else {
            session()->flash('error', 'Something went wrong');
            return back();
        }
    }

    public function updatePassword(Request $request)
    {
        $user_id = auth()->id();
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $old_pw = auth()->user()->value('password');

        if (Hash::Check($old_password, $old_pw)) {
            //update old pw
            $user = auth()->user();
            $save = $user->update([
                'password' => Hash::make($new_password),
            ]);

            session()->flash('success', 'Password set successfully');
            return back();
        } else {
            session()->flash('error', 'Old password is incorrect');
            return back();
        }
    }
}
