<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "title","content","user_id"
     ];

    public function user() {
        return $this->hasOne('App\User','id','user_id');
    }
}
