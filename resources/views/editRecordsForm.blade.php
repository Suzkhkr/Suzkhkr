
@extends('layouts.app') 

@section('content')

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('記録の編集') }}</div>

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
                        <form action="{{ route('records.update', $id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            @method('patch')
                            <label for="date">{{ __('リマインドしたい日付') }}</label>
                            <input type="date" class="form-control" name="remind_date" id="date" value="{{ $result->remind_date->format('Y-m-d') }}"/><br>
                                <div class="text-left">
                                    
                                        {{-- <p>変更前：
                                            @if($result['category']['category_id'] == 1)
                                            <span>思い出-</span>
                                            @else
                                            <span>目標-</span>
                                            @endif
                                            {{ $result['category']['name'] }}
                                        </p> --}}

                                        <div class="radio-inline">

                                            <input type="radio" name="category" id="category_id" value="1"{{ $result['category']['category_id'] == 1 ? 'checked' : '' }}  onclick="isDisplayMemory()">
                                            <label for="memory">思い出</label>
                                            <input type="radio" name="category" id="category_id" value="2"{{ $result['category']['category_id'] == 2 ? 'checked' : '' }} onclick="isDisplayTarget()">
                                            <label for="target">目標</label>

                                        </div>
                                    
                                    
                                    <div id="memorySelect">
                                        <select name='category_id' class='form-control'>
                                            <option value='{{ $result['category']['id'] }}' hidden>{{ $result['category']['name'] }}</option>
                                            @foreach($categories as $category)
                                            @if($category['category_id'] == 1)
                                                <option value="{{ $category->category_id }}">{{ $category['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="targetSelect" style="display:none;">
                                        <select name='category_id' class='form-control'>
                                            <option value='{{ $result['category']['id'] }}' hidden>{{ $result['category']['name'] }}</option>
                                            @foreach($categories as $category)
                                            @if($category['category_id'] == 2)
                                                <option value="{{ $category->category_id }}">{{ $category['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('createCategoryForm') }}" for="category">カテゴリ追加</a>
                                    </div> 
                                        
                                
                                </div>
                                
                                <div class="text-left">
                                    <label for="title">タイトル</label>
                                </div>
                                <input type="text" name="title" id="title" class='form-control' value="{{ $result->title }}">
                                <br>
                                    <div class="form-group">
                                        <div class="text-left">
                                            <label for="text">記録</label>
                                        </div>
                                        <textarea rows="10" class="form-control" id="text" name="text" >{{ $result->text }}</textarea>
                                        <div class="text-left">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    @if($result['release_flg'] == 2)
                                    <input type="radio" name="release_flg" value="{{ $result['release_flg'] }}"{{ $result['release_flg'] == 2 ? 'checked' : '' }}>公開のままにする
                                    <input type="radio" name="release_flg" value="1">非公開にする
                                    @elseif($result['release_flg'] == 1)
                                    <input type="radio" name="release_flg" value="{{ $result['release_flg'] }}"{{ $result['release_flg'] == 1 ? 'checked' : '' }}>非公開のままにする
                                    <input type="radio" name="release_flg" value="2">ほかのユーザーに公開する
                                    @endif
                                </div>  
                            <div class="text-right mr-3 mb-3">
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
