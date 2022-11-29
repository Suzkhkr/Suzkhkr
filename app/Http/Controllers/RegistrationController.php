<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Record;

use App\Category;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateData2;
use App\Http\Requests\Createdata3;

use function PHPUnit\Framework\isEmpty;

class RegistrationController extends Controller
{
    public function createRecords(CreateData $request) {

        $record = new Record;
        $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];
        if(empty($request->release_flg))$request->release_flg = 0;        
        // 画像情報がセットされていれば、保存処理を実行
        $file_name = $request->image->getClientOriginalName();
        $img = $request->image->storeAs('', $file_name, 'public');
        $record->image = $img;
        // if(isset($img)) {
        //     // 画像フォームでリクエストした画像を取得
        //     // storage > public > img配下に画像が保存される
        //     $path = $img->store('img', 'public');

        //     $record->image = $path;
        // }

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }

        Auth::user()->record()->save($record);
        // Auth::user()->record()->save($image);

        return redirect()->route('calendar');
    }



    // public function editRecords(Record $record, CreateData $request) {
    //     $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];

    //     foreach($columns as $column) {
    //         $record->$column = $request->$column;
    //     }
    //     $record->save();
    //     return redirect('myRecords');
    // }


    public function createCategory(Createdata3 $request) {

        $category = new Category;

        $category->user_id = Auth::id();
        $category->category_id = $request->category_id;
        $category->name = $request->name;
        $category->save();

        return redirect('records/create');

    }

    // public function deleteRecords(int $id) {

    //     $record = Record::find($id);
        
    //     $record->forceDelete();

    //     return redirect('myRecords');
    // }

    public function deleteUser(int $id) {

        $user = User::find($id);
        $user->forceDelete();

        return redirect('usersList');
    }

    public function editProfile(User $user, CreateData2 $request) {
        // $columns = ['profile_image', 'user_name', 'comment', 'email'];

        // foreach($columns as $column) {
        //     $user->$column = $request->$column;
        // }

        $user = auth()->user();
        $user->user_name = $request->user_name?$request->user_name:$user->user_name;
        $user->comment = $request->comment?$request->comment : ($user->comment?$user->comment:NULL);
        $user->email = $request->email?$request->email : $user->email;
        if($request->profile_image) {
            $file_name = $request->profile_image->getClientOriginalName();
            $img = $request->profile_image->storeAs('', $file_name, 'public');
            $user->profile_image = $img;
        }else {
            $user->profile_image = "";
        }
        

        // 画像情報がセットされていれば、保存処理を実行
        // $img = $request->file('profile_image');
        // if(isset($img)) {
        //     // 画像フォームでリクエストした画像を取得
        //     // storage > public > img配下に画像が保存される
        //     $path = $img->store('public/img');

        //     $user->profile_image = $path;
        // }
    
        $user->save();
        return redirect('profile');
    }

}
