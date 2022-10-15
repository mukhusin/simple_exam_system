@extends('layouts.app')

@section('contents')
    <h4>Making Exam</h4>

    <div class="alert alert-info">
        <h4><b>{{ $exam->title }}</b></h4>  
        <h5>Weight each Qn: {{$exam->weight_each}} Time of Exam: {{$exam->muda}} <small><i>minutes</i></small></h5>
        <p>{{ $exam->description }}</p>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @if ($exam->isActive)
                   <a href="#" data-bs-toggle="modal" data-bs-target="#activate-exam-modal" class="btn btn-danger">Deactivate <i class="fa fa-lock"></i></a>
                @else
                   <a href="#" data-bs-toggle="modal" data-bs-target="#activate-exam-modal" class="btn btn-success">Activate <i class="fa fa-unlock"></i></a>
                @endif
            </div>
            <div class="col-md-4"><a href="#" data-bs-toggle="modal" data-bs-target="#edit-exam-modal" class="btn btn-secondary">edit <i class="fa fa-edit"></i></a></div>
        </div>
    </div>
   
    <div class="row mb-3">
        <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
            @csrf
            <input type="hidden" name="mode" value="update_passege" hidden class="form-control">
            <input type="hidden" name="exam_id" value="{{$exam->id}}" hidden class="form-control">
        <div class="form-group">
            <label for="passage">Write Notes</label>
            <textarea name="passage" class="form-control text-editor">{!! $exam->passage !!}</textarea>
            <div class="row justify-content-end">
                <button data-bs-toggle="modal" data-bs-target="#add-question-modal" class="btn btn-primary w-70 mt-2">Save Notes </button>
            </div>
        </div>
       </form>
    </div>
    <div class="">
        @php
            $qn_no = 1;
        @endphp
    @foreach ($questions as $question)
        
            <div class="alert alert-info">
                <p>{{$qn_no}}: <b>{{$question->question}}</b></p>
               <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>A:</b></div>
                <div class="col-md-10"><h5>{{$question->option_a}}</h5></div>
               </div>
               <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>B:</b></div>
                <div class="col-md-10"><h5>{{$question->option_b}}</h5></div>
               </div>
               <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>C:</b></div>
                <div class="col-md-10"><h5>{{$question->option_c}}</h5></div>
               </div>
               <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>D:</b></div>
                <div class="col-md-10"><h5>{{$question->option_d}}</h5></div>
               </div>
               <div class="row ">
                  <div class="col-md-3">Answer: <b>{{strtoupper($question->answer)}}</b></div>
                  <div class="col-md-5">
                    <button data-bs-toggle="modal" data-bs-target="#update-question{{$question->id}}-modal" class="btn btn-warning w-50 mt-3">Edit question <i class="fa fa-edit"></i></button>
                  </div>
                   <div class="col-md-4">
                    <button data-bs-toggle="modal" data-bs-target="#delete-question{{$question->id}}-modal" class="btn btn-danger w-50 mt-3">Delete question <i class="fa fa-trash"></i></button>
                  </div>
               </div>
            </div>

            <hr>
            @php
                $qn_no += 1;
            @endphp
    @endforeach
</div>

    <div class="row justify-content-end">
        <button data-bs-toggle="modal" data-bs-target="#add-question-modal" class="btn btn-secondary w-70 mt-3 mb-5">Add question <i class="fa fa-plus-circle"></i></button>
    </div>

  


    <div class="modal fade" id="edit-exam-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Exam details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="update_exam" hidden class="form-control">
                        <input type="hidden" name="exam_id" value="{{$exam->id}}" hidden class="form-control">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Exam Name:</label>
                                <input type="text" name="title" value="{{$exam->title}}" class="form-control" autofocus autocomplete="false" required>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="total_qns">Total Quesrion:</label>
                                <input type="number" min="1" max="20" name="total_qns" value="{{$exam->total_qns}}" class="form-control" autofocus autocomplete="false" required>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="title">Weight for Each Question:</label>
                                <input type="number" min="1" max="100" name="weight_each" value="{{$exam->weight_each}}" class="form-control" autofocus autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">Time in Minutes:</label>
                                <input type="number" min="1" max="120" name="muda" value="{{$exam->muda}}" class="form-control" autofocus autocomplete="false" required>
                            </div>
                           
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title">Instruction:</label>
                            <textarea name="description" class="form-control">{{$exam->description}}</textarea>
                        </div>

                        <div class="message"></div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><button class="btn btn-primary w-100">save details</button></div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="activate-exam-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Activate or Deactivate Exam Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exam-manage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="activate_exam" hidden class="form-control">
                        <input type="hidden" name="exam_id" value="{{$exam->id}}" hidden class="form-control">
                        @if ($exam->isActive)
                          <input type="hidden" name="activate" value="0" hidden class="form-control">
                        @else
                          <input type="hidden" name="activate" value="1" hidden class="form-control">
                        @endif
                        <div class="form-control">
                            <label for="">Enter Your Password below</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="message"></div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><button type="submit" class="btn btn-primary w-100">submit</button></div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @foreach ($questions as $qsn)
        
    <div class="modal fade" id="update-question{{$qsn->id}}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add question Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mode" value="update_question" hidden class="form-control">
                    <input type="hidden" name="question_id" value="{{$qsn->id}}" hidden class="form-control">
                    <input type="hidden" name="exam_id" value="{{$exam->id}}" hidden class="form-control">
                    <h4 class="m-3">Write Questions</h4>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea name="question" class="form-control">{{$qsn->question}}</textarea>
                    </div>
                    <div class="row mt-3 mb-3">
                        <label for="inputEmail3" class="col-sm-1 col-form-label"><b>A</b></label>
                        <div class="col-sm-11">
                          <input type="text" name="a" value="{{$qsn->option_a}}" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-1 col-form-label"><b>B</b></label>
                        <div class="col-sm-11">
                          <input type="text" name="b" value="{{$qsn->option_b}}" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-1 col-form-label"><b>C</b></label>
                        <div class="col-sm-11">
                          <input type="text" name="c" value="{{$qsn->option_c}}" class="form-control" id="inputEmail5">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-1 col-form-label"><b>D</b></label>
                        <div class="col-sm-11">
                          <input type="text" name="d" value="{{$qsn->option_d}}" class="form-control" id="inputEmail6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-2"><label for="">Select Collect Answer</label></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                
                                <select name="answer" id="" class="form-control">
                                    <option value="{{$qsn->answer}}">{{strtoupper($qsn->answer)}}</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><button type="submit" class="btn btn-primary w-100 m-3">save question</button></div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="delete-question{{$qsn->id}}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new Exam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mode" value="delete_question" hidden class="form-control">
                    <input type="hidden" name="question_id" value="{{$qsn->id}}" hidden class="form-control">
                     <p>{{$qsn->question}}</p>
                     <div class="alert alert-danger">
                        <strong>Are you sure you need to delete this question</strong>
                     </div>
                     <div class="form-group">
                        <label for="">Enter Your Password</label>
                        <input type="password" name="password" class="form->control">
                     </div>
                    <div class="row mt-3">
                        <div class="col-md-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100">Delete</button></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

    @endforeach


    <div class="modal fade" id="add-question-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add question Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="add_question" hidden class="form-control">
                        <input type="hidden" name="exam_id" value="{{$exam->id}}" hidden class="form-control">
                        <h4 class="m-3">Write Questions</h4>
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea name="question" class="form-control"></textarea>
                        </div>
                        <div class="row mt-3 mb-3">
                            <label for="inputEmail3" class="col-sm-1 col-form-label"><b>A</b></label>
                            <div class="col-sm-11">
                              <input type="text" name="a" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-1 col-form-label"><b>B</b></label>
                            <div class="col-sm-11">
                              <input type="text" name="b" class="form-control" id="inputEmail4">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-1 col-form-label"><b>C</b></label>
                            <div class="col-sm-11">
                              <input type="text" name="c" class="form-control" id="inputEmail5">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-1 col-form-label"><b>D</b></label>
                            <div class="col-sm-11">
                              <input type="text" name="d" class="form-control" id="inputEmail6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2"><label for="">Select Collect Answer</label></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    
                                    <select name="answer" id="" class="form-control">
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><button type="submit" class="btn btn-primary w-100 m-3">save question</button></div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script type="text/javascript">
     $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
      });
    </script>
@endsection
