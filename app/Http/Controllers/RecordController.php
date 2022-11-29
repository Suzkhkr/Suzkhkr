<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Category;

use Carbon\Carbon;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateData2;
use App\Http\Requests\Createdata3;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Record $record)
    {
        $user = User::find(Auth::id());
        $categories = Category::all();

        $data = DB::table('records')
        ->select(
            'records.id',
            'records.user_id',
            'records.remind_date',
            'records.category_id',
            'records.title',
            'records.text',
            'records.opened_flg',
            'u.user_name',
            'u.profile_image',
            'c.name',
            'c.category_id as category'
        )
        ->leftJoin('users as u', 'records.user_id', '=', 'u.id')
        ->leftJoin('categories as c', 'records.category_id', '=', 'c.id')
        ->where('u.id', '=' ,Auth::id())
        ->get();

        $now = Carbon::now()->format("Y-m-d");
    
        return view('myRecords', [
            'user' => $user,
            'data' => $data,
            'record' => $record,
            'categories' => $categories,
            'id' => $record->id,
            'now' => $now,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::id());


        $category = Category::all()->toArray();
        

        return view('createRecordsForm', [
            'user' => $user,
            'categories' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateData $request)
    {
        $record = new Record;
        $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];
        if(empty($request->release_flg))$request->release_flg = 1;        
        // 画像情報がセットされていれば、保存処理を実行
        if($request->image) {
            $file_name = $request->image->getClientOriginalName();
            $img = $request->image->storeAs('', $file_name, 'public');
            $record->image = $img;
        }else{
            $record->image = '';
        }



        foreach($columns as $column) {
            $record->$column = $request->$column;
        }

        Auth::user()->record()->save($record);
        // Auth::user()->record()->save($image);

        return redirect()->route('calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        $user = User::find(Auth::id());
        // $date = $record->remind_date->format('Y/m/d');
        $categories = Category::all();
        // dd($record['remind_date']);
        // $result = Record::all()->find();
        return view('editRecordsForm', [
            'user' => $user,
            'id' => $record->id,
            'result' => $record,
            'categories' => $categories,
            // 'date' => $date,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateData $request, Record $record)
    {
        // dd($request->remind_date);
        $columns = ['remind_date', 'category_id', 'title', 'text', 'release_flg'];

        // 画像情報がセットされていれば、保存処理を実行
        if(empty($request->image)) {
            $record->image = '';
        }elseif($request->image == $record->image) {
            $record->image = $record->image;
        }elseif($request->image != $record->image) {
            $file_name = $request->image->getClientOriginalName();
            $img = $request->image->storeAs('', $file_name, 'public');
            $record->image = $img;
        }
            
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();
        return redirect('records');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return redirect('records');
    }
}
