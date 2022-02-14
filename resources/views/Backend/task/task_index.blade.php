@extends('Backend.master')
@section('header_title','All Task')
@push('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('content')
    @if (isset($success))
        <div class="alert alert-success alert-dismissible fade show">
            <p>{{ $success }}</p>
        </div>
    @endif
    <div class="card pa-4">
        <div class="card-body">
            <table id="dataTable" class="table table-sm my-4">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Duration</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $task)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{$task->due_date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                        <td>{{ $task->duration }}</td>
                        <td class="text-capitalize">{{ \App\Http\Helpers\BaseHelper::ValueOf($task->type,\App\Models\Task::TYPE) }}</td>
                        <td>
                            <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                                <a class="btn btn-sm btn-primary" href="{{route('task.edit',$task->id)}}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>
                                    <i class="fa fa-trash"></i>
                                    Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Delete !`,
                text:'Are you sure you want to delete this record?',
                icon: "warning",
                dangerMode: true,
                buttons: true,

            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Task has been deleted !", "You clicked the button!", "success");
                        form.submit();
                    }
                });
        });

    </script>
@endpush
