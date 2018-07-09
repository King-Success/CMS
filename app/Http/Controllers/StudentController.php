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
                     return "<a class='btn btn-primary' href='/student/" . $data['id'] . "/scoresheet'>Scores</a> <a class='btn btn-danger' href='/student/" . $data['id'] . "/delete'>Delete</a>";
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
            return view('student.student');
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
    public function showSubjectScores($id, $session, $term)
    {
        $user = Auth::user();
        if($user->isAdmin || $user->isStaf){
            $subjectScores = SubjectScores::leftJoin('students', 'subject_scores.student_id', '=', 'students.id')
            ->leftJoin('subjects', 'subject_scores.subject_id', '=', 'subjects.id')
            ->leftJoin('classes', 'subject_scores.class_id', '=', 'classes.id')
            ->leftJoin('class_options', 'subject_scores.class_options_id', '=', 'class_options.id')
            ->leftJoin('teachers', 'subject_scores.teacher_id', '=', 'teachers.id')
            ->leftJoin('sessions', 'subject_scores.session_id', '=', 'sessions.id')
            ->leftJoin('terms', 'subject_scores.term_id', '=', 'terms.id')
            ->where('students.id', '=', $id)
            ->where('sessions.id', '=', $session)
            ->where('terms.id', '=', $term)
            ->select([
                'subject_scores.CA1',
                'subject_scores.CA2',
                'subject_scores.CA3',
                'subject_scores.CA4',
                'subject_scores.CA5',
                'subject_scores.exam',
                'subject_scores.total',
                'subject_scores.position',
                'subject_scores.created_at',
                'subject_scores.updated_at',
                'students.firstname as firstname',
                'students.lastname as lastname',
                'students.othername as othername',
                'subjects.name as subject',
                'classes.name as class',
                'class_options.name as option',
                'teachers.id as teacher',
                'sessions.name as session',
                'terms.name as term'
            ])
            ->get();

            dd($subjectScores);
        }



    //      $result = Vehicle::leftJoin('vehicle_categories','vehicles.vehicle_category_id','=','vehicle_categories.id')
    //      ->leftJoin('vehicle_makes','vehicles.vehicle_make_id','=','vehicle_makes.id')
    //      ->leftJoin('vehicle_types','vehicles.vehicle_type_id','=','vehicle_types.id')
    //      ->leftJoin('net_weights','vehicles.net_weight_id','=','net_weights.id')
    //      ->leftJoin('engine_capacities','vehicles.engine_capacity_id','=','engine_capacities.id')
    //      ->leftJoin('load_weights','vehicles.load_weight_id','=','load_weights.id')
    //      ->leftJoin('clients','vehicles.client_id','=','clients.id')
    //      ->orderBy('id', 'DESC')
    //     ->select([
    //         'vehicles.id',
    //         'clients.full_name as full_name',
    //         'vehicles.unique_evas_id', 
    //         'vehicles.vehicle_reg_no', 
    //         'vehicle_categories.category as category',
    //         'vehicle_makes.vehicle_make as vehicle_make', 
    //         'vehicle_types.type as type',
    //         'net_weights.net_weight as net_weight', 
    //         'engine_capacities.capacity as capacity',
    //         'load_weights.load_weight as load_weight']);
    //         // dd($subjectScores);
    //         // return $subjectScores;
    //         dd($subjectScores);
        // }
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
