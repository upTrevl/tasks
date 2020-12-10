<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Models\Task;
use App\Models\User;
use App\Notifications\NewTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTask $request
     * @return bool
     */
    public function store(StoreTask $request)
    {
        $users = User::all();
        $validated = $request->validated();
        if ($validated){
            $task = Task::create($request->all());
            \App\Events\newTask::dispatch($task);
            foreach ($users as $user){
                $user->notify(new NewTask($task));
            }
        }
        return back()->withSuccess("Задача успешно создана");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Inertia\Response
     */
    public function show(Task $task)
    {
        return Inertia::render('Task/TaskShow', [
            'task' => $task,
            'user' => Auth::user(),
        ]);

    }
    public function showArchive()
    {
        return Inertia::render('Task/Archive', [
            'user' => Auth::user(),
        ]);

    }

    public function accept(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->edit_by = $request->user;
        $task->status = 'process';
        $task->save();

    }

    public function close(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->edit_by = $request->user;
        $task->status = 'close';
        $task->save();

    }

    public function search($val)
    {
        $tasks = DB::table('tasks')
            ->where('car_number', 'like', '%' . $val . '%')
            ->get();

//        $tasks .= DB::table('tasks')
//            ->where('client_org', 'like', '%' . $val . '%')
//            ->get();

        return $tasks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
