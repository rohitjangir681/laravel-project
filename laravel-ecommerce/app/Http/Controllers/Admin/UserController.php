<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('user_index'), 403);
        $users = User::where('is_admin', 1)->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('user_create'), 403);
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_admin' => 1
        ]);
        // print_r($request->input('roles'));
        $user->syncRoles($request->input('roles'));

        return redirect()->route('user.index')->withSuccess('User added successfully.');

        // dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // echo $id;
        $user = User::where('id', $id)->get();
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // echo $id;
        abort_unless(Gate::allows('user_edit'), 403);
        $user = User::find($id);
        $roles = Role::all();
        $user_role = $user->roles->pluck('name')->toArray();
        return view('admin.user.edit', compact('user', 'roles', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$request->password) {
            $data = $request->validate([
                'name' => 'required',
                // 'email' => 'required|email'
            ]);
            User::where('id', $id)->update([
                'name' => $data['name'],
                // 'email' => $data['email']
            ]);
        } else {
            $data = $request->validate([
                'name' => 'required',
                // 'email' => 'required|email',
                'confirm_password' => 'same:password'
            ]);
            $data['password'] = Hash::make($data['password']);
            User::where('id', $id)->update([
                'name' => $data['name'],
                // 'email' => $data['email'],
                'password' => $data['password']
            ]);
        }

        $user = User::findOrFail($id);
        $user->syncRoles($request->input('roles'));

        return redirect()->route('user.index')->withSuccess('User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index')->withSuccess('User delete successfully.');
    }
}
