<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tasks = Task::query()->orderBy('id', 'desc')
            ->with('users')
            ->get()->map(function ($value) {
            return (object) [
                'id' => $value->id,
                'description' => $value->description,
                'date_max' => $value->date_max,
                'user_id' => $value->user_id,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'is_expired' => Carbon::parse($value->date_max) <= Carbon::now()
            ];
        });
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'date_max'   => Carbon::parse($request->date_max),
            'status'     => 'Open',
            'created_by' => Auth::id()]);
        $request->validate([
            'description' => 'required',
            'date_max'    => 'required',
        ],
        [
            'description.required' => 'Debe colocar una descripción para la tarea'
        ]
        );
        Task::query()->create($request->all());
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task)
    {
        $task = Task::where('id', $task->id)->with('users')->first();
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
