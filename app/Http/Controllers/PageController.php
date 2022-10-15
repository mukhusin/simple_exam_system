<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\MultipleChoiceQuestion;
use App\Models\ResultGrade;
use App\Models\StudentMarkedQuestion;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function users(){
        $users = User::all();
        return view('pages.users')->with('users', $users);
    } 
    
    public function students(){
        $users = User::where('role','student')->get();
        return view('pages.student')->with('users', $users);
    }
    public function exams(){
        $exams = Exam::all();
        return view('pages.exams')->with('exams', $exams);
    }   
    
    public function grade(){
        $grades = ResultGrade::all();
        return view('pages.grade')->with('grades', $grades);
    }  
    
    public function dashboard(){
        $exams = Exam::all();
        return view('dashboard')->with('exams', $exams);
    }  
    
    public function student_exam($exam_id){
      try {
        $exam = Exam::find($exam_id);
        $questions = MultipleChoiceQuestion::where('exam_id', $exam->id)->get();
        $result = ExamResult::where('exam_id', $exam->id)->where('student_id', auth()->user()->id)->first();
        $marked_question = StudentMarkedQuestion::where('exam_id', $exam->id)->where('student_id', auth()->user()->id)->get();
        if (count($questions) > 0) {
            return view('pages.student-exam')
                    ->with('result', $result)
                    ->with('marked_question', $marked_question)
                    ->with('questions', $questions)
                    ->with('exam', $exam);
        }
        Toastr::error('This exam has no any question', 'Error');
        return redirect()->back();
      } catch (Exception $e) {
        Toastr::error('something went wrong: '.$e->getMessage(), 'Error');
        return redirect()->back();
      }
    } 

    public function student_exam_results($exam_id){
      try {
        $exam = Exam::find($exam_id);
        $results = ExamResult::where('exam_id', $exam->id)->get();
        return view('pages.student_exam_results')
        ->with('results', $results)
        ->with('exam', $exam);
      } catch (Exception $e) {
        Toastr::error('something went wrong: '.$e->getMessage(), 'Error');
        return redirect()->back();
      }
    }

    public function student_exam_result($exam_id, $student_id){
        try {
            $exam = Exam::find($exam_id);
            $questions = MultipleChoiceQuestion::where('exam_id', $exam->id)->get();
            $result = ExamResult::where('exam_id', $exam->id)->where('student_id', $student_id)->first();
            $marked_question = StudentMarkedQuestion::where('exam_id', $exam->id)->where('student_id', $student_id)->get();
            if (count($questions) > 0 && $result) {
                return view('pages.student-exam')
                        ->with('result', $result)
                        ->with('marked_question', $marked_question)
                        ->with('questions', $questions)
                        ->with('exam', $exam);
            }
            Toastr::error('This exam has no any question or results', 'Error');
            return redirect()->back();
          } catch (Exception $e) {
            Toastr::error('something went wrong: '.$e->getMessage(), 'Error');
            return redirect()->back();
          }
    }
}
