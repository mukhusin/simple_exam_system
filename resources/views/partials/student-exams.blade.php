<h4>Exams</h4>
<div class="row">
    <div class="col-md-12">
        <table id="datatable" class="table table-bordered dt-responsive nowrap"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>Jina lamtihani</th>
                    {{-- <th>No Qns</th> --}}
                    <th>Muda</th>
                    <th>Jumla ya alama</th>
                    <th></th>
                </tr>
            </thead>


            <tbody>

                @foreach ($exams->where('isActive', true) as $exam)
                   
                    <tr>
                        <td><a href="{{ url('student-exam/'.$exam->id) }}">{{ $exam->title }}</a></td>
                        {{-- <td>{{ $exam->total_qns }}</td> --}}
                        <td>{{ $exam->muda }}</td>
                        <td>{{ $exam->marks }}</td>
                        <td>
                           <a href="{{ url('student-exam/'.$exam->id) }}" class="btn btn-primary">Fungua mtihani</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


