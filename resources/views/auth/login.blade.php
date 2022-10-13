@extends('layouts.guest')

@section('contents')
    <div class="container-fluid user-auth">
        <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
            <!-- Logo Starts -->
            <a class="logo" href="index.html">
                <h4>SAUTI YA UNABII</h4>
                <!-- <img id="single-logo" class="img-responsive" src="img/styleswitcher/logos/yellow.png" alt="logo"> -->
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
                        <div>
                            <!-- <blockquote>
                                <p>Amira's Team Was Great To Work With And Interpreted Our Needs Perfectly.</p>
                                <footer><span>Lucy Smith</span>, England</footer>
                            </blockquote> -->
                        </div>
                    </div>
                    <!-- Carousel Item Ends -->
                    <!-- Carousel Item Starts -->
                    <div class="item item-2">
                        <div>
                            <!-- <blockquote>
                                <p>The Team Is Endlessly Helpful, Flexible And Always Quick To Respond, Thanks Amira!</p>
                                <footer><span>Rawia Chniti</span>, Russia</footer>
                            </blockquote> -->
                        </div>
                    </div>
                    <!-- Carousel Item Ends -->
                    <!-- Carousel Item Starts -->
                    <div class="item item-3">
                        <div>
                            <!-- <blockquote>
                                <p>We Are So Appreciative Of Their Creative Efforts, And Love Our New Site!, millions of thanks Amira!</p>
                                <footer><span>Mario Verratti</span>, Spain</footer>
                            </blockquote> -->
                        </div>
                    </div>
                    <!-- Carousel Item Ends -->
                </div>
                <!-- Carousel Inner Ends -->
            </div>
            <!-- Slider Ends -->
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <!-- Logo Starts -->
            <a class="visible-xs" href="index.html">
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
                        <h1><span>member</span> login</h1>
                        <p>great to have you back!</p>
                    </div>
                    <div class="text-center top-text">
                        <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                    </div>
                    <!-- Main Heading Ends -->
                    <!-- Form Starts -->
                  
                    
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
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
                        <!-- Input Field Ends -->
                        <!-- Submit Form Button Starts -->
                        <div class="form-group">
                            <button class="custom-button login" type="submit">login</button>
                            <p class="text-center">don't have an account ? <a href="/register">register now</a>
                        </div>
                        <!-- Submit Form Button Ends -->
                    </form>
                    <!-- Form Ends -->
                </div>
            </div>
        </div>
    </div>
@endsection
