
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
                        <form action="{{ route('records.store') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <label for="date">{{ __('リマインドしたい日付') }}</label>
                            <input type="date" class="form-control" name="remind_date" id="remind_date" value="{{ old('remind_date') }}"><br>
                                <div class="text-left">
                                        <div class="radio-inline">              
                                            <input type="radio" name="category" id="category_id" value="1"{{ old ('category') == '1' ? 'checked' : '' }} onclick="isDisplayMemory()">
                                            <label for="memory">思い出</label>
                                            <input type="radio" name="category" id="category_id" value="2"{{ old ('category') == '2' ? 'checked' : '' }} onclick="isDisplayTarget()">
                                            <label for="target">目標</label>
                                        </div>      
                                        <div id="memorySelect">
                                            <select name='category_id' class='form-control' id="m_select">
                                                <option value='' hidden>カテゴリ</option>
                                                @foreach($categories as $category)
                                                @if($category['category_id'] == 1)
                                                    <option value="{{ $category['id']}}">{{ $category['name'] }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="targetSelect" style="display:none;">
                                            <select name='category_id' class='form-control' id="t_select" disabled>
                                                <option value='' hidden>カテゴリ</option>
                                                @foreach($categories as $category)
                                                @if($category['category_id'] == 2)
                                                    <option value="{{ $category['id']}}">{{ $category['name'] }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="text-right">
                                            <a href={{ route('createCategoryForm') }} for="category">カテゴリ追加</a>
                                        </div>
                                </div>
                                
                                <div class="text-left">
                                    <label for="title">タイトル</label>
                                </div>
                                <input type="text" name="title" id="title" class='form-control' value="{{ old('title') }}">
                                <br>
                                    <div class="form-group">
                                        <div class="text-left">
                                            <label for="text">記録</label>
                                        </div>
                                        <textarea rows="10" class="form-control" id="text" name="text">{{ old('text') }}</textarea>
                                        <div class="text-left">
                                            {{-- 画像の挿入 --}}
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <input type="checkbox" name="release_flg" value="1">ほかのユーザーに公開する
                                </div>  
                                <div class="text-right mr-3 mb-3">
                                    <a href="/calendar" class="btn btn-primary" onclick="return confirm('入力を破棄してよろしいですか？')">
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
    @endsection
<script>

    function isDisplayMemory() {
        let memory = document.getElementById("memorySelect");
        let target = document.getElementById("targetSelect");
        let m_select = document.getElementById("m_select");
        let t_select = document.getElementById("t_select");
        memory.style.display = "block";
        target.style.display = "none";
        m_select.disabled = false;
        t_select.disabled = true;
    }
    function isDisplayTarget() {
        let memory = document.getElementById("memorySelect");
        let target = document.getElementById("targetSelect");
        let m_select = document.getElementById("m_select");
        let t_select = document.getElementById("t_select");
        memory.style.display = "none";
        target.style.display = "block";
        m_select.disabled = true;
        t_select.disabled = false;
        console.log(memory.disabled);
        console.log(target.disabled);
        
    }
    
</script>

