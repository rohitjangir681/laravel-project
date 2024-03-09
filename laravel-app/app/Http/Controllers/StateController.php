<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        return view("state.index", compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryData = Country::select('id', 'name')->get();

        return view('state.create', compact('countryData'));
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
        $countryId = $request->country_id;
        $stateName = $request->state_name;
        $stateStatus = $request->state_status;

        $stateData = State::create([
            'state_name' => $stateName,
            'state_status' => $stateStatus,
            'country_id' => $countryId
        ]);

        $stateId = $stateData->id;
        // dd($stateData);

        $cityName = $request->city_name;
        $cityStatus = $request->city_status;

        foreach($cityName as $key => $_cityName)
        {
            City::create([
                'city_name' => $_cityName,
                'city_status' => $cityStatus[$key],
                'state_id' => $stateId,
                'country_id' => $countryId
            ]);
        }

        return redirect()->route('state.index');

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
        $stateData = State::find($id);
        $countryData = Country::where('status', 1)->get();
        return view('state.edit', compact('stateData', 'countryData'));
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
        // dd($request->all());
        $countryId = $request->country_id;
        $stateName = $request->state_name;
        $stateStatus = $request->state_status;

        State::where('id', $id)->update([
            'state_name' => $stateName,
            'state_status' => $stateStatus,
            'country_id' => $countryId
        ]);

        $cityName = $request->city_name;
        $cityStatus = $request->city_status;
        $cityId = $request->city_id;

        if(empty($cityId)) {
            City::where('state_id', $id)->delete();
        } else {
            City::whereNotIn('id', $cityId)->where('state_id', $id)->delete();
        }

    if(!empty($cityName)){
        foreach($cityName as $key => $_cityName) {
            $cid = $cityId[$key]??0;
            if($cid){
            City::where('id', $cid)->update([
                'city_name' => $_cityName,
                'city_status' => $cityStatus[$key],
                'country_id' => $countryId
            ]);
            } else {
                City::create([
                    'city_name' => $_cityName,
                    'city_status' => $cityStatus[$key],
                    'state_id' => $id,
                    'country_id' => $countryId
                ]);
            }
        }
    }

    return redirect()->route('state.index');

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
        State::where('id', $id)->delete();
        City::where('state_id', $id)->delete();
        return redirect()->route('state.index');
    }

   
}
