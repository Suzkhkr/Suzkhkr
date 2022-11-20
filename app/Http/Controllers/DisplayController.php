<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Record;

use App\Category;

class DisplayController extends Controller
{
    // public function index() {
    //     return view('index');
    // }

public function index(Request $request) {
    
    $id = Auth::id();
    $user = User::find($id);
    $categories = Auth::user()->category()->find($id);
    return view('calendar', [
        'user' => $user,
        'categories' => $categories,
    ]);
    if ($request->ajax()) {
        $data = DB::table('records')->select('id', 'category_id', 'remind_date', 'title', 'text', 'image')->get();
        return response()->json($data);
    }
  
}

public function myRecords() {
    $id = Auth::id();
    $user = User::find($id);

    $records = Auth::user()->record()->find($id);
    $categories = Auth::user()->category()->find($id);
    
    if($records['id'] == 0) {
        return redirect('nullRecord');
    }else{
        return view('myRecords', [
            'user' => $user,
            'records' => $records,
            'categories' => $categories,
        ]);
    }
}

public function profile() {
    $id = Auth::id();
    $user = User::find($id);
    return view('profile', [
        'user' => $user,
    ]);
    
}

public function timeLine() {
    $id = Auth::id();
    $user = User::find($id);

    $record = new Record;
    $records = $record->all();
    $releaseRecords = $records->where('release_flg',1)->toArray();
    
    $other = new User;
    $others = $other->all();

    dd($others);

    $category = new Category;
    $categories = $category->all();
    return view('timeLine', [
        'user' => $user,
        'others' => $others,
        'records' => $releaseRecords,
        'categories' => $categories,
    ]);
}
}
