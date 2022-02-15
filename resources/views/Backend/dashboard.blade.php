@extends('Backend.master')
@section('header_title','Dashboard')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Daily Task Manager Application</h1>
            <p class="col-md-8 fs-4">This is a simple task manager app is used for maintaining daily tasks.The front page(task) consists of a list of tasks where users able to create, update and delete their tasks and filter their task by date also.For better experience you can use this app by clicking next button.</p>
            <a href="{{route('task.index')}}"> <button type="button" class="btn btn-outline-primary">Next Page <i class="fa fa-angle-double-right"></i></button></a>
        </div>
    </div>
@endsection


@push('script')

@endpush
