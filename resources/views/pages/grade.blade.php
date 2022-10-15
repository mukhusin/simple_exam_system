@extends('layouts.app')

@section('contents')
    <div class="row justify-content-end mb-3">
        <button data-bs-toggle="modal" data-bs-target="#add-grade-modal" class="btn btn-primary w-25">Add Grade</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Range</th>
                        <th>Grade</th>
                        <th>Remark</th>
                        {{-- <th>updated by</th> --}}
                        <th>manage</th>
                    </tr>
                </thead>


                <tbody>

                    @foreach ($grades as $grade)
                        @php
                            $updated_by = \App\Models\User::find($grade->updated_by);
                        @endphp
                        <tr>
                            <td>{{ $grade->from_marks }} - {{ $grade->to_marks }}</td>
                            <td>{{ $grade->grade }}</td>
                            <td>{{ $grade->remark }}</td>
                            {{-- <td>{{ $updated_by->name ?? "" }}</td> --}}
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#edit-grade{{ $grade->id }}"
                                    class="btn btn-info btn-sm">Edit</button>
                                  {{-- <button onclick="deleteGrade('{{ $grade->grade }}',{{ $grade->id }})"  class="btn btn-danger btn-sm">Remove</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="add-grade-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add new Grade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="grade-form" action="exam-manage" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="gradeAdd" hidden class="form-control">
                       <div class="row">
                            <div class="form-group col-md-6">
                                <label for="from_marks">Minimum:</label>
                                <input type="number" min="0" max="100" name="from_marks" class="form-control" autofocus autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="to_marks">Maximum:</label>
                                <input type="number" min="0" max="100" name="to_marks" class="form-control" autofocus autocomplete="false" required>
                            </div>
                       </div>
                       <div class="row">
                            <div class="form-group col-md-6">
                                <label for="grade">Grade:</label>
                                <select name="grade" id="" class="form-control">
                                    <option value="">........select.......</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="remark">Remark:</label>
                                <select name="remark" id="" class="form-control">
                                    <option value="">........select.......</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Very Good">Very Good</option>
                                    <option value="Good">Good</option>
                                    <option value="pass">pass</option>
                                    <option value="fail">fail</option>
                                </select>
                            </div>
                       </div>
                        

                        <div class="message"></div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><button class="btn btn-primary">save
                                    details</button></div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    @foreach ($grades as $grad)
        <div class="modal fade" id="edit-grade{{ $grad->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit user Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form id="grade-update-form{{ $grad->id }}" action="exam-manage" method="POST">
                                @csrf
                                <input type="hidden" name="mode" value="gradeUpdate" hidden class="form-control">
                                <input type="hidden" name="grade_id" value="{{$grad->id}}" hidden class="form-control">
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="from_marks">Minimum:</label>
                                        <input type="number" min="0" max="100" value="{{$grad->from_marks}}" name="from_marks" class="form-control" autofocus autocomplete="false" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="to_marks">Maximum:</label>
                                        <input type="number" min="0" max="100" name="to_marks" value="{{$grad->to_marks}}" class="form-control" autofocus autocomplete="false" required>
                                    </div>
                               </div>
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="grade">Grade:</label>
                                        <select name="grade" id="" class="form-control">
                                            <option value="{{ $grad->grade }}">{{ $grad->grade }}</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="remark">Role:</label>
                                        <select name="remark" id="" class="form-control">
                                            <option value="{{ $grad->remark }}">{{ $grad->remark }}</option>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Very Good">Very Good</option>
                                            <option value="Good">Good</option>
                                            <option value="pass">pass</option>
                                            <option value="fail">fail</option>
                                        </select>
                                    </div>
                               </div>
                                
        
                                <div class="message"></div>
        
                                <div class="row mt-3">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6"><button class="btn btn-primary">save
                                            details</button></div>
                                    <div class="col-md-3"></div>
                                </div>
                            </form>
        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('javascript')

    <script type="text/javascript">
     $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
      });

        var elems = document.getElementsByClassName('confirmation');
        var confirmIt = function (e) {
            if (!confirm('Are you sure?')) e.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }

        function deleteUser(item,id) {
        
        if (confirm("Are you sure you want to delete "+ item +"?")) {
              var mode = 'gradeDelete';
              $.post( "exam-manage",{id:id,mode:mode}, function( data ) {
                      if (data.error) {
                          toastr.error(data.error);
                      }
                      if (data.success) {
                          toastr.success(data.success);
                          location.reload();
                      }
                      
              }).fail(function() {
                        toastr.error("Something went wrong !");
                  });
        }

      }


        $(document).ready(function(e) {
            // e.preventDefault();

            $("#user-register-form").ajaxForm({
                beforeSend: function() {
                    $('.UserregisterButton').addClass('disabled');
                    $('.UserregisterButton').attr('disabled', '');
                    //   $("#waiting-saving").html(
                    //       ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                    //   );
                },

                success: function(data) {
                    if (data.error) {
                        $('.UserregisterButton').removeAttr('disabled', '');
                        $('.UserregisterButton').removeClass('disabled');
                        //   $("#waiting-saving").html('');
                        toastr.error(data.error);
                    }
                    if (data.success) {
                        //   $("#waiting-saving").html('');
                        $('.UserregisterButton').removeAttr('disabled', '');
                        $('.UserregisterButton').removeClass('disabled');
                        $("#user-register-form")[0].reset();
                        toastr.success(data.success);
                        location.reload();
                    }
                }
            });

            $("body").delegate(".UserupdateButton", "click", function() {
                var id = $(this).attr('dataId');
                $("#user-update-form" + id).ajaxForm({
                    beforeSend: function() {
                        $('.UserupdateButton').addClass('disabled');
                        $('.UserupdateButton').attr('disabled', '');
                        $("#waiting-saving-user" + id).html(
                            ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                        );
                    },

                    success: function(data) {
                        if (data.error) {
                            $('.UserupdateButton').removeAttr('disabled', '');
                            $('.UserupdateButton').removeClass('disabled');
                            toastr.error(data.error);
                            $("#waiting-saving-user" + id).html('');
                        }
                        if (data.success) {
                            $("#waiting-saving-user" + id).html('');
                            $('.UserupdateButton').removeAttr('disabled', '');
                            $('.UserupdateButton').removeClass('disabled');
                            toastr.success(data.success);
                            $('#user-update-form' + id)[0].reset();
                            location.reload();
                        }
                    }
                });
            });

   $("body").delegate(".reset_passwordButton", "click", function() {
                var id = $(this).attr('dataId');
                $("#reset_password-form" + id).ajaxForm({
                    beforeSend: function() {
                        $('.reset_passwordButton').addClass('disabled');
                        $('.reset_passwordButton').attr('disabled', '');
                        // $("#waiting-saving-user" + id).html(
                        //     ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                        // );
                    },

                    success: function(data) {
                        if (data.error) {
                            $('.reset_passwordButton').removeAttr('disabled', '');
                            $('.reset_passwordButton').removeClass('disabled');
                            toastr.error(data.error);
                            $("#waiting-saving-user" + id).html('');
                        }
                        if (data.success) {
                            // $("#waiting-saving-user" + id).html('');
                            $('.reset_passwordButton').removeAttr('disabled', '');
                            $('.reset_passwordButton').removeClass('disabled');
                            toastr.success(data.success);
                            $('#reset_password-form' + id)[0].reset();
                            location.reload();
                        }
                    }
                });
            });




        });
    </script>
@endsection
