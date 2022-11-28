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

    <div class="text-center mt-5 mb-5">
        @if($user['profile_image'] == null)
        <img class="rounded-circle" src="img/undraw_profile.svg" alt="..." width="200px" height="200px">
        @else
        <img src="{{asset('storage/'.$user['profile_image'])}}" alt="" width="200px" height="200px">
        @endif
        <p class="mt-4">ユーザーネーム：{{ $user['user_name'] }}</p>
        <p>一言コメント：{{ $user['comment'] }}</p>
        <p>メールアドレス：{{ $user['email'] }}</p>
        {{-- <p>パスワード：{{ $user['password'] }}</p><br>  --}}
        <a href="{{ route('editProfileForm', $user['id']) }}" type="button" class="btn btn-primary text-right">編集する</a>
    </div>

</body>
@endsection
