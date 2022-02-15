<?php

namespace App\Http\Controllers;

use App\Http\Helpers\BaseHelper;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\throwException;

class TaskController extends Controller
{
    public function dashboard()
    {
        return view('Backend.dashboard');
    }

    /*    public function index(Request $request)
        {
            $data = Task::all();
            //$data = Task::select()->whereDate($request->date)->get()
            return view('Backend.task.task_index', compact('data'));
        }*/


    public function index(Request $request)
    {


        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = Task::select('id', 'title', 'start_date', 'due_date', 'duration', 'type', 'status', 'employee_id')->whereBetween('due_date', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = Task::with('employee')->select('id', 'title', 'start_date', 'due_date', 'duration', 'type', 'status', 'employee_id')->get();
            }
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('start_date', function ($data) {
                    return $data->start_date->toFormattedDateString();
                })
                ->editColumn('due_date', function ($data) {
                    return $data->due_date->toFormattedDateString();
                })
                ->editColumn('type', function ($data) {
                    if ($data->type == 1) return '<span class="badge warning">Pending</span>';
                    if ($data->type == 2) return 'Deadline';
                    if ($data->type == 3) return 'Delayed';
                    if ($data->type == 4) return 'Completed';
                    return '';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) return '<span class="badge warning">Ongoing</span>';
                    if ($data->status == 2) return '<span class="badge bg-danger">Due</span>';
                    if ($data->status == 3) return '<span class="badge bg-danger">Delayed</span>';
                    if ($data->status == 4) return '<span class="badge bg-primary">Completed</span>';
                    return '';
                })
                ->addColumn('action', function ($data) {

                    $url_edit = url('task/' . $data->id . '/edit');
                    $url_delete = url('task/' . $data->id);
                    $edit = '<a class = "btn btn-sm btn-primary" href = "' . $url_edit . '" title = "Edit">
                           <i class = "fa fa-edit"></i>
                            Edit
                        </a>';
                    $delete = '<form action="' . $url_delete . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn btn-sm btn-danger show_confirm" id="">Delete</button>
                    </form>';
                    return $edit. $delete;
                })
                ->rawColumns(['action','type', 'status'])
                ->make(true);

        }
        return view('Backend.task.task_index');
    }

    public function create()
    {
        $types = Task::TYPE;
        $employees = Employee::select(['id', 'name'])->get();
        $statuses = Task::STATUSES;
        return view('Backend.task.task_create', compact('types', 'employees', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'employee' => ['required'],
            'status' => ['required'],
            'type' => ['required'],
        ]);
        $item = new Task();
        $item->title = $request->title;
        $item->start_date = $request->start_date;
        $item->due_date = $request->due_date;
        $item->duration = $request->duration;
        $item->employee_id = $request->employee;
        $item->status = BaseHelper::IndexOf($request->status, Task::STATUSES);
        $item->type = BaseHelper::IndexOf($request->type, Task::TYPE);

        $item->save();
        return redirect()->route('task.index')
            ->with('message', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        $types = Task::TYPE;
        $statuses = Task::STATUSES;
        $employees = Employee::select(['id', 'name'])->get();
        return view('Backend.task.task_edit', compact('task', 'types', 'employees', 'statuses'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', Rule::unique('tasks', 'title')->ignore($task->id)],
            'due_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'employee' => ['required'],
            'status' => ['required'],
            'type' => ['required'],
        ]);
//        dd($request->all());

        $task->title = $request->title;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->duration = $request->duration;
        $task->employee_id = $request->employee;
        $task->status = BaseHelper::IndexOf($request->status, Task::STATUSES);
        $task->type = BaseHelper::IndexOf($request->type, Task::TYPE);

        $task->save();
        return redirect()->route('task.index')
            ->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')
            ->with('success', 'Task deleted successfully');
    }
}
