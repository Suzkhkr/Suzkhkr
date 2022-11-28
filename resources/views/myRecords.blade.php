<!-- 開封済み一覧 -->

@extends('layouts.app') 
<!DOCTYPE html>
<html lang="ja">

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


    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    
</head>


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">開封済み一覧</h6>
    </div>
    {{-- <div class="form-group">
        <div class="text-center">
                <div class="radio-inline">
                    <br>
                    <input type="radio" value="0" name="category_id" id="">
                    <label for="memory">思い出</label>
                    <input type="radio" value="1" name="category_id" id="">
                    <label for="target">目標</label>
                </div>
        </div>
    </div> --}}
                    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>リマインド日</th>
                        <th>分類</th>
                        <th>カテゴリ</th>
                        <th>タイトル</th>
                        {{-- <th>本文</th> --}}
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    @if($d->opened_flg ==1 || $d->remind_date < $now)
                    <tr>
                        <td>{{ $d->remind_date }}</td>
                            @if($d->category == 1)
                        <td>思い出</td>
                            @else
                        <td>目標</td>
                            @endif
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->title }}</td>
                        {{-- <td>{{ $d->text }}</td> --}}
                        <td><a href="{{ route('records.show', $d->id) }}"><button id="button" type="button" class="btn btn-primary">詳細</button></a></td>
                        <td><a href="{{ route('records.edit', $d->id) }}"><button id="button" type="button" class="btn btn-success">編集</button></a></td>
                        <td><form action="{{ route('records.destroy', $d->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                        <input type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')" value="削除"/></form></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>
                {{-- <div class="text-center">
                    <a href="{{ route('calendar') }}" type="button" class="btn btn-info">カレンダーに戻る</a>
                </div> --}}
                
        </div>
    </div>
</div>

@endsection

