<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_unless(Gate::allows('slider_index'), 403);

        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('slider_create'), 403);
        return view('admin.slider.create');
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
        
        $data = $request->except('_token', 'image');
        // dd($data);
        

        $sliderData = Slider::create($data);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $sliderData->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('slider.index')->withSuccess('Slider Add Successfully.');
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
        abort_unless(Gate::allows('slider_edit'), 403);
        $data = Slider::find($id);
        return view('admin.slider.edit', compact('data'));
        
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

        // $test =  $request->image;
        // dd($test);
        // die();

        $data = $request->except('_token', '_method', 'image');
        // dd($data);
        $sliderData = Slider::findOrFail($id);
        $sliderData->update($data);

        if ($request->hasFile('image')) {
            $sliderData->clearMediaCollection('image');
            $sliderData->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('slider.index')->withSuccess('Slider Update Successfully.');
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
        Slider::where('id', $id)->delete();
        return redirect()->route('slider.index')->withSuccess('Slider Delete Successfully.');
    }
}
