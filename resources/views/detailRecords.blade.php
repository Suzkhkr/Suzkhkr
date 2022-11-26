
@extends('layouts.app') 
@section('content')

<head>
    <title>記録</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('記録') }}</div>

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
                        <label for="date">{{ __('リマインド日') }}</label>
                        <p>{{ $date }}</p>

                        <div class="text-left">分類
                            <p>
                                @if($result['category_id']==0)
                                <span>思い出-</span>
                                @else
                                <span>目標-</span>
                                @endif
                                {{ $result['category']['name'] }}
                            </p>
                        </div><br>
                        <div class="text-left">
                            <label for="title">タイトル</label>
                        </div>
                        <p>{{ $result['title'] }}</p><br>
                            <div class="form-group">
                                <div class="text-left">
                                    <label for="text">記録</label>
                                </div>
                                <p>{{ $result['text'] }}</p>
                            </div>
                            <label for="title">公開設定</label>
                                @if($result['release_flg'] == 0)
                                <p>公開しない</p>
                                @else
                                <p>公開する</p>
                                @endif
                                {{-- 画像の表示 --}}
                               <img src="../../uploads/{{ $result->image }}" width="200px" height="200px">

                    </div>  

                    <div class="text-center mb-3">
                        <a href="/myRecords" class="btn btn-primary">
                            {{ __('戻る') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
