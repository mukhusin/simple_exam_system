{{-- Confirmation Modal --}}
<div class="modal fade" id="confirmation_dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirmation Dialog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirm_message"></p>
                <form action="{{ route('confirm_dailog') }}" method="post">
                    @csrf
                    <input type="hidden" name="dataId" id="confirm_dataId">
                    <input type="hidden" name="mode" id="confirm_mode">
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-danger btn-sm mx-3 w-25">Yes proceed</button>
                        <button type="button" class="btn btn-sm btn-primary w-25" data-bs-dismiss="modal"
                            aria-label="Close">cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Confirmation Modal --}}

           <!-- The change pasdsword -->


<div class="modal fade" id="change-password-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="changepassword-form" method="POST" action="changepassword" >
                @csrf
                <div class="form-group">
                    <label for="password">Old Passwoprd:</label>
                    <input type="password" minlength="8" name="oldpassword" class="form-control" id="password" autofocus autocomplete="false" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input name="password" type="password" minlenght="8" class="form-control reg-input @error("password") is-invalid @enderror"  autocomplete="new-password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="cpassword">Confirm password:</label>
                        <input name="password_confirmation" autocomplete="new-password" type="password" minlenght="8" class="form-control reg-input" id="password-confirm" required>
                </div>
                <div class="message"></div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6"><button class="btn btn-primary ">Change password</button></div>
                    <div class="col-md-3"></div>
                </div>
                </form>
         
        </div>
    </div>
</div>
</div>


                
