<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Record;

use App\User;

use App\Like;

class LikeController extends Controller
{
    // public function store(int $id)
    // {
    //     Auth::user()->like($id);
    //     return 'ok!'; //レスポンス内容
    // }

    // public function destroy(int $id)
    // {
    //     Auth::user()->unlike($id);
    //     return 'ok!'; //レスポンス内容
    // }

    public function index()
    {
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $records = Record::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $like = new Like;

        $data = [
                'records' => $records,
                'like'=>$like,
            ];

        return view('records.index', $data);
    }

        public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $record_id = $request->record_id;
        $like = new Like;
        $record = record::findOrFail($record_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $record_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('record_id', $record_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->record_id = $request->record_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $recordLikesCount = $record->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'recordLikesCount' => $recordLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
        
}
