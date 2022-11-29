@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <title>Calendar</title>
    <link href="{{ asset('fullcalendar-5.11.3/lib/main.css') }}" rel='stylesheet' />

  <body>
    <div id="app">
      <div class="text-right mr-3 mt-3">
        <a href="{{ route('records.create') }}"><button type="button" class="btn btn-primary rounded-circle p-0" style="width:2rem;height:2rem;"
          class="btn btn-success">＋</button></a></div><br>
      <div id='calendar'></div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('fullcalendar-5.11.3/lib/main.js') }}"></script>
    {{-- <script src="../js/app.js"></script> --}}
    <script>
      //fullcalendar呼び出し
      
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        const results = @json($result);
        
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          events: results,

        });
      
        calendar.render();
      });
    </script>
  </body>
@endsection
