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
    </div>
    <div class="text-right pr-5">
        <a href="{{ route('editProfileForm', $user['id']) }}" type="button" class="btn btn-info text-right">編集する</a>
    </div>

    <div class="text-center mb-5">
        <img src="../../uploads/{{ $user->profile_image }}" width="200px" height="200px">
        <p class="mt-4">ユーザーネーム：{{ $user['user_name'] }}</p>
        <p>一言コメント：{{ $user['comment'] }}</p>
        <p>メールアドレス：{{ $user['email'] }}</p>
        {{-- <p>パスワード：{{ $user['password'] }}</p><br>  --}}
    </div>
</body>
@endsection
