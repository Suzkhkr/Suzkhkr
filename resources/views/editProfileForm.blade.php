@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('プロフィール編集') }}</div>

                <div class="card-body">
                    <div class="panel-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <form action="{{ route('editProfile', $id) }}" method="POST" enctype='multipart/form-data'>
                        @csrf    
                        <!-- プロフィール画像-->
                        <div class="text-center">
                            <div class="text-left">
                                <input type="file" name="profile_image">
                            </div>
                            
                        </div>
                        <div class="mt-3 mb-3">
                            <p class="mb-1">ユーザーネーム</p>
                            <input type="text" name="user_name" id="user_name" class='form-control' value="{{ $user['user_name']}}">
                            <p class="mt-3 mb-1">一言コメント</p>
                            <input type="text" name="comment" id="comment" class='form-control' value="{{ $user['comment']}}">
                            <p class="mt-3 mb-1">メールアドレス</p>
                            <input type="text" name="email" id="email" class='form-control' value="{{ $user['email']}}">
                            <p class="mt-3 mb-1">パスワード</p>
                            {{-- <input type="text" name="password" id="password" class='form-control' value="{{ $user['password']}}"> --}}
                        </div>

                        <div class="text-right">
                            <a onClick="history.back();" class="btn btn-primary" onclick="return confirm('入力を破棄してよろしいですか？')">
                                {{ __('戻る') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('登録') }}
                            </button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
