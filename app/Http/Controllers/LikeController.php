<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Record;

use App\User;

class LikeController extends Controller
{
    public function store(int $id)
    {
        Auth::user()->like($id);
        return 'ok!'; //レスポンス内容
    }

    public function destroy(int $id)
    {
        Auth::user()->unlike($id);
        return 'ok!'; //レスポンス内容
    }
}
