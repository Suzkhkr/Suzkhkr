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
    public function createRecords($request) {

        $record = new Record;

        $columns = ['remind_date', 'categoty_id', 'name', 'title', 'text', 'release_flg'];

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }

        Auth::user()->record()->save($record);

        return redirect('/calendar');
    }

    // public function createCategory($request) {

    //     $category = new Category;

    //     $co
    // }
}
