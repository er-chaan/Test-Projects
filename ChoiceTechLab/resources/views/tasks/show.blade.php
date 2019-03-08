'task_name','start_date','end_date','duration','dependancy_task',
        'dependancy_condition','dependancy_days','description','status'
@extends('layout.layout')
@section('content')
<h1>Showing Task {{ $task->task_name }}</h1>
    <div class="jumbotron text-center">
        <p>
            <strong>task_name:</strong> {{ $task->task_name }}<br>
            <strong>start_date:</strong> {{ $task->start_date }}<br>
            <strong>end_date:</strong> {{ $task->end_date }}<br>
            <strong>duration:</strong> {{ $task->duration }}<br>
            <strong>dependancy_task:</strong> {{ $task->dependancy_task }}<br>
            <strong>dependancy_condition:</strong> {{ $task->dependancy_condition }}<br>
            <strong>dependancy_days:</strong> {{ $task->dependancy_days }}<br>
            <strong>description:</strong> {{ $task->description }}<br>
            <strong>status:</strong> {{ $task->status }}<br>
        </p>
    </div>
@endsection