<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Student;
use App\SubjectScores;
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
    public function studentDatatable() {

        $rawStudents = Student::all();
        $students = array();
        foreach($rawStudents as $rawStudent){
            $student = array();

            $id = $rawStudent['id'];
            $firstName = $rawStudent['firstname'];
            $lastName = $rawStudent['lastname'];
            $otherName = $rawStudent['othername'];
            $gender = $rawStudent['gender'];
            $mobileNumber = $rawStudent['mobile_number'];
            $DOB = $rawStudent['DOB'];
            $nationality = $rawStudent['nationality'];
            $creation = $rawStudent['created_at'];

            // construct a fullname variable here
            $fullName = $firstName. ' ' . $otherName . ' '. $lastName;
            // inject records into student array
            $student['id'] = $id;
            $student['fullname'] = $fullName;
            $student['gender'] = $gender;
            $student['mobile_number'] = $mobileNumber;
            $student['DOB'] = $DOB;
            $student['nationality'] = $nationality;
            $student['created_at'] = $creation;
            //push student array into students array
            array_push($students, $student);

        }
        return Datatables::of($students)
                ->editColumn('created_at', function($data){
                    return date('d F Y', strtotime($data['created_at']));
                })
                ->addColumn('actions', function($data){
                     return "<a class='btn btn-primary' href='/student/" . $data['id'] . "/scoresheet/1/1'>Scores</a> <a class='btn btn-danger' href='/student/" . $data['id'] . "/delete'>Delete</a>";
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */

    public function ScoresDatatable(){

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
            return view('student.index');
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
        return view('student.create');
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
    public function showSubjectScores($id, $session, $term)
    {
       

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            if(Auth::user()->isAdmin){
               $response = Student::where('id', $id)->delete(); 
               if(!$response) {
                   return Redirect::to('/student')
                   ->with('status', 'Failed to delete');
               }
               return Redirect::to('/student')
                ->with('status', 'Deleted Successfully');
            }
            return Redirect::to('/student')
                ->with('status', 'Insufficient priviledge');
    }
}
