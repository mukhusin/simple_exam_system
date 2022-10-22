@extends('layouts.app')

@section('contents')
<div class="alert alert-info">
    <h4><b>{{ $exam->title }}</b></h4>
    <h5>Weight each Qn: {{ $exam->weight_each }} </h5>
    {{-- <p>{{ $exam->description }}</p> --}}
</div>
    <div class="row">
        <div class="col-md-12">
            @if (count($results) > 0)
            <a href="{{ url('exam-result-pdf/'.$exam->id) }}" target="_blank" rel="noopener noreferrer" class="btn btn-info mb-3">Generate PDF</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#generate_pdf_doc_modal" class="btn btn-secondary mb-3">Generate PDF Per date Range</a>
            @endif
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>student</th>
                        <th>score</th>
                        <th>grade</th>
                        <th>remark</th>
                        <th>Date Submitted</th>
                        <th>action</th>
                    </tr>
                </thead>


                <tbody>

                    @foreach ($results as $result)
                        @php
                            $student = \App\Models\User::find($result->student_id);
                        @endphp
                        <tr>
                            <td>{{ $student->name ?? "" }}</td>
                            <td>{{ $result->score }}</td>
                            <td>{{ $result->grade }}</td>
                            <td>{{ $result->remark }}</td>
                            <td>{{ $result->created_at->format('d-F-Y H:i:s') }}</td>
                            <td><a href="{{ url('student-exam-result/'.$exam->id.'/'.$result->student_id) }}" class="btn btn-info">View test</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<div class="modal fade" id="generate_pdf_doc_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Generating PDF  Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="doc_message"></p>
            <form action="{{ route('get-pdf-doc') }}" method="post">
                @csrf
                <input id="exam_id" name="exam_id" value="{{$exam->id}}" type="hidden" hidden>

                <div class="form-group">
                    <label for="from date">From date</label>
                    <input type="date" name="from" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <label for="from date">To date</label>
                    <input type="date" name="to" class="form-control" required>
                </div>

                <center>
                    <button class="btn btn-primary w-50 mt-3">Genarate Pdf Report</button>
                </center>
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
