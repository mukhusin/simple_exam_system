<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\MultipleChoiceQuestion;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function exam_manage(Request $request)
    {
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
            }
        } catch (Exception $e) {
            Toastr::error('Something went wrong !! ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
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
                Toastr::success('Question deleted successfully', 'Success');
                return redirect()->back();
            }
            Toastr::error('wrong password', 'Error');
            return redirect()->back();
            // return view('pages.continue-make-exam')->with('exam', $exam);
        }
    }
}
