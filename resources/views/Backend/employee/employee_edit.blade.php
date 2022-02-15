@extends('Backend.master')
@section('header_title','Edit Employee')
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
            <form class="g-3" action="{{ route('employee.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-4 ">
                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$employee->name}}" required>
                </div>
                <div class="col-md-4 ">
                    <label for="office_id" class="form-label">Office id<span class="text-danger">*</span></label>
                    <input type="text" name="office_id" class="form-control" id="office_id" value="{{$employee->office_id}}">
                </div>
                <div class="col-md-4 ">
                    <label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
                    <input type="text" name="designation" class="form-control" id="designation"  value="{{$employee->designation}}">
                </div>
                <div class="col-md-4 ">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" id="email" value="{{$employee->email}}">
                </div>
                <div class="col-md-4 ">
                    <label for="mobile" class="form-label">Mobile<span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" id="mobile" value="{{$employee->mobile}}">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Status <span class="text-danger">*</span></label>
                    <select id="inputState" name="status" class="form-select">
                        <option value="">Select One...</option>
                        @foreach($statuses as $status)
                            <option
                                value="{{$status}}" {{\App\Http\Helpers\BaseHelper::IndexOf($status,\App\Models\Employee::STATUSES)===$employee->status? 'selected' : ''}}>
                                {{$status}}
                            </option>
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
        flatpickr("#start_date", {dateFormat: "Y-m-d H:i",});
        flatpickr("#duration", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minTime: "00:00",
            time_24hr: true
        });
    </script>
@endpush
