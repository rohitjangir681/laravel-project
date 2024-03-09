<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city_data = City::all();
        return view("city.index", compact('city_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $countryData = Country::select('id', 'name')->get();
        // dd($countryData);
        
        return view("city.create", compact('countryData',));
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
        $cityData = $request->except("_token");
        City::create($cityData);
        return redirect()->route('city.index')->withSuccess('City add successfully...');

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
        $cityData = City::find($id);
        // dd($cityData);
        $countryData = Country::where('status', 1)->get();
        // dd($countryData);
        $stateData = State::where('state_status', 1)->where('country_id', $cityData->country_id)->get();
        return view("city.edit", compact("cityData", "stateData", "countryData"));
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
        // dd($request->all());
        $cityData = $request->except('_token', '_method');
        // dd($cityData);
        City::where('id', $id)->update($cityData);
        return redirect()->route('city.index');
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
        City::where('id', $id)->delete();
        return redirect()->route('city.index');
    }
}
