<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Student::all();
        return view('student.index', [
            'all_data' => $all_data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Image Upload
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $unique_file_name = md5(time().rand()).'.'. $img -> getClientOriginalExtension();
            $img -> move(public_path('media/students'), $unique_file_name);
        }

        Student::create([
            'name' => $request -> name,
            'roll' => $request -> roll,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'photo' => $unique_file_name,
        ]);
        return redirect() -> back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $single_student = Student::find($id);

        return [
            'name' => $single_student -> name,
            'roll' => $single_student -> roll,
            'email' => $single_student -> email,
            'cell' => $single_student -> cell,
            'photo' => $single_student -> photo,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_id = Student::find($id);

        return [
            'name' => $student_id -> name,
            'roll' => $student_id -> roll,
            'email' => $student_id -> email,
            'cell' => $student_id -> cell,
            'photo' => $student_id -> photo,
        ];

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
        $update_data = Student::find($id);

//        //Upload Image
//        if ($request -> hasFile('photo')){
//            $img = $request -> file('photo');
//            $unique_file_name = md5(time().rand()).'.'. $img -> getClientOriginalExtension();
//            $img -> move(public_path('media/students'), $unique_file_name);
////            unlink('media/students/'.$request->photo);
//        }

        $update_data -> name = $request -> name;
        $update_data -> roll = $request -> roll;
        $update_data -> email = $request -> email;
        $update_data -> cell = $request -> cell;
//        $update_data -> photo = $unique_file_name;
        $update_data -> update();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_student = Student::find($id);
        $delete_student -> delete();
        unlink('media/students/'.$delete_student->photo);

        return back();
    }

    /*
     * Show All Student Data
     */
//    public function allStudent(){
//        $all_data = Student::all();
//
//        $id = 1;
//        foreach ($all_data as $data) {
//
//        }
//
//    }
}
