<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::all();
        // $students = Student::paginate(3);
        return view("student.index", compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("student.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data["hobbies"] = implode(',', $data["hobbies"]);
        $data["qualification"] = implode(',', $data["qualification"]);
        // $request->hobbies;
        Student::create($data);

        return redirect()->route('student.index')->withSuccess('Data Created Successfully...');

        // dd($student);
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
    // public function edit(Student $student)
    // public function edit($id)
    {
        // echo $id;
        // dd($id);
        $stData = Student::find($id);
        // dd($stData);
        // $stData = Student::where('id', $id)->first();
        return view('student.edit', compact('stData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request, Student $student)
    {
        // dd($request->all());
        $data = $request->except('_token', '_method'); 
        $data['hobbies'] = implode(',', $data['hobbies']);
        $data['qualification'] = implode(',', $data['qualification']);
        $student->update($data);
        return redirect()->route('student.index')->withSuccess('Data Update Successfully...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // echo $id;
        $student->delete();
        return redirect()->route('student.index')->withSuccess('Delete Successfully....');
    }
}
