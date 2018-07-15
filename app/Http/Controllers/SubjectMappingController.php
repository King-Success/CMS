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
}
