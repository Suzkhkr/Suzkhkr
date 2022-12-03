<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Like;
use App\Record;
use App\Category;
use Carbon\Carbon;

use DateTime;
use Redirect,Response;

class DisplayController extends Controller
{

    public function getEvent(Request $request) {
        $id = Auth::id();
        $user = User::find($id);
        $result = Record::select('id', 'title', 'remind_date as start')->where('user_id', $id)->get()->toArray();
        $now = Carbon::now()->format("Y-m-d");

        return view('calendar', [
            'user' => $user,
            'result' => $result,
        ]);
    }

    private function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
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

    public function timeLine(Request $request) {
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
        ->where('release_flg',2)
        ->where('u.id', '!=' ,Auth::id())
        ->get();
        

        
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        if(!empty($keyword)) {
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
            ->where('release_flg',2)
            ->where('u.id', '!=' ,Auth::id())
            ->where('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('user_name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('user_name', 'LIKE', '%'.$keyword.'%')
            ->get();
        }
        
        if(!empty($category)) {
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
            ->where('release_flg',2)
            ->where('u.id', '!=' ,Auth::id())
            ->where('c.id', 'LIKE', $category)
            ->get();
        }
        

        $category_list = Category::all();

        $getLike = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $records = Record::withCount('likes')->orderBy('created_at', 'desc');
        $like = new Like;
        
        $getLike = [
                'records' => $records,
                'like'=>$like,
            ];


        return view('timeLine', [
            'user' => $user,
            'data' => $data,
            'getLike' => $getLike,
            'category_list' => $category_list,
            'keyword' => $keyword,
            'category' => $category,
        ]);
        
    }

    // public function createRecordsForm() {
    //     $user = User::find(Auth::id());

    //     $category = Category::all()->toArray();

    //     // foreach($category as $c){
    //     //     dd($c['id']);
    //     // }
    //     return view('createRecordsForm', [
    //         'user' => $user,
    //         'categories' => $category,
    //     ]);

    // }

    public function createCategoryForm() {
        $user = User::find(Auth::id());
        $record = new Record;
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
