<?php

namespace App\Http\Controllers;

use App\Log;
use App\Mail\MailNotifyUser;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id()]);
        Log::query()->create($request->all());

        $action = $request->action;
        if($action === 'assing_task'){
            $status = 'Process';
        }else {
            $status = 'Close';
        }

        DB::table('tasks')
            ->where('id', $request->task_id)
            ->update(['user_id' => Auth::id(), 'status' => $status]);

        return redirect()->route('home');
    }


    public function addLogs($id) {

        $task = Task::where('id', $id)->with('users')->first();
        $logs = Log::where('task_id', $id)->orderBy('id','desc')->get();

        if(Auth::id() !== $task->user_id){
            Session::flash('message', "Ya tiene un usuario asignado");
            return Redirect::back();
        }
        return view('logs.addlogs', compact('task', 'logs'));

    }
}
