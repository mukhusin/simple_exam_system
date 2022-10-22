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
            <a href="{{ url('exam-result-pdf/'.$exam->id) }}" class="btn btn-info mb-3">Generate PDF</a>
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
