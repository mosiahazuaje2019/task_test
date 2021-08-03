<?php

namespace App\Observers;

use App\Log;
use App\Mail\MailNotifyUser;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LogObserver
{
    /**
     * Handle the log "created" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function created(Log $log)
    {
        $user_email = DB::table('tasks')
            ->select('users.email')
            ->join('users','tasks.created_by', '=', 'users.id')
            ->where('tasks.id', $log->task_id)
            ->first()->email;

        $user = Log::where('id', $log->id)
            ->with(['tasks', 'users'])
            ->first();

        Mail::to($user_email)->send(new MailNotifyUser($user));

    }

    /**
     * Handle the log "updated" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function updated(Log $log)
    {
        //
    }

    /**
     * Handle the log "deleted" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function deleted(Log $log)
    {
        //
    }

    /**
     * Handle the log "restored" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function restored(Log $log)
    {
        //
    }

    /**
     * Handle the log "force deleted" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function forceDeleted(Log $log)
    {
        //
    }
}
