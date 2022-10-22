<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\MultipleChoiceQuestion;
use App\Models\ResultGrade;
use App\Models\StudentMarkedQuestion;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function exam_manage(Request $request)
    {
            DB::beginTransaction();
        try {
            if ($request->has('mode')) {
                if ($request->mode == "add_exam") {
                    return  $this->add_exam($request);
                }
                if ($request->mode == "update_exam") {
                    return  $this->update_exam($request);
                }

                if ($request->mode == "activate_exam") {
                    return  $this->activate_exam($request);
                }

                if ($request->mode == "update_passege") {
                    return  $this->update_passege($request);
                }

                if ($request->mode == "add_question") {
                    return  $this->add_question($request);
                }

                if ($request->mode == "update_question") {
                    return  $this->update_question($request);
                }

                if ($request->mode == "delete_exam") {
                    return  $this->delete_exam($request);
                }


                if ($request->mode == "delete_question") {
                    return  $this->delete_question($request);
                }

                if ($request->mode == "submit_exam") {
                    return  $this->submit_exam($request);
                }

                if ($request->mode == "gradeAdd") {
                    return  $this->gradeAdd($request);
                }

                if ($request->mode == "gradeUpdate") {
                    return  $this->gradeUpdate($request);
                }

                if ($request->mode == "gradeDelete") {
                    return  $this->gradeDelete($request);
                }
            }
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return $e;
            Toastr::error('Something went wrong !! ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    public function resultPdf($exam_id){
        $exam = Exam::find($exam_id);
        $results = ExamResult::where('exam_id', $exam->id)->get();
        $name = auth()->user()->name;
        $pdf = Pdf::loadView('pdf.exam-result', [
            'results' => $results,
            'name' => $name,
            'exam' => $exam,
        ]);
    
        return  $pdf->stream(now() . 'results.pdf');
       }

    public function submit_exam($request){
        $questions = MultipleChoiceQuestion::where('exam_id', $request->exam_id)->get();
        $exam = Exam::find($request->exam_id);
        foreach ($questions as $key => $value) {
            $mark = new StudentMarkedQuestion();
            $isSaved = DB::table('student_marked_questions')->where('exam_id', $exam->id)->where('student_id', Auth::user()->id)->where('question_id',$value->id)->first();
            if ($isSaved) {
                $mark = $isSaved;
            }
            $mark->student_id = Auth::user()->id;
            $mark->exam_id = $request->exam_id;
            $mark->question_id = $value->id;
            $mark->answer = $_POST['answer'.$value->id];
            $mark->year_done = date('Y');
            if ($_POST['answer'.$value->id] == $value->answer) {
                $mark->isCorrect = true;
                $mark->score = $exam->weight_each;
            }else {
                $mark->isCorrect = false;
                $mark->score = 0;
            }
            $mark->isMarked = true;
            $mark->save();
            
        }
        $total_qn = MultipleChoiceQuestion::where('exam_id', $request->exam_id)->count();
        $marks = $total_qn * $exam->weight_each;
        $total_score = DB::table('student_marked_questions')->where('exam_id', $exam->id)->where('student_id', Auth::user()->id)->sum('score');
        $wastani = $total_score / $marks * 100;
        $grade = DB::table('result_grades')->where('from_marks', '<=', $wastani)->where('to_marks', '>=', $wastani)->first();
        $exam_result = ExamResult::where('student_id',Auth::user()->id)->where('exam_id', $exam->id)->first();
        if ($exam_result) {
            $exam_result->score = $total_score;
            $exam_result->grade = $grade->grade;
            $exam_result->remark = $grade->remark;
            $exam_result->year_done = date('Y');
        }else {
            if (!$grade) {
                if (80 < $wastani && $wastani <= 100) {
                    $grad = "A";
                } elseif (60 < $wastani && $wastani <= 80) {
                    $grad = "B";
                } elseif (41 < $wastani && $wastani <= 60) {
                    $grad = "C";
                } elseif (29 < $wastani && $wastani <= 40) {
                    $grad = "D";
                } elseif (0 == $wastani && $wastani <= 29) {
                    $grad = "F";
                }
                if ($wastani < 45) {
                    $status = "FAIL";
                } else {
                    $status = "PASS";
                }
            }else {
                $grad = $grade->grade;
                $status = $grade->remark;
            }
            ExamResult::create([
                'student_id' => Auth::user()->id,
                'exam_id' => $exam->id,
                'score' => $wastani,
                'grade' => $grad,
                'remark' => $status,
                'year_done' => date('Y'),
            ]);
        }

        DB::commit();

        return redirect()->to('student-exam/'.$exam->id);

    }

    public function continue_make_exam($exam_id)
    {
        $exam = Exam::find($exam_id);
        if ($exam) {
            $questions = MultipleChoiceQuestion::where('exam_id',$exam_id)->get();
            return view('pages.continue-make-exam')
                   ->with('exam', $exam)
                   ->with('questions', $questions);
        }
        Toastr::error('Something went wrong', 'Error');
        return redirect()->back();
    }

    public function gradeAdd($request)
    {
        $rules = array(
            'to_marks' => 'required|integer|max:100|min:0',
            'from_marks' => 'required|integer|max:100|min:0',
            'grade' => 'nullable|string|max:1',
            'remark' => 'nullable|string|max:40',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $grade = new ResultGrade();
            $grade->from_marks = $request->from_marks;
            $grade->to_marks = $request->to_marks;
            $grade->grade = $request->grade;
            $grade->remark = $request->remark;
            $grade->updated_by = Auth::user()->id;
            $grade->save();
            DB::commit();
            Toastr::success('New grade added successfully', 'Success');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

   public function gradeUpdate($request)
    {
        $rules = array(
            'to_marks' => 'required|integer|max:100|min:0',
            'from_marks' => 'required|integer|max:100|min:0',
            'grade' => 'nullable|string|max:1',
            'remark' => 'nullable|string|max:40',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $grade = ResultGrade::find($request->grade_id);
            $grade->from_marks = $request->from_marks;
            $grade->to_marks = $request->to_marks;
            $grade->grade = $request->grade;
            $grade->remark = $request->remark;
            $grade->updated_by = Auth::user()->id;
            $grade->save();
            DB::commit();
            Toastr::success('Grade updated successfully', 'Success');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }


    public function gradeDelete($request)
    {
        $rules = array(
            'id' => 'required|integer',
            'mode' => 'required|string',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['success' => $error->errors()->all()]);
        } else {
            $grade = ResultGrade::find($request->id);
            $grade->delete();
            DB::commit();
            return response()->json(['success' => "Grade Deleted successfully"]);
        }
    }


    public function add_exam($request)
    {
        $rules = array(
            'title' => 'required|string|max:255',
            // 'total_qns' => 'nullable|integer|max:20',
            'weight_each' => 'required|integer|max:100',
            'muda' => 'required|integer|max:120',
            'description' => 'nullable|string',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $exam = new Exam();
            $exam->title = $request->title;
            // $exam->total_qns = $request->total_qns;
            $exam->weight_each = $request->weight_each;
            $exam->muda = $request->muda;
            $exam->description = $request->description;
            // $total_max = $request->total_qns * $request->weight_each;
            // $exam->marks = $total_max;
            $exam->updated_by = Auth::user()->id;
            $exam->save();
            DB::commit();
            Toastr::success('New exam added successfully', 'Success');
            return redirect()->to('continue-make-exam/' . $exam->id);
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function add_question($request)
    {
        $rules = array(
            'exam_id' => 'required|integer',
            'question' => 'required|string|max:5000',
            'a' => 'required|string|max:5000',
            'b' => 'required|string|max:5000',
            'c' => 'required|string|max:5000',
            'd' => 'required|string|max:5000',
            'answer' => 'required|string|max:1',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $exam = new MultipleChoiceQuestion();
            $exam->exam_id = $request->exam_id;
            $exam->question = $request->question;
            $exam->option_a = $request->a;
            $exam->option_b = $request->b;
            $exam->option_c = $request->c;
            $exam->option_d = $request->d;
            $exam->answer = $request->answer;
            $exam->updated_by = Auth::user()->id;
            $exam->save();
            DB::commit();
            Toastr::success('Question added successfully', 'Success');
            return redirect()->to('continue-make-exam/' . $request->exam_id);
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function update_question($request)
    {
        $rules = array(
            'question_id' => 'required|integer',
            'question' => 'required|string|max:5000',
            'a' => 'required|string|max:5000',
            'b' => 'required|string|max:5000',
            'c' => 'required|string|max:5000',
            'd' => 'required|string|max:5000',
            'answer' => 'required|string|max:1',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $exam = MultipleChoiceQuestion::find($request->question_id);
            $exam->question = $request->question;
            $exam->option_a = $request->a;
            $exam->option_b = $request->b;
            $exam->option_c = $request->c;
            $exam->option_d = $request->d;
            $exam->answer = $request->answer;
            $exam->updated_by = Auth::user()->id;
            $exam->save();
            DB::commit();
            Toastr::success('Question added successfully', 'Success');
            return redirect()->to('continue-make-exam/' . $request->exam_id);
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function update_exam($request)
    {
        $rules = array(
            'title' => 'required|string|max:255',
            'exam_id' => 'required|integer',
            // 'total_qns' => 'required|integer|max:20',
            'weight_each' => 'required|integer|max:100',
            'muda' => 'required|integer|max:120',
            'description' => 'nullable|string',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $exam = Exam::find($request->exam_id);
            $exam->title = $request->title;
            // $exam->total_qns = $request->total_qns;
            $exam->weight_each = $request->weight_each;
            $exam->muda = $request->muda;
            $exam->description = $request->description;
            // $total_max = $request->total_qns * $request->weight_each;
            // $exam->marks = $total_max;
            $exam->updated_by = Auth::user()->id;
            $exam->save();
            DB::commit();
            Toastr::success('Exam updated successfully', 'Success');
            return redirect()->to('continue-make-exam/' . $exam->id);
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function update_passege($request)
    {
        $rules = array(
            'passage' => 'required|string|max:550000',
            'exam_id' => 'required|integer',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            $exam = Exam::find($request->exam_id);
            $exam->passage = $request->passage;
            $exam->updated_by = Auth::user()->id;
            $exam->save();
            DB::commit();
            Toastr::success('notes updated successfully', 'Success');
            return redirect()->to('continue-make-exam/' . $exam->id);
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function activate_exam($request)
    {
        $rules = array(
            'exam_id' => 'required|integer',
            'activate' => 'required|integer',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
                $exam = Exam::find($request->exam_id);
                $exam->isActive = $request->activate;
                $exam->updated_by = Auth::user()->id;
                $exam->save();
                DB::commit();
                Toastr::success('Exam updated successfully', 'Success');
                return redirect()->to('continue-make-exam/' . $exam->id);
            }
            Toastr::error('wrong password', 'Error');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function delete_exam($request)
    {
        $rules = array(
            'exam_id' => 'required|integer',
            'password' => 'required|string',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
                $exam = Exam::find($request->exam_id);
                $exam->delete();
                DB::commit();
                Toastr::success('Exam deleted successfully', 'Success');
                return redirect()->back();
            }
            Toastr::error('wrong password', 'Error');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }

    public function delete_question($request)
    {
        $rules = array(
            'question_id' => 'required|integer',
            'password' => 'required|string',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Toastr::error(implode(',', $error->errors()->all()), 'Error');
            return redirect()->back();
        } else {
            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
                $exam = MultipleChoiceQuestion::find($request->question_id);
                $exam->delete();
                DB::commit();
                Toastr::success('Question deleted successfully', 'Success');
                return redirect()->back();
            }
            Toastr::error('wrong password', 'Error');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }
}
