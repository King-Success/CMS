<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\SubjectScores;
use App\Subject;
use Auth;
use Validator;
use Redirect;
use Input;
use Yajra\Datatables\Datatables;


class SubjectScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $session, $term)
    {
        $user = Auth::user();
        if($user->isAdmin || $user->isStaff) {
            $student = Student::find($id);
            $subjects = $student->subjects;
            return view('scoresheet.create')
                ->with('data', $subjects)
                ->with('id', $id)
                ->with('session', $session)
                ->with('term', $term);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $session, $term)
    {
        $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
            $inputs = $request->all();
            // dd($inputs);
            //get the the data sent through the create form
            $subject_id = $inputs['subject_id'];
            $CA1 = $inputs['CA1'];
            $CA2 = $inputs['CA2'];
            $CA3 = $inputs['CA3'];
            $CA4 = $inputs['CA4'];
            $CA5 = $inputs['CA5'];
            $exam = $inputs['exam'];
            //get the data required but not sent through the create from
            $student = Student::find($id); 
            $student_id = $student->id;
            $class_id = $student->class->id;
            // $class_option_id = $student->classOption->id;

            foreach($subject_id as $index => $id){
                $subjectScore = new SubjectScores;

                $subjectScore->student_id = $student_id;
                $subjectScore->subject_id = $id;
                $subjectScore->class_id = $class_id;
                // $subjectScore->class_options_id = $class_option_id;
                $subjectScore->teacher_id = $id;
                $subjectScore->session_id = $session;
                $subjectScore->term_id = $term;
                $subjectScore->CA1 = $CA1[$index];
                $subjectScore->CA2 = $CA2[$index];
                $subjectScore->CA3 = $CA3[$index];
                $subjectScore->CA4 = $CA4[$index];
                $subjectScore->CA5 = $CA5[$index];
                $subjectScore->exam = $exam[$index];

                $saved = $subjectScore->save();
            }
            if($saved){
                return redirect::to('/student')
                    ->with('status', 'Record Created successfully');
            }

            return redirect::to('/student/' . $id . '/scoresheet/' . $session . '/' . $term . '/create')
                ->with('status', 'Record Creation Failed')
                ->withInput(Input::all());
            
        }
        return redirect::to('/student')
            ->with('status', 'Insufficient Privilege');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $session, $term)
    {
        // check if the current authenticated user has priviledge to view this resource
         $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
            //if yes collect all the scores for the various subjects plus additional details from other tables
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
                'subject_scores.id as subject_record_id',
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
            //if there are no records, fetch all the subjects to be offered and display empty score fields
            if(count($subjectScores) == 0){
               return redirect::to('/student/' . $id . '/scoresheet/' . $session . '/' . $term . '/create');
            }
            //else return the exiting records for editing or display
             return view('scoresheet.edit')
                    ->with('data', $subjectScores)
                    ->with('id', $id);
            

            
        }

        return redirect::to('/home')
            ->with('status', 'Insufficient privilege');
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
        $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
            $inputs = $request->all();
            // dd($inputs);
            $subject_record_id = $inputs['subject_record_id'];
            $CA1 = $inputs['CA1'];
            $CA2 = $inputs['CA2'];
            $CA3 = $inputs['CA3'];
            $CA4 = $inputs['CA4'];
            $CA5 = $inputs['CA5'];
            $exam = $inputs['exam'];
            foreach($subject_record_id as $index => $id){
                $subjectScore = SubjectScores::find($id);

                $subjectScore->CA1 = $CA1[$index];
                $subjectScore->CA2 = $CA2[$index];
                $subjectScore->CA3 = $CA3[$index];
                $subjectScore->CA4 = $CA4[$index];
                $subjectScore->CA5 = $CA5[$index];
                $subjectScore->exam = $exam[$index];

                $subjectScore->save();
            }
            return redirect::to('/student')
                ->with('status', 'Record updated successfully');
        }
            // return redirect::to('/')
        
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
