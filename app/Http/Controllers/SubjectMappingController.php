<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectMapping;
use App\Teacher;
use App\SchoolClass;
use App\Session;
use App\Staff;
use App\Term;
use App\ClassOptions;
use Auth;
use Validator;
use Redirect;
use Route;
use Input;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Response;

class SubjectMappingController extends Controller
{
    public function assignToTeacher(Request $request) {
        // dd($request->all());
        $user = Auth::user();
        if($user->isAdmin){
            $subject_name = $request->subject;
            $teacher_id = $request->teacher_id;
            $class_id = $request->class_id;
            $session_id = $request->session_id;
            $term_id = $request->term_id;

            $searchForSubjectMap = SubjectMapping::where([
                ['subject', '=', $subject_name],
                ['class_id', '=', $class_id],
                ['session_id', '=', $session_id],
                ['term_id', '=', $term_id]
            ])->get();
        if($searchForSubjectMap->all() != null) {
            // if record already exist, get the main content from the collection
            $content = $searchForSubjectMap->all();
            $contentId = $content[0]['id'];
            // since I cant call save method on searchForSubjectMap collection, I will find the record using eloquent 
            // so that I can easily update with save method
            $getSubjectMap = SubjectMapping::find($contentId);
            $getSubjectMap->teacher_id = $teacher_id;
            $response = $getSubjectMap->save();

            if($response){
                return Redirect::to('subject/mapping/')
                    ->with('status', 'Subject Reallocated Successfully');
            }
        }
            // otherwise create a new record
        $subjectMap = new SubjectMapping;

        $subjectMap->subject = $subject_name;
        $subjectMap->teacher_id = $teacher_id;
        $subjectMap->class_id = $class_id;
        $subjectMap->class_options_id = null;
        $subjectMap->session_id = $session_id;
        $subjectMap->term_id = $term_id;

        $response = $subjectMap->save();

        if($response){
            return Redirect::to('subject/mapping/')
                    ->with('status', 'Subject Allocated Successfully');
        }

        return Redirect::to('status', 'Subject Allocation Failed');
        }
    
    }

     /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function subjectMappingDatatable($class_id) {

        $rawSubjectMappings = SubjectMapping::where('class_id', '=', $class_id)
            ->get();
        $subjectMappings = array();
        foreach($rawSubjectMappings as $rawSubjectMapping){
            $subjectMapping = array();

            $id = $rawSubjectMapping['id'];
            $subject = $rawSubjectMapping['subject'];
            $teacher_id = $rawSubjectMapping['teacher_id'];
            $class_id = $rawSubjectMapping['class_id'];
            $creation = $rawSubjectMapping['created_at'];
            // get the name of teacher and class from respective models for display
            $staff_id = Teacher::find($teacher_id)->staff_id;
            // teacher is gotten from staff table so we still need to look into staff table to get full details
            $rawTeacher = Staff::select('firstname', 'lastname')
                ->where('id', '=', $staff_id)
                ->get();
            $rawTeacher = $rawTeacher[0];
            $teacher = $rawTeacher->firstname . ' ' . $rawTeacher->lastname;
            $class = SchoolClass::find($class_id)->name;
            // inject records into subjectMapping array
            $subjectMapping['id'] = $id;
            $subjectMapping['subject'] = $subject;
            $subjectMapping['teacher'] = $teacher;
            $subjectMapping['class'] = $class;
            $subjectMapping['created_at'] = $creation;
            //push subjectMapping array into subjectMappings array
            array_push($subjectMappings, $subjectMapping);

        }
        return Datatables::of($subjectMappings)
                ->editColumn('created_at', function($data){
                    return date('d F Y', strtotime($data['created_at']));
                })
                ->addColumn('actions', function($data){
                     return "<a class='btn btn-primary' data-toggle='modal' data-target='#editSubjectMappingModal'><i class='fa fa-edit'></i></a> <a class='btn btn-danger' href='/subject/mapping/" . $data['id'] . "/delete'><i class='fa fa-trash'></i></a>";
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    public function index() {
        $user = Auth::user();
        if($user->isAdmin) {
            return view('subjectMapping.index');
        }
    }

    public function update(Request $request, $id) {
        dd($request->getContent());
    }
}
