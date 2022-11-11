<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset='utf-8' />

    <title>Calendar</title>
    <h1>TimeCapsule</h1>
    <link href="{{ asset('fullcalendar-5.11.3/lib/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('fullcalendar-5.11.3/lib/main.js') }}"></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
    <button type="button" class="btn btn-secondary">Secondary</button>
  </body>
</html>
