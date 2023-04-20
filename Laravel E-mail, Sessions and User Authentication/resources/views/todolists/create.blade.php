@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Create a thing to do</div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                <form method="post" action="{{ route('todolists.add') }}">
                    @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" cols="20" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Due Date:</label>
                            <input type="datetime-local" id="due_date" name="due_date">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection