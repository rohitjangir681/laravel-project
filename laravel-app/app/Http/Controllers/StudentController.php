<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentQualification;
use Symfony\Component\Console\Input\Input;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = Student::all();
        $students = Student::paginate(3);
        // $students = Student::where('id', 1234567)->get();
        return view("student.index", compact("students"));
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



        // return $request->all();

        // die();

        $request->validate(
            [
                'first_name' => 'required',
                'email' => 'required|email|unique:students',
                'gender' => 'required',
                'hobbies' => 'required',
                'board.*' => 'required'
            ],
            [
                'first_name.required' => 'Please enter name'
            ]
        );


        $data = $request->all();
        $data['hobbies'] = implode(',', $data['hobbies'] ?? []);
        // dd($data);
        // dd($data["hobbies"]);
        $student = Student::create($data);
        // dd($student->id);
        $studentId = $student->id;
        $examination = $request->examination;
        $board = $request->board;
        $percentage = $request->percentage;
        $year_of_passing = $request->year_of_passing;

        foreach ($examination as $key => $_examination) {
            // echo "<br>" . $studentId;

            StudentQualification::create([
                'examination' => $_examination,
                'board' => $board[$key],
                'percentage' => $percentage[$key],
                'year_of_passing' => $year_of_passing[$key],
                'student_id' => $studentId
            ]);
        }
        return redirect()->route('student.index')->withSuccess('Data Successfully added...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentData = Student::where('id', $id)->get();
        return view("student.show", compact('studentData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // ----------------------------------------------
    // public function edit(Student $student)
    public function edit($id)
    {
        // echo $id;
        // $student = Student::select('name', 'email')->where('id', $id)->first();

        $student = Student::find($id);


        // $studentQualif = StudentQualification::where('student_id', $id)->get();

        return view("student.edit", compact('student'));
    }

    // ----------------------------------------------


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request, $id)
    // {
    //     // dd($id);
    //     // $data = $request->all();
    //     $data = $request->except('_token', '_method');
    //     // dd($data);
    //     $student = Student::where('id', $id)->update($data);
    //     return redirect()->route('student.index')->withSuccess('Data updated...');
    // }

    public function update(Request $request, Student $student)
    {

        // dd($request->student_qualif_id);

        $data = $request->except('_token', '_method');
        $data['hobbies'] = implode(',', $data['hobbies']);
        $student->update($data);

        $studentQualifId = $request->student_qualif_id;
        $examination = $request->examination;
        $board = $request->board;
        $percentage = $request->percentage;
        $year_of_passing = $request->year_of_passing;

        foreach ($examination as $key => $_examination) {
            // echo "<br>".$board[$key];
            $stQlId = $studentQualifId[$key];


            StudentQualification::where('id', $stQlId)->update([
                'examination' => $_examination,
                'board' => $board[$key] ?? 0,
                'percentage' => $percentage[$key],
                'year_of_passing' => $year_of_passing[$key]
            ]);
        }

        return redirect()->route('student.index')->withSuccess('Data updated...');
    }

    // ------------------------------------------------------------------
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // ----------------------------------------------------------------

    // public function destroy($id)
    // {
    //     // dd($id);
    //     Student::where('id', $id)->delete();
    //     return redirect()->route('student.index')->withSuccess('Data deleted....');
    // }

    public function destroy(Student $student)
    {
        $stId = $student['id'];
        StudentQualification::where('student_id', $stId)->delete();
        $student->delete();
        return redirect()->route('student.index')->withSuccess('Data deleted....');
    }
    // ----------------------------------------------------------------

}


