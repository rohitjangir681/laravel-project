<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrys = Country::all();
        return view('country.index', compact('countrys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // dd($data["state_name"]);

        $countryData = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        $countryCreate = Country::create($countryData);


        $coutryId = $countryCreate->id;

        // $data = $request->all();

        $stateName = $request->input('state_name');
        $stateStatus = $request->input('state_status');

        foreach ($stateName as $key => $_stateName) {
            $state_Status = $stateStatus[$key];
            State::create([
                'country_id' => $coutryId,
                'state_name' => $_stateName,
                'state_status' => $state_Status
            ]);
        }

        // dd($data['state_name']);

        return redirect()->route('country.index')->withSuccess('Country Add successfully...');


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
        $countryData = Country::find($id);
        // $countryData = Country::where('id', $id)->with('states')->first();
        //$stateData = State::where('country_id', $id)->get();
        // dd($stateData);

        
        // return $countryData;

        return view("country.edit", compact('countryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // $data = $request->except('_token', '_method');

        Country::whereId($id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);


        $stateId = $request->state_id;
        

if(empty($stateId)) {
    State::where('country_id', $id)->delete();
} else {
    State::whereNotIn('id', $stateId)->where('country_id', $id)->delete();
}


        // if(!empty($stateId)) {
        //     State::whereNotIn('id', $stateId)->where('country_id', $id)->delete();
        // } 


        $stateName = $request->state_name;
        $stateStatus = $request->state_status;
        
        // dd($stateId);
        if(!empty($stateName)) {
        foreach($stateName as $key => $_stateName) {
            $stId = $stateId[$key]??0;
            if($stId) {
                State::where('id', $stId)->update([
                    'state_name' => $_stateName,
                    'state_status' => $stateStatus[$key]
                ]);
            } else {
                State::create([
                    'state_name' => $_stateName,
                    'state_status' => $stateStatus[$key],
                    'country_id' => $id
                ]);
            }
        }
    }
    
        return redirect()->route("country.index")->withSuccess('Updated Successfully...');
        
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
        Country::where('id', $id)->delete();
        State::where('country_id', $id)->delete();
        City::where('country_id', $id)->delete();
        // $country->delete();
        return redirect()->route('country.index')->withSuccess("Delete successfully...");

    }

    public function getState(Request $request)
    {

        // echo $request->cnt_id;
        $countryId =  $request->cnt_id;
        $states = State::where('country_id', $countryId)->where('state_status', 1)->get();
        foreach ($states as $_state) {
            echo '<option value="'.$_state->id.'">'.$_state->state_name.'</option>';
        }
    }

    
}
