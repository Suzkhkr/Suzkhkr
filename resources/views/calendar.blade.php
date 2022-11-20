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
    <script>
      //モーダル処理
      $('#newday').datepicker({
        dateFormat: 'yy-mm-dd',
      });
      // モーダルが開いた時の処理
      $('#modalForm').on('show.bs.modal', function (event) {
        //モーダルを開いたボタンを取得
        var button = $(event.relatedTarget);
        //モーダル自身を取得
        var modal = $(this);
        //data-cusnoの値取得
        var cusnoVal = button.data('cusno');
        // input 欄に値セット
        modal.find('.modal-body input#cusno').val(cusnoVal);
        //data-visitdayの値取得
        var visitdayVal = button.data('visitday');
        modal.find('.modal-body input#oldday').val(visitdayVal);
      });

      //fullcalendar呼び出し
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
    <div class="text-right">
      <button type="button" class="btn btn-primary rounded-circle p-0" style="width:2rem;height:2rem;"
        class="btn btn-success" data-toggle="modal" data-target="#modalForm" data-cusno=1>＋</button></div><br>
    <div id='calendar'></div>
    <br>

{{-- 追加モーダル --}}
<!-- 更新完了時に表示するメッセージ欄 -->
<div>
  <p class='text-center bg-info' id="mess"></p>
  <!-- Modal の中身 -->
  <div class="modal fade" id="modalForm" role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal ヘッダー -->
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
          </button>
          </div>
          <form action="{{ route('createRecords') }}" method="post" role="form" id="form1">
            @csrf
          <!-- Modal ボディー -->
          <div class="modal-body">
              <div class="form-group">
              <div class="text-left">
                <label for="remind_date" name="remind_date">リマインドしたい日付</label>
                <input type="date" class="form-control" name="remind_date" id="remind_date" value="{{ old('remind_date') }}"><br>

                <div class="form-group">
                    <div class="text-left">
                      <label for="category">分類</label>
                      <div class="radio-inline">
                          <input type="radio" value="0" name="category_id" id="category_id" value="{{ old('category_id') }}">
                          <label for="memory">思い出</label>
                          <input type="radio" value="1" name="category_id" id="category_id" value="{{ old('category_id') }}">
                          <label for="target">目標</label>
                      </div>
                    </div>
                </div>
              </div>
              <div class="text-left">
                
                <label for="name">カテゴリ</label>
                  <input type="text" name="name" list="category_list" value='' placeholder="カテゴリを入力" class='form-control' value="{{ old('name') }}">
                  <datalist id="category_list"></datalist>
                  <div class="text-right">
                    <a href="createCategory" for="category">カテゴリ追加</a>
                  </div>
                  
                </select>
              </div><br>
              
              <div class="text-left">
                  <label for="title">タイトル</label>
              </div>
              <input type="text" name="title" id="title" class='form-control' value="{{ old('title') }}">
              <br>
                  <div class="form-group">
                      <div class="text-left">
                          <label for="text">記録</label>
                      </div>
                      <textarea rows="10" class="form-control" id="text" name="text" autocomplete="off"></textarea>
                      <div class="text-right">
                        <a href="" for="image" name="image">画像を追加</a>
                      </div>
                    </div>
                  <input type="checkbox" name="release_flg">ほかのユーザーに公開する
              </div>
          </div>
          <!-- Modal フッター -->
          <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">閉じる
              </button>
              <button type="submit" class="btn btn-primary" id="chgDateSub">保存
              </button>
          </div>
          </form>
      </div>
      </div>
  </div>
</div>
  </body>
</html>
@endsection
