@extends('layouts.app')

@section('contents')
   @if ($result)
       @include('partials.student-result')
   @else
      @include('partials.student-take-exam')
   @endif
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
