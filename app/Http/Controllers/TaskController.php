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
    public function dashboard(){
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
//        $request->from_date="2020-02-05";
//        $request->to_date="2022-03-05";
        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
                $data = Task::whereBetween('due_date', array($request->from_date, $request->to_date))
                    ->get();
            }
            else {
                $data = Task::all();
            }
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
/*                    $btn = "<form method='POST' action='{{ route("task.destroy", $data->id) }}'>
                                     <a class='btn btn-sm btn-primary' href='{{route("task.edit",$data->id)}}">
                                         <i class="fa fa-edit"></i> Edit
                                     </a>
                                     @csrf
                                     <input name="_method" type="hidden" value="DELETE">
                                     <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>
                                         <i class="fa fa-trash"></i>
                                         Delete</button>
                                 </form>";
                    return $btn;*/
                })
                ->rawColumns(['action'])
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
            'due_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'employee' => ['required'],
            'status' => ['required'],
            'type' => ['required'],
        ]);
        $item = new Task();
        $item->title = $request->title;
        $item->due_date = $request->due_date;
        $item->duration = $request->duration;
        $item->employee_id = $request->employee;
        $item->status = BaseHelper::IndexOf($request->status, Task::STATUSES);
        $item->type = BaseHelper::IndexOf($request->type, Task::TYPE);
//        dd($item);
        $item->save();
        return redirect()->route('task.index')
            ->with('essage', 'Task created successfully.');
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
