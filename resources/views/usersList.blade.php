<!-- 開封済み一覧 -->

@extends('layouts.app') 
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ユーザー一覧</h6>
    </div>         
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ユーザーID</th>
                        <th>ユーザーネーム</th>
                        <th>メールアドレス</th>
                        <th>作成日</th>
                        <th></th>
 
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{ $u['id'] }}</td>
                        <td>{{ $u['user_name'] }}</td>
                        <td>{{ $u['email'] }}</td>
                        <td>{{ $u['created_at'] }}</td>
                        @if($u['id'] == 1)
                        <td></td>
                        @else
                        <td><a href="{{ route('deleteUser', $u['id']) }}"><button id="button" type="button" class="btn btn-danger" onclick="return confirm('{{ $u['user_name'] }}を本当に削除しますか？')">削除</button></a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                </table>
                
        </div>
    </div>
</div>

@endsection

