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

<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ほかの人の投稿</h6>
    </div>
    <div class="form-group">
        <div class="text-center">
                <div class="radio-inline">
                    <br>
                    <input type="radio" value="1" name="" id="">
                    <label for="memory">思い出</label>
                    <input type="radio" value="2" name="" id="">
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
                        <th>アイコン</th>
                        <th>ユーザーネーム</th>
                        <th>カテゴリ</th>
                        <th>タイトル</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    
                        <td>{{ $releaseRecords['title'] }}</td>
                        <td>{{ $releaseRecords['text'] }}</td>
                        <td><button id="button" type="button" class="btn btn-info">いいね！</button></td>
                        <td><button id="button" type="button" class="btn btn-info">コメント</button></td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <a href="{{ route('calendar') }}" type="button" class="btn btn-info">カレンダーに戻る</a>
                </div>
                
        </div>
    </div>
</div>

@endsection

