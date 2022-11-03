@extends('layouts.guest')

@section('contents')
    <div class="container-fluid user-auth">
        <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
            <!-- Logo Starts -->
            <a class="logo" href="index.html">
                <!-- <img id="single-logo" class="img-responsive" src="img/styleswitcher/logos/yellow.png" alt="logo"> -->
                <h4>SAUTI YA UNABII</h4>
            </a>
            <!-- Logo Ends -->
            <!-- Slider Starts -->
            <div id="carousel-testimonials" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators Starts -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-testimonials" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-testimonials" data-slide-to="1"></li>
                    <li data-target="#carousel-testimonials" data-slide-to="2"></li>
                </ol>
                <!-- Indicators Ends -->
                <!-- Carousel Inner Starts -->
                <div class="carousel-inner">
                    <!-- Carousel Item Starts -->
                    <div class="item active item-1">
                        <!-- <div>
                            <blockquote>
                                <p>Amira's Team Was Great To Work With And Interpreted Our Needs Perfectly.</p>
                                <footer><span>Lucy Smith</span>, England</footer>
                            </blockquote>
                        </div> -->
                    </div>
                    <!-- Carousel Item Ends -->
                    <!-- Carousel Item Starts -->
                    <div class="item item-2">
                        <!-- <div>
                            <blockquote>
                                <p>The Team Is Endlessly Helpful, Flexible And Always Quick To Respond, Thanks Amira!</p>
                                <footer><span>Rawia Chniti</span>, Russia</footer>
                            </blockquote>
                        </div> -->
                    </div>
                    <!-- Carousel Item Ends -->
                    <!-- Carousel Item Starts -->
                    <div class="item item-3">
                        <!-- <div>
                            <blockquote>
                                <p>We Are So Appreciative Of Their Creative Efforts, And Love Our New Site!, millions of thanks Amira!</p>
                                <footer><span>Mario Verratti</span>, Spain</footer>
                            </blockquote>
                        </div> -->
                    </div>
                    <!-- Carousel Item Ends -->
                </div>
                <!-- Carousel Inner Ends -->
            </div>
            <!-- Slider Ends -->
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <!-- Logo Starts -->
            <a class="visible-xs" href="index-kenburns.html">
                <img id="logo-mobile-light" class="img-responsive mobile-logo white-l"
                    src="img/styleswitcher/logos/yellow.png" alt="logo">
                <img id="logo-mobile-dark" class="img-responsive mobile-logo dark-l"
                    src="img/styleswitcher/logos/logos-dark/yellow.png" alt="logo">
            </a>
            <!-- Logo Ends -->
            <div class="form-container">
                <div>
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span>get</span> started</h1>
                        <p>open account absolutely free</p>
                    </div>
                    <!-- Main Heading Ends -->
                    <!-- Form Starts -->
                    <form id="user-register-form" action="user-manage" method="POST" class="custom-form">
                        @csrf
                        <input type="hidden" name="mode" value="userAdd" hidden class="form-control">
                        <input type="hidden" name="role" value="student" hidden class="form-control">
                        <!-- Input Field Starts -->
                        <div class="form-group">
                            <input class="form-control" name="name" id="name" placeholder="NAME" type="text"
                                required>
                        </div>
                        <!-- Input Field Ends -->
                        <!-- Input Field Starts -->
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" placeholder="EMAIL" type="email"
                                required>
                        </div>
                        <!-- Input Field Ends -->
                        <!-- Input Field Starts -->
                        <div class="form-group">
                            <input class="form-control" name="password" id="password" placeholder="PASSWORD"
                                type="password" required>
                        </div> 
                        
                        <div class="form-group">
                            <input name="password_confirmation" autocomplete="new-password" placeholder="CONFIRM PASSWORD" type="password" minlenght="8"
                                class="form-control" id="password-confirm" required>
                        </div>
                        <!-- Input Field Ends -->
                        <!-- Submit Form Button Starts -->
                        <div class="form-group">
                            <button class="custom-button UserregisterButton" type="submit">jisajiri</button>
                            <p class="text-center">tayari umesajiriwa ? <a href="/login">ingia</a>
                        </div>
                        <!-- Submit Form Button Ends -->
                    </form>
                    <!-- Form Ends -->
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
                    window.location.href = "/login";
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




    });
</script>
@endsection
