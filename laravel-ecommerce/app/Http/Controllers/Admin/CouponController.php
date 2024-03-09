<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('coupon_index'), 403);
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('coupon_create'), 403);
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'discount_amount' => 'required'
        ]);

        $data = $request->all();

        Coupon::create($data);

        return redirect()->route('coupon.index')->with('success', 'Coupon has been added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('coupon_edit'), 403);
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'coupon_code' => 'required|unique:coupons,coupon_code,' . $id,
            'valid_from' => 'required',
            'valid_to' => 'required',
            'discount_amount' => 'required'
        ]);

        $data = Coupon::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}
