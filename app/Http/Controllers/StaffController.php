<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\SubjectScores;
use Auth;
use Validator;
use Redirect;
use Input;
use Yajra\Datatables\Datatables;

class StaffController extends Controller
{

    public function staffDatatable() {

        $rawStaffs = Staff::all();
        $staffs = array();
        foreach($rawStaffs as $rawStaff){
            $staff = array();

            $id = $rawStaff['id'];
            $firstName = $rawStaff['firstname'];
            $lastName = $rawStaff['lastname'];
            $otherName = $rawStaff['othername'];
            $gender = $rawStaff['gender'];
            $status = $rawStaff['status'];
            $mobileNumber = $rawStaff['mobile_number'];
            $nationality = $rawStaff['nationality'];
            $state = $rawStaff['state'];
            $LGA = $rawStaff['LGA'];
            $staff_type_id = $rawStaff['staff_type_id'];
            $email = $rawStaff['email'];
            $password = $rawStaff['password'];
            $creation = $rawStaff['created_at'];

            //get staff type from staff_type table through staff_type_id
            $staff_type = Staff::find($id)->staffType;

            // construct a fullname variable here
            $fullName = $firstName. ' ' . $otherName . ' '. $lastName;
            // inject records into staff array
            $staff['id'] = $id;
            $staff['fullname'] = $fullName;
            $staff['gender'] = $gender;
            $staff['status'] = $status;
            $staff['mobile_number'] = $mobileNumber;
            $staff['nationality'] = $nationality;
            $staff['state'] = $state;
            $staff['LGA'] = $LGA;
            $staff['staff_type'] = $staff_type['name'];
            $staff['staff_type_id'] = $staff_type_id;
            $staff['email'] = $email;
            $staff['password'] = $password;
            $staff['created_at'] = $creation;
            //push staff array into staffs array
            array_push($staffs, $staff);

        }
        return Datatables::of($staffs)
                ->editColumn('created_at', function($data){
                    return date('d F Y', strtotime($data['created_at']));
                })
                ->addColumn('actions', function($data){
                     return "<a class='btn btn-primary' data-toggle='modal' data-target='#editStaffModal'><i class='fa fa-edit'></i></a> <a class='btn btn-danger' href='/staff/" . $data['id'] . "/delete'><i class='fa fa-trash'></i></a>";
                })
                ->rawColumns(['actions'])
                ->make(true);
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
            return view('staff.index');
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
        return view('staff.create');
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
            'status' => 'required',
            'mobile_number' => 'required|numeric',
            'nationality' => 'required',
            'state' => 'required',
            'LGA' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/staff/create')
                ->with('status', 'Staff creation Failed')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $staff = Staff::create(Input::all());
            return Redirect::to('/staff')
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
        if(Auth::user()->isAdmin){
               $response = Staff::where('id', $id)->delete(); 
               if(!$response) {
                   return Redirect::to('/staff')
                   ->with('status', 'Failed to delete');
               }
               return Redirect::to('/staff')
                ->with('status', 'Deleted Successfully');
            }
            return Redirect::to('/staff')
                ->with('status', 'Insufficient priviledge');
    }
}
