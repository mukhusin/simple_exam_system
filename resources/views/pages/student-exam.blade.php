@extends('layouts.app')

@section('contents')
   
@endsection

@section('javascript')

    <script type="text/javascript">
     $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
      });
    </script>
@endsection
