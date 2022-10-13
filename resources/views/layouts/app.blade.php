<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FSC') }}</title>

        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.jpeg') }}"> --}}

        <!-- DataTables -->
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     
        

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
      
        <!-- toastr -->
        <link rel="stylesheet" href="{{ URL::to('assets/plugins/toastr/toastr.min.css') }}">

         <!-- summernote -->
         <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-lite.min.css') }}">

         @yield('custome_style')
        <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    </head>
    <body data-layout="horizontal" data-topbar="colored">
        {!! Toastr::message() !!}
        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('layouts.navigation')
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <main>
                            @yield('contents')
                        </main>
                    </div>
                </div>
                <footer class="footer bg-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                document.write(new Date().getFullYear())
                                </script> © SAUTI YA NABII. </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block"> Developed <i class="mdi mdi-code-braces text-danger"></i> by <a href="mailto:backend1developer@gmail.com">MS</a> </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
       
        <script>
           
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            
        </script>
         <!-- JAVASCRIPT -->
         <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
         <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
         <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
         <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
         <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
         <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
         <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
 
         <!-- apexcharts -->
         <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
 
         <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
        
          <!-- Required datatable js -->
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
        {{-- toastr --}}
        <script src="{{ URL::to('assets/plugins/toastr/toastr.min.js') }}"></script>
        {{-- summernote --}}
        <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>
         <!-- App js -->
         <script src="{{ asset('assets/js/jquery.form.min.js') }}"></script>
         
         <script src="{{ asset('assets/js/app.js') }}"></script>
         <script src="{{ asset('assets/js/script.0.0.1.js') }}"></script>
         @yield('javascript')

         <script>
            $('.text-editor').summernote({
                toolbar: [

                    ['misc', ['fullscreen', 'undo', 'redo']]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr', 'math']],
                    ['view', ['fullscreen', 'help']],
                ],
            });
         </script>

         @include('shared.modal')
 
    </body>
</html>
