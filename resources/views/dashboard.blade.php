@extends('layouts.app')
@section('contents')

    @if ($user->role == "teacher")
         @include('partials.teacher-exams')
    @endif


    @if ($user->role == "student")
         @include('partials.student-exams')
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