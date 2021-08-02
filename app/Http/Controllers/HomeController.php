<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::query()->orderBy('id', 'desc')
            ->with('users')
            ->get()->map(function ($value) {
                return (object)[
                    'id' => $value->id,
                    'description' => $value->description,
                    'date_max' => $value->date_max,
                    'user_id' => $value->user_id,
                    'status' => $value->status,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                    'is_expired' => Carbon::parse($value->date_max) <= Carbon::now(),
                    'users' => $value->users
                ];
            });
        return view('home', compact('tasks'));
    }
}
