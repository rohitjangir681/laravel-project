<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('manage_roles'), 403);
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('manage_roles'), 403);
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $roleName = $request->role_name;

        $role = Role::create([
            'name' => $roleName,
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('role.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        abort_unless(Gate::allows('manage_roles'), 403);
        $roleData = Role::find($id);
        $permissions = Permission::all();
        // dd($roleData->permissions->pluck('name'));
        $perName = $roleData->permissions->pluck('name')->toArray();
        // print_r($perName);
        // die;
        // dd($permissions);
        return view('admin.role.edit', compact('roleData', 'permissions', 'perName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->permissions);

        $role = Role::findOrFail($id);

        $test = $role->update([
            'name' => $request->role_name
        ]);
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        Role::where('id', $id)->delete();
        return redirect()->route('role.index');
    }
}
