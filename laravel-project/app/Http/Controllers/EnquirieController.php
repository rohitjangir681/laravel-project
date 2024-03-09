<?php

namespace App\Http\Controllers;

use App\Models\Enquirie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class EnquirieController extends Controller
{

    public function index() {
        abort_unless(Gate::allows('enquiry_list'), 403);
        $enquiries = Enquirie::all();
        return view('web.enquirie', compact('enquiries'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $data = $request->except('_token');
        // dd($data);

        $test = Enquirie::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 1
        ]);
        // dd($test);
        return back()->withSuccess('Enquirie Send Successfully.');
    }

    public function enquiriyStatus(Request $request) {
        // echo $id;
        // print_r($request->all());

        $status_id = $request->status_id;

        Enquirie::where('id', $status_id)->update([
            'status' => 2
        ]);

        echo "<button class='btn btn-success'>Read</button>";

    }


    // public function enquiriyCount() {
    //     $enquiryCount = Enquirie::count();
    //     return view('includes.header', compact('enquiryCount'));
    // }

    



}
