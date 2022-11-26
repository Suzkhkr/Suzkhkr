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

            //表示した月のカレンダーの始まりの日を終わりの日をそれぞれ取得。
            $start = $this->formatDate($request->input('start'));
            $end = $this->formatDate($request->input('end'));
    
            //カレンダーの期間内のイベントを配列で取得
            //EventsObjectが対応している配列キーの名前に変更するため、dateをstartとする
            $event = Record::query()
            ->select(
                // FullCalendarの形式に合わせる
                'remind_date as start',
                'category_id as title'
            )
            // FullCalendarの表示範囲のみ表示
            ->get();
            //json形式にして出力

    // $categories = Auth::user()->category()->find($id);
    return view('calendar', [
        'user' => $user,
        $event,
        // 'categories' => $categories,
    ]);
    // if ($request->ajax()) {
    //     $data = DB::table('records')->select('id', 'category_id', 'remind_date', 'title', 'text', 'image')->get();
    //     return response()->json($data);
    // }
  
}

private function formatDate($date)
{
    return str_replace('T00:00:00+09:00', '', $date);
}

public function myRecords(Record $record) {
    $user = User::find(Auth::id());
    $categories = Category::all();
    $data = DB::table('records')
    ->select(
        'records.id',
        'records.user_id',
        'records.category_id',
        'records.title',
        'records.text',
        'u.user_name',
        'u.profile_image',
        'c.name'
    )
    ->leftJoin('users as u', 'records.user_id', '=', 'u.id')
    ->leftJoin('categories as c', 'records.category_id', '=', 'c.id')
    ->where('u.id', '=' ,Auth::id())
    ->get();

    return view('myRecords', [
        'user' => $user,
        'data' => $data,
        'record' => $record,
        'categories' => $categories,
        'id' => $record->id,
    ]);
}

public function detailRecords(Record $record) {
    $user = User::find(Auth::id());
    $categories = Category::all();
    $date = $record->remind_date->format('Y/m/d');
    return view('detailRecords', [
        'user' => $user,
        'result' => $record,
        'categories' => $categories,
        'date' => $date,
    ]);
}

public function editRecordsForm(Record $record) {
    $user = User::find(Auth::id());
    $date = $record->remind_date->format('Y/m/d');
    $categories = Category::all();
    // $result = Record::all()->find();
    return view('editRecordsForm', [
        'user' => $user,
        'id' => $record->id,
        'result' => $record,
        'categories' => $categories,
        'date' => $date,
    ]);
}

public function profile() {
    $user = User::find(Auth::id());
    return view('profile', [
        'user' => $user,
    ]);
    
}

public function editProfileForm(User $user) {
    $user = User::find(Auth::id());
    return view('editProfileForm', [
        'user' => $user,
        'id' => $user->id,
    ]);
    
}

public function timeLine() {
    $user = User::find(Auth::id());

    $data = DB::table('records')
    ->select(
        'records.id',
        'records.user_id',
        'records.title',
        'records.text',
        'u.user_name',
        'u.profile_image',
        'c.name'
    )
    ->leftJoin('users as u', 'records.user_id', '=', 'u.id')
    ->leftJoin('categories as c', 'records.category_id', '=', 'c.id')
    ->where('release_flg',0)
    ->where('u.id', '!=' ,Auth::id())
    ->get();

    return view('timeLine', [
        'user' => $user,
        'data' => $data,
    ]);
}

public function createRecordsForm() {
    $user = User::find(Auth::id());

    $category = Category::all()->toArray();

    return view('createRecordsForm', [
        'user' => $user,
        'categories' => $category,
    ]);

}

public function createCategoryForm() {
    $user = User::find(Auth::id());
    return view('createCategoryForm',[
        'user' => $user,
        ]);
}

public function usersList() {
    $user = User::find(Auth::id());

    $users = User::all()->toArray();
    return view('usersList',[
        'user' => $user,
        'users' => $users,
        ]);
}

}
