@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<!-- bootstrapの読み込み -->
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset='utf-8' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>Calendar</title>
    <link href="{{ asset('fullcalendar-5.11.3/lib/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('fullcalendar-5.11.3/lib/main.js') }}"></script>
    <script src="../js/app.js"></script>
    <script>
      //fullcalendar呼び出し
 
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
            // 日付をクリック、または範囲を選択したイベント
            events: function (info, successCallback, failureCallback) {
        // Laravelのイベント取得処理の呼び出し
        axios
          .post("/calender", {
                start_date: info.start.valueOf(),
            })
            .then((response) => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);
            });
    },
        });
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div class="text-right">
      <a href='createRecordsForm'><button type="button" class="btn btn-primary rounded-circle p-0" style="width:2rem;height:2rem;"
        class="btn btn-success">＋</button></a></div><br>
    <div id='calendar'></div>
    <br>


  </body>
</html>
@endsection
