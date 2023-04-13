<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'string'
        ]);

        $role = new Role();

        $role->name = strtolower($request->name);
        $role->description = $request->description;

        $role->save();

        return redirect()->back()->with('success', 'New role added');
    }


    public function update(Request $request, $role_id)
    {

        $role = Role::find($role_id);

        $role->name = strtolower($request->name);
        $role->description = $request->description;

        $role->update();

        return redirect()->back()->with('success', 'Role Updated');
    }

    public function delete(Request $request, $role_id)
    {
        $role = Role::find($role_id);

        $role->delete();

        return redirect()->back()->with('success', 'Role Deleted');
    }
}
