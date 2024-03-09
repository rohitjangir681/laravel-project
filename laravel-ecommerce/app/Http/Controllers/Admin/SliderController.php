<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('slider_index'), 403);
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('slider_create'), 403);
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required'
        ]);
        $sliderData = Slider::create($data);

        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $sliderData->addMediaFromRequest('image')->toMediaCollection('image');
        }
        
        return redirect()->route('slider.index')->withSuccess('Slider add successfully.');
    
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
        // echo $id;
        abort_unless(Gate::allows('slider_edit'), 403);
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required'
        ]);

        $slider = Slider::findOrFail($id);

        $slider->update($data);

        if ($request->hasFile('image')) {
            $slider->clearMediaCollection('image');
            $slider->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('slider.index')->withSuccess('Slider updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slider::where('id', $id)->delete();

        return redirect()->back()->withSuccess('Slider deleted successfully.');
    }
}
