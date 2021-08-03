<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description', 'date_max', 'status', 'user_id','created_by'];

    public function users() {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function user_created() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
