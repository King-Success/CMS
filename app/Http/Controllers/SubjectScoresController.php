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
    public function show($id, $session, $term)
    {
         $user = Auth::user();
        if($user->isAdmin || $user->isStaff){
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
            return view('student.score_form')
                    ->with('data', $subjectScores)
                    ->with('id', $id)
                    ->with('session', $session)
                    ->with('term', $term);

            
        }

        return redirect::to('/home')
            ->with('status', 'Insufficient priviledge');
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
    public function update(Request $request, $id, $session, $term)
    {
        dd('Yesssss');
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
