<!-- 開封済み一覧 -->

@extends('layouts.app') 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>開封済み一覧</title>

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

<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">開封済み一覧</h6>
    </div>
    <div class="form-group">
        <div class="text-center">
                <div class="radio-inline">
                    <br>
                    <input type="radio" value="0" name="category_id" id="">
                    <label for="memory">思い出</label>
                    <input type="radio" value="1" name="category_id" id="">
                    <label for="target">目標</label>
                </div>
        </div>
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
                        <th>レコード番号</th>
                        <th>分類</th>
                        <th>カテゴリ</th>
                        <th>タイトル</th>
                        <th>タイトル</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $records['id'] }}</td>
                        <td>{{ $records['category_id'] }}</td>
                        <td>{{ $records['title'] }}</td>
                        <td>{{ $records['title'] }}</td>
                        <td>{{ $records['text'] }}</td>
                        <td><button id="button" type="button" class="btn btn-info"
                            a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#modalForm" data-cusno=1
                    aria-expanded="true" aria-controls="collapseUtilities">詳細</button></td>
                        <td><button id="button" type="button" class="btn btn-info">編集</button></td>
                        <td><button id="button" type="button" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button></td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <a href="{{ route('calendar') }}" type="button" class="btn btn-info">カレンダーに戻る</a>
                </div>
                
        </div>
    </div>
</div>
{{-- 詳細モーダル --}}
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
            <form role="form" id="form1">
            <!-- Modal ボディー -->
            <div class="modal-body">
                <div class="form-group">
                <div class="text-left">
                    <label for="cusno">リマインド日</label><br>
                    {{ $records['remind_date'] }}
                <br>
                <div class="form-group">
                    <div class="text-left">
                    <label for="oldday">分類</label><br>
                        {{ $records['category_id'] }}
                    </div>
                </div>
                </div>
                </div>
                <div class="text-left">
                <label for="category">カテゴリ</label><br>
                {{ $categories['name'] }}</select>
                </div><br>
                
                <div class="text-left">
                    <label for="title">タイトル</label><br>
                </div>
                {{ $records['title'] }}
                
                <br>
                    <div class="form-group">
                        <div class="text-left">
                            <label for="newday">記録</label><br>
                        </div>
                        {{ $records['text'] }}
                       
                    </div>
                    <div>公開設定：{{ $records['release_flg'] }}</div>
                </div>
            </div>
            <!-- Modal フッター -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>

@endsection
