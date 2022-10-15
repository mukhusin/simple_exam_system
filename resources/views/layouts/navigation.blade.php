
@php
    $newDoneExam = 3;
@endphp
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">

                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo/logo.jpeg') }}" alt="" height="82" class="rounded-circle">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo/logo.jpeg') }}" alt="" height="80" class="rounded-circle">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">


            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="fa fa-window-maximize"></i>
                </button>
            </div>

            {{-- @if (Auth::user()->role == "teacher")
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-2x fa-bell"></i> <span class="badge bg-danger rounded-pill">{{ $newDoneExam }}</span> </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="m-0 font-size-16"> Notifications </h5> </div>
                                <div class="col-auto"> <a href="#!" class="small"> Mark all as read</a> </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            @if ($newDoneExam > 0)
                                <a href="#" class="text-reset notification-item">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Exam Notifications</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1"><b>{{ $newDoneExam }}</b> New done exam</p>
                                                <p class="mb-0 text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            
                        
                        </div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)"> <i class="uil-arrow-circle-right me-1"></i> View More.. </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="rounded-circle header-profile-user" src="assets/images/logo/logo.png"
                        alt="Header Avatar"> --}}
                        <i class="fa fa-1x fa-user"></i> {{ $user->name }} <i class="fa fa-1x fa-angle-down"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"></span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-password-modal" ><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Change Password</span></button>
                    {{-- <a class="dropdown-item d-block" href="#"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Settings</span> <span class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Lock screen</span></a> --}}
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logout-modal"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <div class="topnav">

            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">
                                <i class="uil-home-alt me-2"></i> Home
                            </a>
                        </li>
                        @if (Auth::user()->role == "teacher")

                            <li class="nav-item">
                                <a class="nav-link" href="/grade">
                                    Grades
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="/students">
                                   Students
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == "admin")
                           
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-setting" role="button">
                                    <i class="uil-apps me-2"></i>Settings <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-setting">
                                    <a href="/users" class="dropdown-item">Users</a>
                                </div>
                            </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>


<!-- Modal -->
<div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          You going to logout
          <form action="{{ route('logout') }}" method="post">
            @csrf
            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-danger w-25 mt-3">Logout</button>
          </form>
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
  
  