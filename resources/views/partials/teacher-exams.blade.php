<h4>Exams</h4>
<div class="row justify-content-end mb-3">
    <button data-bs-toggle="modal" data-bs-target="#add-exam-modal" class="btn btn-primary w-25">Add New Exam</button>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="datatable" class="table table-bordered dt-responsive nowrap"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>Jina la mtihani</th>
                    {{-- <th>No Qns</th> --}}
                    <th>Muda</th>
                    {{-- <th>Total Mark</th> --}}
                    <th>imehaririwa na</th>
                    <th>manage</th>
                </tr>
            </thead>


            <tbody>

                @foreach ($exams as $exam)
                    @php
                      $user =  \App\Models\User::find($exam->updated_by); 
                      $updated_by = $user->name ?? "";
                    @endphp
                    <tr>
                        <td><a href="{{ url('continue-make-exam/'.$exam->id) }}">{{ $exam->title }}</a></td>
                        {{-- <td>{{ $exam->total_qns }}</td> --}}
                        <td>{{ $exam->muda }}</td>
                        {{-- <td>{{ $exam->marks }}</td> --}}
                        <td>{{ $updated_by }}</td>
                        <td>
                          <a href="{{ url('continue-make-exam/'.$exam->id) }}" class="btn btn-info">Angalia</a>
                          <a href="{{ url('student-exam-results/'.$exam->id) }}" class="btn btn-success">Matokeo</a>
                          <button data-bs-toggle="modal" data-bs-target="#delete-exam{{$exam->id}}-modal" class="btn btn-danger">delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($exams as $item)
<div class="modal fade" id="delete-exam{{$item->id}}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Futa Mtihani</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                @csrf
                <input type="hidden" name="mode" value="delete_exam" hidden class="form-control">
                <input type="hidden" name="exam_id" value="{{$item->id}}" hidden class="form-control">
                 <p>{{$item->title}}</p>
                 <div class="alert alert-danger">
                    <strong>Unauhakika unahitaji kufuta huu mtihani?</strong>
                 </div>
                 <div class="form-group">
                    <label for="">Ingiza Nywira</label>
                    <input type="password" name="password" class="form-control">
                 </div>
                <div class="row mt-3">
                    <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">hgairi</button></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6"><button class="btn btn-danger w-100">Ndio Futa</button></div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endforeach



<div class="modal fade" id="add-exam-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ongeza mtihani Mpya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-exam-form" action="{{ route('exam-manage') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mode" value="add_exam" hidden class="form-control">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Jina la Mtihani:</label>
                            <input type="text" name="title" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="total_qns">Total Quesrion:</label>
                            <input type="number" min="1" max="20" name="total_qns" class="form-control" autofocus autocomplete="false" required>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="title">Alama ya kila swali:</label>
                            <input type="number" min="1" max="100" name="weight_each" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Muda:</label>
                            <input type="number" min="1" max="120" name="muda" class="form-control" autofocus autocomplete="false" required>
                        </div>
                       
                    </div>

                    <div class="form-group">
                        <label for="title">Maelekezo:</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="message"></div>

                    <div class="row mt-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><button class="btn btn-primary w-100">endelea</button></div>
                        <div class="col-md-3"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
