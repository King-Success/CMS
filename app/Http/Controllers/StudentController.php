<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Student;
use Auth;
use Validator;
use Redirect;
use Input;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function yajraAjaxSearch() {
        return Datatables::of(Student::all())->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
            return view('student');
        }
        return Redirect::to('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
            $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'othername' => 'required',
            'gender' => 'required',
            'DOB' => 'required',
            'mobile_number' => 'required|numeric',
            'nationality' => 'required',
            'state' => 'required',
            'LGA' => 'required',
            'religion' => 'required',
            'class_id' => 'required|integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/student/create')
                ->with('status', 'Student creation Failed')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $student = Student::create(Input::all());
            return Redirect::to('/student')
                ->with('status', 'Created Successfully');
        }
    }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
