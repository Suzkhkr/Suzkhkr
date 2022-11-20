@extends('layouts.app')

@section('content')
<!DOCTYPE html>
    <meta charset='utf-8'>
<!-- bootstrapの読み込み -->
{{-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>profile</title>

</head>
<body>
    <div class="text-center">
        <div class="h1">プロフィール</div>
    </div>
    <div class="text-right pr-5">
        <a href="" type="button" class="btn btn-info text-right">編集する</a>
    </div>
    <!-- プロフィール画像-->
   <p></p>
    <!-- ユーザーネーム -->
    <div class="text-center">
        <p>画像</p>
        <p>ユーザーネーム：{{ $user['user_name'] }}</p>
        <p>一言コメント：{{ $user['comment'] }}</p>
        <p>メールアドレス：{{ $user['email'] }}</p>
        <p>パスワード：{{ $user['password'] }}</p><br>
        <div>
            <a href="{{ route('calendar') }}" type="button" class="btn btn-info">カレンダーに戻る</a>
        </div>
    </div>
</body>
@endsection
