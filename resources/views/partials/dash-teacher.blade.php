
    <div class="row justify-content-end mb-3">
        <button data-bs-toggle="modal" data-bs-target="#add-user-modal" class="btn btn-primary w-25">Add Exam</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Jina la mtumiaji</th>
                        <th>Namba ya Sim</th>
                        <th>Barua pepe</th>
                        <th>Role</th>
                        <th>hariri</th>
                    </tr>
                </thead>


                <tbody>

                   
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="add-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ongeza mtumiaji mpya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user-register-form" action="user-manage" method="POST">
                        @csrf
                        <input type="hidden" name="mode" value="userAdd" hidden class="form-control">
                        <div class="form-group">
                            <label for="password">Jina:</label>
                            <input type="text" name="name" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Namba ya sim:</label>
                            <input type="text" name="phone" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Barua pepe:</label>
                            <input type="email" name="email" class="form-control" autofocus autocomplete="false" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="" class="form-control">
                                <option value="">........chagua.......</option>
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
                            <label for="cpassword">Hakiki password:</label>
                            <input name="password_confirmation" autocomplete="new-password" type="password" minlenght="8"
                                class="form-control reg-input" id="password-confirm" required>
                        </div>

                        <div class="message"></div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><button class="btn btn-primary UserregisterButton">tunza taarifa</button></div>
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

