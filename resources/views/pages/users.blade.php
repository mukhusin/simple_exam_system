@extends('layouts.app')

@section('contents')
    <div class="row justify-content-end mb-3">
        <button data-bs-toggle="modal" data-bs-target="#add-user-modal" class="btn btn-primary w-25">Add user</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>manage</th>
                    </tr>
                </thead>


                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#edit-user{{ $user->id }}"
                                    class="btn btn-info btn-sm">Edit</button>
                                <button data-bs-toggle="modal" data-bs-target="#reset-password{{ $user->id }}"
                                        class="btn btn-info btn-sm" title="Reset Password"><i class="fa fa-lock-open"></i></button>
                               @if (Auth::user()->id != $user->id)
                                  <button onclick="deleteUser('{{ $user->name }}',{{ $user->id }})"  class="btn btn-danger btn-sm">Remove</button>
                               @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="add-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add new User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user-register-form" action="user-manage" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="userAdd" hidden class="form-control">
                        <div class="form-group">
                            <label for="password">Full name:</label>
                            <input type="text" name="name" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Phone:</label>
                            <input type="text" name="phone" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Email:</label>
                            <input type="email" name="email" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="" class="form-control">
                                <option value="">........select.......</option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">student</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input name="password" type="password" minlenght="8"
                                class="form-control reg-input @error('password') is-invalid @enderror"
                                autocomplete="new-password" id="password" required>
                        </div>

                        <div class="form-group">
                            <label for="cpassword">Confirm password:</label>
                            <input name="password_confirmation" autocomplete="new-password" type="password" minlenght="8"
                                class="form-control reg-input" id="password-confirm" required>
                        </div>

                        <div class="message"></div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><button class="btn btn-primary UserregisterButton">save
                                    details</button></div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    @foreach ($users as $user)
        <div class="modal fade" id="edit-user{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit user Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="user-update-form{{ $user->id }}" action="user-manage" method="POST">
                            @csrf
                            <input type="hidden" name="mode" value="userUpdate" hidden class="form-control">
                            <input type="hidden" name="dataId" value="{{ $user->id }}" hidden class="form-control">
                            <div class="form-group">
                                <label for="password">Full name:</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Phone:</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Email:</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                           

                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="" class="form-control">
                                    <option value="{{ $user->role }}">{{ $user->role }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="student">student</option>
                                </select>
                            </div>

                            <div class="message"></div>

                            <div class="row mt-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-6"><button dataId='{{$user->id}}' class="btn btn-primary UserupdateButton">save
                                        details</button></div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($users as $reset_password)
        <div class="modal fade" id="reset-password{{ $reset_password->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="reset_password-form{{ $user->id }}" action="user-manage" method="POST">
                            @csrf
                            <input type="hidden" name="mode" value="reset_password" hidden class="form-control">
                            <input type="hidden" name="dataId" value="{{ $reset_password->id }}" hidden class="form-control">
                            <div class="form-group">
                                <label for="password">Enter Your Password:</label>
                                <input type="text" name="user_password" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                            
                             <p class="text-center">Reset Password for <b> {{ $reset_password->name }} </b> with email <b>{{ $reset_password->email }}</b></p>
                             <div class="form-group">
                                <label for="password">Enter new Password:</label>
                                <input type="password" name="password" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm new Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" autofocus
                                    autocomplete="false" required>
                            </div>
                            <div class="message"></div>

                            <div class="row mt-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-6"><button dataId='{{$reset_password->id}}' class="btn btn-primary reset_passwordButton">save
                                        details</button></div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>

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
              var mode = 'userDelete';
              $.post( "user-manage",{id:id,mode:mode}, function( data ) {
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
