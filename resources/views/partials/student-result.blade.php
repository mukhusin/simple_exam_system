
<div class="alert alert-info">
    <h4><b>{{ $exam->title }}</b></h4>
    <span> Umekusanywa tarehe <i> {{$result->created_at->format('d F Y H:i:s')}} </i> </span>
    <h5>Weight each Qn: {{ $exam->weight_each }} </h5>
    <p>{{ $exam->description }}</p>
</div>

<div class="alert alert-primary">
    <div class="row">
        <div class="col-md-4">Alama: <b>{{$result->score}}%</b></div>
        <div class="col-md-4">Daraja: <b>{{$result->grade}}</b></div>
        <div class="col-md-4">Hali: <b>{{$result->remark}}</b></div>
    </div>
</div>
<div class="row mb-3 alert alert-info" style="color: black">
    {!! $exam->passage !!}
</div>
<div class="">
    @php
        $qn_no = 1;
    @endphp

        <input type="hidden" name="exam_id" value="{{$exam->id}}">
        <input type="hidden" name="mode" value="submit_exam">
        @foreach ($questions as $question)
           @php
               $answered = $marked_question->where('question_id', $question->id)->first();
           @endphp
        <div class="alert alert-info">
            <input type="hidden" name="question_id{{ $question->id }}" value="{{ $question->id }}">
            <p>{{ $qn_no }}: <b>{{ $question->question }}</b></p>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>A:</b></div>
                <div class="col-md-10">
                    <h5>{{ $question->option_a }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>B:</b></div>
                <div class="col-md-10">
                    <h5>{{ $question->option_b }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>C:</b></div>
                <div class="col-md-10">
                    <h5>{{ $question->option_c }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1"><b>D:</b></div>
                <div class="col-md-10">
                    <h5>{{ $question->option_d }}</h5>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @if ($answered->isCorrect)
                        <b>{{strtoupper($answered->answer)}}</b>  <i class="fa fa-2x fa-check text-success"></i>
                    @else
                       <b>{{strtoupper($answered->answer)}}</b>  <i class="text-danger font-size-24"><b>X</b></i> jibu sahihi ni: {{strtoupper($question->answer)}}
                    @endif
                </div>
            </div>
        </div>

        <hr>
        @php
            $qn_no += 1;
        @endphp
    @endforeach

</div>
