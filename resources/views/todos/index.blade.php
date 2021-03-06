@extends('layouts.app')

@section('titie')
    Todos List
@endsection

@section('content')
    <h1 class="text-center my-5">TODOS PAGE</h1>
       <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        ToDos
                    </div>
                </div>
        
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($todos as $todo)
                            <li class="list-group-item">
                                {{ $todo->name }}

                                {{-- <button class="btn btn-primary btn-sm float-right">View</button> --}}
                                @if(!$todo->completed)
                                    <a href="/todos/{{ $todo->id }}/complete" style="color: white" class="btn btn-warning btn-sm float-right">Complete </a>
                                @endif 
                                <a href="/todos/{{ $todo->id }}" class="btn btn-primary btn-sm float-right mr-2">View</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
       </div>
   </div>
@endsection