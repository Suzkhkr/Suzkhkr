@extends('layouts.app') 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>タイムライン</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
    <!-- Topbar Search -->

<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
@section('content')

<div class="search">
    <form action="" method="GET">
        @csrf
    <div class="form-inline">
        <div class="form-group">
            <div>
                <label for="" class="ml-2 mr-2">キーワード：
                    <div>
                        <input type="text" name="keyword" value="{{ $keyword }}">
                    </div>
                </label>
            </div>
        </div>

        {{-- <div>
            <label for="" class="ml-2 mr-2">分類：
                <div>
                    <select name="category" data-toggle="select">
                        <option value="">全て</option>
                        @foreach($category_list as $category_item)
                            <option value="{{ $category_item->getCategory() }}" 
                                @if($category=='{{ $category_item->getCategory() }}') selected
                                @endif>{{  $category_item->getCategory()}}</option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div> --}}
        
        <div>
            <input type="submit" class="btn btn-primary" type="button" value="検索">
        </div>
    </div>
    </form>


</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ほかの人の投稿</h6>
    </div>

    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
        aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ユーザーネーム</th>
                        <th>カテゴリ</th>
                        <th>タイトル</th>
                        <th>本文</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->user_name }}</td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->text }}</td>
                        <td><p class="favorite-marke">
                          @if($getLike['like']->like_exist(Auth::user()->id, $d->id))
                            <a class="js-like-toggle loved" href="" data-recordid="{{ $d->id }}"><i class="fas fa-heart"></i></a>
                           @else
                            <p class="favorite-marke">
                                <a class="js-like-toggle" href="" data-recordid="{{ $d->id }}"><i class="far fa-heart"></i></a>
                                {{-- <span class="likesCount">{{$record->likes_count}}</span> --}}
                            </p>
                           @endif 
                            </p>
                            {{-- <button id="unlike" type="button" class="btn btn-danger" onclick="unlike(event, {{$d->id}})">解除</button></td> --}}
                        {{-- <td><button id="button" type="button" class="btn btn-warning" onclick="">コメント</button></td> --}}
                    </tr>
                    @endforeach
                </tbody>
                </table>

    {{-- @if($like_model->like_exist(Auth::user()->id, $record->id))
    <p class="favorite-marke">
    <a class="js-like-toggle loved" href="" data-recordid="{{ $record->id }}"><i class="fas fa-heart"></i></a>
    <span class="likesCount">{{$record->likes_count}}</span>
    </p>
    @else
    <p class="favorite-marke">
    <a class="js-like-toggle" href="" data-recordid="{{ $record->id }}"><i class="fas fa-heart"></i></a>
    <span class="likesCount">{{$record->likes_count}}</span>
</p>
@endif --}}
        </div>
    </div>
</div>
<script>
$(function () {
    var like = $('.js-like-toggle');
    var likeRecordId;


    like.on('click', function () {
        var $this = $(this);
        var heart = $(this).children('.fa-heart');
        likeRecordId = $this.data('recordid');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxlike',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'record_id': likeRecordId //コントローラーに渡すパラメーター
                },
                dataType: 'json'
        })

        // Ajaxリクエストが成功した場合
        .done(function (data) {
        //lovedクラスを追加
            heart.toggleClass('fas'); 
            heart.toggleClass('far'); 

        //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
            // $this.next('.likesCount').html(data.recordLikesCount); 

        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {
        //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
        //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
        
        return false;
    });
});
    // function like(e, id) {
    //     // let btn = document.querySelectorAll('.like');
    //     // for(i=0; i<btn.length; i++) {
    //     //     btn[i].addEventListener("click", function() {
        
    //     //     });

    //     // }
    //     // console.log(e.target);
    //     // console.log(id);
    //     $.ajax({
    //         headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         url: '/like/' + id,
    //         type: "POST",
    //     })
    //     .done(function (data, status, xhr) {
    //         // e.target.classList.add('liked');
    //         // $(btn).addClass('liked');
    //         console.log('aaa');
    //     })
    //     .fail(function (xhr, status, error) {
        
    //     });

    // }

    // function unlike(e, id) {
    //     // e.target.classList.add('unliked');
    //     document.getElementById('like');
    //     e.target.classList.remove('liked');
    // // $(this).css('background-color', 'red');
    //     console.log(e.target);
    //     // console.log(id);
    // $.ajax({
    //     headers: {
    //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     },
    //     url: '/unlike/'+ id,
    //     type: "POST",
    // })
    //     .done(function (data, status, xhr) {
        
    //     })
    //     .fail(function (xhr, status, error) {
    //     });
    // }
</script>
<style>
    .liked{
        background-color: coral !important;
        border: none;
    }
    .unliked{
        
    }
</style>
@endsection

