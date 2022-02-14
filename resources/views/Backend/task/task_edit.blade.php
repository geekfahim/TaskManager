@extends('Backend.master')
@section('header_title','Edit Task')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Validation Failed !</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="g-3" action="{{ route('task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-4">
                    <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" value="{{$task->title}}">
                </div>
                <div class="col-md-4 my-2">
                    <label for="due_date" class="form-label">Due Date<span class="text-danger">*</span></label>
                    <div class="input-group date" id="datetimepicker">
                        <input type="text" name="due_date" id="due_date" class="form-control"
                               value="{{$task->due_date}}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <label for="duration" class="form-label">Duration<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="duration" id="duration" placeholder=""
                           value="{{$task->duration}}">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Type <span class="text-danger">*</span></label>
                    <select id="inputState" name="type" class="form-select">
                        <option value="">Select One...</option>
                        @foreach($types as $type)
                            <option
                                value="{{$type}}" {{\App\Http\Helpers\BaseHelper::IndexOf($type,\App\Models\Task::TYPE)===$task->type? 'selected' : ''}}>{{$type}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4  my-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#due_date", {enableTime: true, dateFormat: "Y-m-d H:i",});
        flatpickr("#duration",{
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minTime: "00:00",
            time_24hr: true
        });
    </script>
@endpush
