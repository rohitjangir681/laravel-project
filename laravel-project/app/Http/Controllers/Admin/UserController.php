<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Hash;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_unless(Gate::allows('user_index'), 403);
        $userData = User::all();
        return view('admin.user.index', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('user_create'), 403);
        $roles = Role::all();
        // dd($roles);
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        

        $data = $request->validate(
            [
                'name' => 'required',
                'password' => 'required|min:4',
                'confirm_password' => 'required|min:4|same:password',
                'email' => 'required|email|unique:users'
            ],
            [
                'name.required' => 'The Name field is required.',
                'password.required' => 'The Password field is required.',
                'confirm_password.required' => 'The Confirm Password field is required.',
                'password.same' => 'The Password and Confirm Password must match.',
                'email.required' => 'The Email field is required.',
                'email.email' => 'The Email must be a valid email address.'
            ]
        );

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->syncRoles($request->input('roles'));
        // dd($data);


        return redirect()->route('user.index')->withSuccess('User Add successfully.');
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

        abort_unless(Gate::allows('user_edit'), 403);

        $user = User::find($id);
        $roles = Role::all();
        $user_role = $user->roles->pluck('name')->toArray();
        return view('admin.user.edit', compact('user', 'roles', 'user_role'));
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
        // echo $id;
        $password = $request->password;
        // echo $password;
        // die();

        // dd($request->all());

        if(!$password) {
            $data = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email'
                ],
                [
                    'name.required' => 'The Name field is required.',
                    'email.required' => 'The Email field is required.',
                    'email.email' => 'The Email must be a valid email address.'
                ]
            );
            User::whereId($id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);


        } else {
            $data = $request->validate(
                [
                    'name' => 'required',
                    'password' => 'required|min:4',
                    'confirm_password' => 'required|min:4|same:password',
                    'email' => 'required|email'
                ],
                [
                    'name.required' => 'The Name field is required.',
                    'password.required' => 'The Password field is required.',
                    'confirm_password.required' => 'The Confirm Password field is required.',
                    'password.same' => 'The Password and Confirm Password must match.',
                    'email.required' => 'The Email field is required.',
                    'email.email' => 'The Email must be a valid email address.'
                ]
            );
            $data['password'] = Hash::make($data['password']);
            User::whereId($id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
        }



        $user = User::findOrFail($id);
        $user->syncRoles($request->input('roles'));
        return redirect()->route('user.index')->withSuccess('User Update successfully.');

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
        $user = User::find($id);

        // dd($user);

        $user->syncRoles([]);
        // $user->save();

        $user->delete();

        return redirect()->route('user.index')->withSuccess('User DELETE Successfully.');
    }
}
