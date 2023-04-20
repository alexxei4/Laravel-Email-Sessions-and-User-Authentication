@extends('layouts.app')
@section('styles')
<style>
    #outer
    {
        width:100%;
        text-align:center;

    }
    .inner
    {
        display:inline-block;
    }
    .card-header{
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('todolists.create') }}"><button type="button" class="btn btn-primary"> + New Todo</button></a>

                   
                    <form method="POST" action="{{ route('todolists.save') }}">
                        @csrf
                        <button type="submit" class="btn btn-info">Save List</button></a>
                    </form>
                    <a href="{{ route('todolists.restore') }}"><button type="button" class="btn btn-warning">Restore</button></a>
                    <a href="{{ route('todolists.delete') }}" alert= "alert alert-success"><button type="button"class="btn btn-danger">Clear Entire List</button></a>
                    <a href="{{ route('todolists.listsent') }}"><button type="button"class="btn btn-secondary">Email List</button></a>
            
                </div>
                <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(count($todolists) > 0 || session()->has('todos'))
    <h4>All Todos</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Due Date</th>
            </tr>
        </thead>
        <tbody>
                        @php
                            $todos = [];
                            if (session()->has('todos')) {
                                $todos = array_merge($todos, session()->get('todos'));
                            }
                            if (count($todolists) > 0) {
                                $todos = array_merge($todos, $todolists->toArray());
                            }
                        @endphp
                        @if(count($todos) > 0)
                            @foreach($todos as $index => $todo)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $todo['title'] }}</td>
                                    <td>{{ $todo['description'] }}</td>
                                    <td>{{ $todo['due_date'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No Todos Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @else
                <h4>No Todos Found</h4>
            @endif

                </div>
            </div>
        </div>
    </div>
@endsection


