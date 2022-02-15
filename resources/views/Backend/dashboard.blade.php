@extends('Backend.master')
@section('header_title','Dashboard')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header">Total Employee</h5>
                            <center><h1>20</h1></center>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header">Total Task</h5>
                            <center><h1>19</h1></center>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-danger  mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header">Delayed Task</h5>
                            <center><h1>11</h1></center>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header">Completed Task</h5>
                            <center><h1>8</h1></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Daily Task Manager Application</h1>
            <p class="col-md-8 fs-4">This is a simple task manager app is used for maintaining daily tasks.The front page(task) consists of a list of tasks where users able to create, update and delete their tasks and filter their task by date also.For better experience you can use this app by clicking next button.</p>
            <a href="{{route('task.index')}}"> <button type="button" class="btn btn-outline-primary">Next Page <i class="fa fa-angle-double-right"></i></button></a>
        </div>
    </div>
@endsection


@push('script')

@endpush
