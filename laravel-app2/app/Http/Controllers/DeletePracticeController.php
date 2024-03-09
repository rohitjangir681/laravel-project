<?php

namespace App\Http\Controllers;

use App\Models\Delete;
use Illuminate\Http\Request;

class DeletePracticeController extends Controller
{
    public function index() {
        $data = Delete::all();
        return view('delete', compact('data'));
    }

    public function store(Request $request) {
        $data = $request->except('_token');
        // dd($data);
        Delete::create($data);
        return back();
    }

    public function destroy($id) {
        Delete::where('id', $id)->delete();
        return back();
    }

    public function show($id) {
        // echo $id;
        // print_r($id);
        $data = Delete::where('id', $id)->get();
        // dd($data);
        return view('delete-show',compact('data'));
    }
}
