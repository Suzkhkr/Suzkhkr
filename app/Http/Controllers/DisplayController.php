<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    // public function index() {
    //     return view('index');
    // }

public function index(Request $request) {

    if ($request->ajax()) {
        $data = DB::table('records')->select('user_id', 'category_id', 'remind_date', 'title', 'text', 'image')->get();
        return response()->json($data);
    }
    return view('/index');
}
}
