<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Record;

use App\Category;

class RegistrationController extends Controller
{
    // public function createRecords() {
    //     // $records = Auth::user()->records()->get();
    //     $id = Auth::id();
    //     $user = User::find($id);
    //     return view('createRecords', [
    //         'user' => $user,
    //     ]);
    // }
}
