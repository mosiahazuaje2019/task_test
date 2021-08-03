<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['action', 'description', 'user_id', 'task_id'];

    public function tasks () {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function users () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
