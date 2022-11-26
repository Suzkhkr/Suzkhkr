
@extends('layouts.app') 
@section('content')

<head>

    <title>記録の追加</title>



</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('記録の追加') }}</div>

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
                        <form action="{{ route('createRecords') }}" method="POST" enctype='multipart/form-data'>
                            @csrf

                            <label for="date">{{ __('リマインドしたい日付') }}</label>
                            <input type="date" class="form-control" name="remind_date" id="remind_date" value="{{ old('remind_date') }}"><br>
                                <div class="text-left">
                                    <div class="col-md-6">
                                        <label for="category">分類</label>
                                        <div class="radio-inline">
                                            <input type="radio" value="0" name="category_id" id="category_id" value="{{ old('category_id') }}" onclick="isDisplayMemory()" checked>
                                            <label for="memory">思い出</label>
                                            <input type="radio" value="1" name="category_id" id="category_id" value="{{ old('category_id') }}" onclick="isDisplayTarget()">
                                            <label for="target">目標</label>
                                        </div>
                                    </div>
                                    <label for="name">カテゴリ</label>
                                    
                                    <div id="memorySelect">
                                        <select name='category_id' class='form-control'>
                                            <option value='' hidden>カテゴリ</option>
                                            @foreach($categories as $category)
                                            @if($category['category_id'] == 0)
                                                <option value="{{ $category['category_id']}}">{{ $category['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="targetSelect" style="display:none;">
                                        <select name='category_id' class='form-control'>
                                            <option value='' hidden>カテゴリ</option>
                                            @foreach($categories as $category)
                                            @if($category['category_id'] == 1)
                                                <option value="{{ $category['category_id']}}">{{ $category['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="text-right">
                                        <a href="createCategoryForm" for="category">カテゴリ追加</a>
                                        </div>
                                    
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
                                        <textarea rows="10" class="form-control" id="text" name="text" autocomplete="off" value="{{ old('text') }}"></textarea>
                                        <div class="text-left">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <input type="checkbox" name="release_flg" value="1">ほかのユーザーに公開する
                                </div>  
                            <div class="text-right">
                                <a href="calendar" class="btn btn-primary" onclick="return confirm('入力を破棄してよろしいですか？')">
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
</body>
<script>

    function isDisplayMemory() {
        let memory = document.getElementById("memorySelect");
        let target = document.getElementById("targetSelect");
        memory.style.display = "block";
        target.style.display = "none";
    }
    function isDisplayTarget() {
        let memory = document.getElementById("memorySelect");
        let target = document.getElementById("targetSelect");
        memory.style.display = "none";
        target.style.display = "block";
    }
    
</script>
@endsection