<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\MultipleChoiceQuestion;
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
    
    public function dashboard(){
        $exams = Exam::all();
        return view('dashboard')->with('exams', $exams);
    }  
    
    public function student_exam($exam_id){
      try {
        $exam = Exam::find($exam_id);
        $questions = MultipleChoiceQuestion::where('exam_id', $exam->id)->get();
        if (count($questions) > 0) {
            return view('pages.student-exam')
                    ->with('questions', $questions)
                    ->with('exam', $exam);
        }
        Toastr::error('This exam has no any question', 'Error');
        return redirect()->back();
      } catch (Exception $e) {
        Toastr::error('something went wrong', 'Error');
        return redirect()->back();
      }
    }
}
