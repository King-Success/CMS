<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectMapping;
use App\Teacher;
use App\SchoolClass;
use App\Session;
use App\Term;
use App\ClassOptions;
use Auth;
use Validator;
use Redirect;
use Input;

class SubjectMappingController extends Controller
{
    public function assignToTeacher($subject_name, $teacher_id, $class_id, $session_id, $term_id, $class_options_id = null) {
        $user = Auth::user();
        if($user->isAdmin){
            $subjectMap = DB::table('users')->where([
                ['subject_name', '=', $subject_name],
                ['class_id', '=', $class_id],
                ['session_id', '=', $session_id],
                ['term_name', '=', $term_name]
            ])->get();

        if($subjectMap) {
            $subjectMap->teacher_id = $teacher_id;
            $subjectMap->save();
            return Redirect::to('/subject/mapping')
                    ->with('status', 'Subject Reallocated Successfully');
        }
        
        $subjectMap = SubjectMapping::create(Input::all());
        if($subjectMap){
            return Redirect::to('subject/mapping')
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
    public function subjectMappingDatatable() {

        $rawSubjectMappings = SubjectMapping::all();
        $subjectMappings = array();
        foreach($rawSubjectMappings as $rawSubjectMapping){
            $subjectMapping = array();

            $id = $rawSubjectMapping['id'];
            $subject = $rawSubjectMapping['subject'];
            $teacher = $rawSubjectMapping['teacher'];
            $class = $rawSubjectMapping['class'];
            $creation = $rawSubject['created_at'];
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
                     return "<a class='btn btn-primary' data-toggle='modal' data-target='#editSubjectModal'><i class='fa fa-edit'></i></a> <a class='btn btn-danger' href='/subject/mapping/" . $data['id'] . "/delete'><i class='fa fa-trash'></i></a>";
                })
                ->rawColumns(['actions'])
                ->make(true);
    }
}
