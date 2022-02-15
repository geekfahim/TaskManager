@extends('Backend.master')
@section('header_title','All Task')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('top_button')
    <a href="{{route('task.create')}}" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add New Task</a>
@endsection
@section('content')
    @if (isset($success))
        <div class="alert alert-success alert-dismissible fade show">
            <p>{{ $success }}</p>
        </div>
    @endif
    <div class="card pa-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                           readonly/>
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly/>
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="taskTable" class="table table-bordered table-striped my-4">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Employee</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Duration</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th style="width: 80px;">Action</th>
                </tr>
                </thead>


            </table>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">

        flatpickr("#from_date", {dateFormat: "Y-m-d"});
        flatpickr("#to_date", {dateFormat: "Y-m-d"});

        getData();

        function getData(from_date = '', to_date = '') {
            $('#taskTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("task.index") }}',
                    data: {from_date: from_date, to_date: to_date}
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'employee.name',
                        name: 'employee.name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    },
                    {
                        data: 'duration',
                        name: 'duration'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }
        $('#filter').click(function () {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $('#taskTable').DataTable().destroy();
                getData(from_date, to_date);
            } else {
                swal({
                    title: "Error !",
                    text: "Both Date Requried !",
                    icon: "error"
                });
            }
        });

        $('#refresh').click(function () {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#taskTable').DataTable().destroy();
            getData();
        });
        $("#taskTable").on("click", ".show_confirm", function () {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Delete !`,
                text: 'Are you sure you want to delete this record?',
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
