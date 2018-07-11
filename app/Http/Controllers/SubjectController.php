<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectScores;
use Auth;
use Validator;
use Redirect;
use Input;
use Yajra\Datatables\Datatables;

class SubjectController extends Controller
{

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function subjectDatatable() {

        $rawSubjects = Subject::all();
        $subjects = array();
        foreach($rawSubjects as $rawSubject){
            $subject = array();

            $id = $rawSubject['id'];
            $name = $rawSubject['name'];
            $creation = $rawSubject['created_at'];
            // inject records into subject array
            $subject['id'] = $id;
            $subject['name'] = $name;
            $subject['created_at'] = $creation;
            //push subject array into subjects array
            // dd($subject);
            array_push($subjects, $subject);

        }
        return Datatables::of($subjects)
                ->editColumn('created_at', function($data){
                    return date('d F Y', strtotime($data['created_at']));
                })
                ->addColumn('actions', function($data){
                     return "<a class='btn btn-primary' href='/subject/" . $data['id'] . "/scoresheet/1/1/edit'>Edit</a> <a class='btn btn-danger' href='/subject/" . $data['id'] . "/delete'>Delete</a>";
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
        if($user->isAdmin){
            return view('subject.index');
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
        //
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
