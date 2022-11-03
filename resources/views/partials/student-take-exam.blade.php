


<div class="row mb-3 alert alert-info" style="color: black">
    {!! $exam->passage !!}
</div>

<div class="alert alert-info">
    <h4><b>{{ $exam->title }}</b></h4>
    <h5>Alama ya kila swali: {{ $exam->weight_each }} </h5>
    <p>{{ $exam->description }}</p>
</div>

<div class="">
    @php
        $qn_no = 1;
    @endphp
    <form action="/exam-manage" method="post">
        @csrf
        <input type="hidden" name="exam_id" value="{{$exam->id}}">
        <input type="hidden" name="mode" value="submit_exam">
        @foreach ($questions as $question)
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
                <div class="col-md-4">
                   <div class="form-group">
                    <select name="answer{{$question->id}}" class="form-control">
                        <option value="">chagua jibu sahihi</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>

        <hr>
        @php
            $qn_no += 1;
        @endphp
    @endforeach

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"><button type="submit" class="btn btn-primary w-100 mb-5">kusanya mtihani</button></div>
        <div class="col-md-4"></div>
    </div>

    </form>
</div>
