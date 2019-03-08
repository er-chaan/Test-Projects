<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Library\Scheduler;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index',compact('tasks',$tasks));
    }

    public function generate(Scheduler $scheduler)
    {
        $tasks = Task::all();
        $result = $scheduler->generate($tasks);
        return view('tasks.generate',compact('tasks',$result));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'task_name' => 'required|min:1',
            'start_date' => 'required|date_format:Y-m-d',
            // 'end_date' => 'required|date_format:Y-m-d',
            'duration' => 'required|integer|min:0|digits_between: 0,30',
            // 'dependancy_task' => 'required',
            // 'dependancy_condition' => 'required',
            // 'dependancy_days' => 'required|integer|min:1|digits_between: 1,5',
            'description' => 'required',
            // 'status' => 'required',
        ]);
        $end_date = date('Y-m-d', strtotime($request->start_date. ' + '.$request->duration.' days'));
        $status = "store";
        // 'task_name','start_date','end_date','duration','dependancy_task',
        // 'dependancy_condition','dependancy_days','description','status'
        
        $task = Task::create(['task_name' => $request->task_name,
                            'start_date' => $request->start_date,
                            'end_date' => $end_date,
                            'duration' => $request->duration,
                            'dependancy_task' => $request->dependancy_task,
                            'dependancy_condition' => $request->dependancy_condition,
                            'dependancy_days' => $request->dependancy_days,
                            'description' => $request->description,
                            'status' => $status,
                            ]);
        return redirect('/tasks/'.$task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
        return view('tasks.show',compact('task',$task));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit',compact('task',$task));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'task_name' => 'required|min:1',
            'start_date' => 'required|date_format:Y-m-d',
            // 'end_date' => 'required|date_format:Y-m-d',
            'duration' => 'required|integer|min:0|digits_between: 0,30',
            // 'dependancy_task' => 'required',
            // 'dependancy_condition' => 'required',
            // 'dependancy_days' => 'required|integer|min:1|digits_between: 1,5',
            'description' => 'required',
            // 'status' => 'required',
        ]);
        $end_date = date('Y-m-d', strtotime($request->start_date. ' + '.$request->duration.' days'));
        $status = "update";
        $task->task_name = $request->task_name;
        $task->start_date = $request->start_date;
        $task->end_date = $end_date;
        $task->duration = $request->duration;
        $task->dependancy_task = $request->dependancy_task;
        $task->dependancy_condition = $request->dependancy_condition;
        $task->dependancy_days = $request->dependancy_days;
        $task->description = $request->description;
        $task->status = $status;
        $task->save();
        $request->session()->flash('message', 'Successfully modified the task!');
        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        //
        $task->delete();
        $request->session()->flash('message', 'Successfully deleted the task!');
        return redirect('tasks');
    }
}
