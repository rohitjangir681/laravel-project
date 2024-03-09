<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // echo "yes";
        $users = User::where('is_admin', 0)->get();

        return response()->json($users);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "yes";

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $validator->errors()], 422);
        }

        $data = $request->all();
        // print_r($request->all());
        $user = User::create($data);
        return response()->json(['status' => true, 'data' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = User::findOrFail($id);
        $usre = $data->update($request->all());
        return response()->json($usre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $user = $data->delete();
        return response()->json($user);
    }
}
