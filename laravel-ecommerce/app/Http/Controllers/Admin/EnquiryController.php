<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class EnquiryController extends Controller
{
    public function index() {
        abort_unless(Gate::allows('enquiry'), 403);
        $enquiries = Enquiry::all();
        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function store(Request $request) {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        Enquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 2
        ]);

        return redirect()->back()->withSuccess('Data send successfully.');


    }


    public function enquiriyStatus(Request $request) {
        // echo "ajax call";
        $id = $request->status_id;
        Enquiry::where('id', $id)->update([
            'status' => 1
        ]);
        echo '<button type="button" class="btn btn-primary">Read</button>';
    }

}
