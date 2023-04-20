@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"></div>
                <div class="card-body">
                <h1>TODO List</h1>
                    <ul>
                    @foreach ($todolists as $todolist)
                        <li>{{ $todolist->id }} {{ $todolist->title }} {{ $todolist->description }} {{ $todolist->due_date }}</li>
                    @endforeach
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
