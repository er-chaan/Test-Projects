@extends('layout.layout')
@section('content')
    <h1>Edit Task</h1>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
     <form action="{{url('tasks', [$task->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
     <div class="form-group">
        <label for="task_name">task_name</label>
        <input type="text" class="form-control" id="taskName" value="{{$task->task_name}}" name="task_name" >
      </div>
      <div class="form-group">
        <label for="start_date">start_date</label>
        <input type="date" class="form-control" id="startDate" value="{{$task->start_date}}" name="start_date" >
      </div>
      <!-- <div class="form-group">
        <label for="end_date">end_date</label>
        <input type="date" class="form-control" id="endDate" value="{{$task->end_date}}" name="end_date" >
      </div> -->
      <div class="form-group">
        <label for="duration">duration</label>
        <input type="number" class="form-control" id="duration" value="{{$task->duration}}" name="duration" >
      </div>
      <div class="form-group">
        <label for="dependancy_task">dependancy_task</label>
        <input type="text" class="form-control" id="dependancyTask" value="{{$task->dependancy_task}}" name="dependancy_task" >
      </div>
      <div class="form-group">
        <label for="dependancy_condition">dependancy_condition</label>
        <input type="text" class="form-control" id="dependancyCondition" value="{{$task->dependancy_condition}}" name="dependancy_condition" >
      </div>
      <div class="form-group">
        <label for="dependancy_days">dependancy_days</label>
        <input type="number" class="form-control" id="dependancyDays" value="{{$task->dependancy_days}}" name="dependancy_days" >
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control" id="description" value="{{$task->description}}" name="description" >
      </div>
      <!-- <div class="form-group">
        <label for="status">status</label>
        <input type="text" class="form-control" id="status" value="{{$task->status}}" name="status" >
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection