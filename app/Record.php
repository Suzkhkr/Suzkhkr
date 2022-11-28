<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function like() {
        return $this->belongsTo('App\Like');
    }
    
    public function comment() {
        return $this->belongsTo('App\Comment');
    }

    // public static $rules = [
    //     'image' => 'image|file'
    // ];

    protected $fillable = [
        'image', 'remind_date', 'category_id', 'title', 'text', 'release_flg',
    ];

    protected $dates = [
        'remind_date',
    ];
}
