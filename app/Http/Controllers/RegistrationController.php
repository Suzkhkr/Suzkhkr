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

use function PHPUnit\Framework\isEmpty;

class RegistrationController extends Controller
{
    public function createRecords(CreateData $request) {

        $record = new Record;
        $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];
        if(empty($request->release_flg))$request->release_flg = 0;        

        // 画像情報がセットされていれば、保存処理を実行
        $img = $request->file('image');
        if(isset($img)) {
            // 画像フォームでリクエストした画像を取得
            // storage > public > img配下に画像が保存される
            $path = $img->store('img', 'public');

            $record->image = $path;
        }

        //画像の追加
        // $this->validate($request, Record::$rules);

        // if ($file = $request->image) {
        //     $fileName = time() . $file->getClientOriginalName();
        //     $target_path = public_path('uploads/');
        //     $file->move($target_path, $fileName);
        // } else {
        //     $fileName = "";
        // }
        // $image = new Record;
        // $image->image = $fileName;

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }

        Auth::user()->record()->save($record);
        // Auth::user()->record()->save($image);

        return redirect()->route('calendar');
    }



    public function editRecords(Record $record, CreateData $request) {
        $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();
        return redirect('myRecords');
    }


    public function createCategory(CreateData $request) {

        $category = new Category;

        $category->user_id = Auth::id();
        $category->category_id = $request->category_id;
        $category->name = $request->name;
        $category->save();

        return redirect('/createRecordsForm');

    }

    public function deleteRecords(int $id) {

        $record = Record::find($id);
        
        $record->forceDelete();

        return redirect('myRecords');
    }

    public function editProfile(User $user, CreateData2 $request) {
        $columns = ['profile_image', 'user_name', 'comment', 'email', 'password'];

        foreach($columns as $column) {
            $user->$column = $request->$column;
        }
        $user->save();
        return redirect('profile');
    }

}
