<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function record() {
        return $this->belongsTo('App\Record');
    }

    public function like_exist($userId, $recordId) {

        return Like::where([
            ['user_id', $userId],
            ['record_id', $recordId],
        ])->first();
    }
}
