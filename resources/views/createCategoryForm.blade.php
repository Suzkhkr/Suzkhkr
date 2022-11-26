
@extends('layouts.app') 
@section('content')

<head>

    <title>カテゴリ名追加</title>

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

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('カテゴリ名追加') }}</div>

                    <div class="card-body">
                        <form action="{{ route('createCategory') }}" method="POST">
                            @csrf

                            
                                <div class="col-md-6">
                                    <label for="category">分類</label>
                                    <div class="radio-inline">
                                        <input type="radio" value="0" name="category_id" id="category_id" value="{{ old('category_id') }}">
                                        <label for="memory">思い出</label>
                                        <input type="radio" value="1" name="category_id" id="category_id" value="{{ old('category_id') }}">
                                        <label for="target">目標</label>
                                    </div>
                                </div>
                                
                                <label for="user_name" >{{ __('カテゴリ名') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            

                            <div class="text-right">
                                <a onClick="history.back();" class="btn btn-primary">
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
