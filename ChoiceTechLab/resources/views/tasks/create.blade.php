@extends('layout.layout')
@section('content')
    <h1>Add New Task</h1>
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
     <form action="/tasks" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="task_name">task_name</label>
        <input type="text" class="form-control" id="taskName"  name="task_name" >
      </div>
      <div class="form-group">
        <label for="start_date">start_date</label>
        <input type="date" class="form-control" id="startDate" name="start_date" >
      </div>
      <!-- <div class="form-group">
        <label for="end_date">end_date</label>
        <input type="date" class="form-control" id="endDate" name="end_date" >
      </div> -->
      <div class="form-group">
        <label for="duration">duration</label>
        <input type="number" class="form-control" id="duration" name="duration" >
      </div>
      <div class="form-group">
        <label for="dependancy_task">dependancy_task</label>
        <input type="text" class="form-control" id="dependancyTask" name="dependancy_task" >
      </div>
      <div class="form-group">
        <label for="dependancy_condition">dependancy_condition</label>
        <input type="text" class="form-control" id="dependancyCondition" name="dependancy_condition" >
      </div>
      <div class="form-group">
        <label for="dependancy_days">dependancy_days</label>
        <input type="number" class="form-control" id="dependancyDays" name="dependancy_days" >
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control" id="description" name="description" >
      </div>
      <!-- <div class="form-group">
        <label for="status">status</label>
        <input type="text" class="form-control" id="status" name="status" >
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection