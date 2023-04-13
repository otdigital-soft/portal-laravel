<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index($type = null)
    {
        switch ($type) {
            case 'verified':
                $users = User::where('status', 'verified')->paginate(10);
                break;
            case 'pending':
                $users = User::where('status', 'pending')->paginate(10);
                break;
            case 'admin':
                $users = User::whereHas('role', function ($query) {
                    $query->where('name', 'admin');
                })->paginate(10);
                break;
            case 'leader':
                $users = User::whereHas('role', function ($query) {
                    $query->where('name', 'leader');
                })->paginate(10);
                break;

            default:
                $users = User::paginate(10);
                break;
        }

        return view('admin.users.index', compact('users', 'type'));
    }

    public function show($user_id)
    {
        $user = User::find($user_id);
        $roles = Role::all();

        return view('admin.users.show', compact('user', 'roles'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required'
        ]);

        $user_id = $request->user_id;

        $user = User::find($user_id);

        $user->role_id = $request->role_id;
        $user->update();

        return redirect()->back()->with('success', 'User role updated');
    }
}
