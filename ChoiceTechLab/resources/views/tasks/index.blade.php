@extends('layout.layout')
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table table-bordered table-sm">
          <thead class="thead-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">task_name</th>
              <th scope="col">start_date</th>
              <th scope="col">end_date</th>
              <th scope="col">duration</th>
              <th scope="col">dependancy_task</th>
              <th scope="col">dependancy_condition</th>
              <th scope="col">dependancy_days</th>
              <!-- <th scope="col">description</th> -->
              <!-- <th scope="col">status</th> -->
              <!-- <th scope="col">created_at</th> -->
              <!-- <th scope="col">updated_at</th> -->
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
            <tr>
              <th scope="row">{{$task->id}}</th>
              <td><a href="/tasks/{{$task->id}}">{{$task->task_name}}</a></td>
              <td>{{$task->start_date}}</td>
              <td>{{$task->end_date}}</td>
              <td>{{$task->duration}}</td>
              <td>{{$task->dependancy_task}}</td>
              <td>{{$task->dependancy_condition}}</td>
              <td>{{$task->dependancy_days}}</td>
              <!-- <td>{{$task->description}}</td> -->
              <!-- <td>{{$task->status}}</td> -->
              <!-- <td>{{$task->created_at->toFormattedDateString()}}</td> -->
              <!-- <td>{{$task->updated_at->toFormattedDateString()}}</td> -->
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ URL::to('tasks/' . $task->id . '/edit') }}">
                      <button type="button" class="btn btn-warning">Edit</button>
                    </a>&nbsp;
                    <form action="{{url('tasks', [$task->id])}}" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                </div>
			        </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection
