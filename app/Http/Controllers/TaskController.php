<?php

namespace App\Http\Controllers;

use App\Http\Helpers\BaseHelper;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::all();
        return view('Backend.task.task_index',compact('data'));
    }

    public function create()
    {
        $types = Task::TYPE;
        return view('Backend.task.task_create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'due_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'type' => ['required']
        ]);
        $item = new Task();
        $item->title = $request->title;
        $item->due_date = $request->due_date;
        $item->duration = $request->duration;
        $item->type = BaseHelper::IndexOf($request->type,Task::TYPE);
        $item->save();
        return redirect()->route('task.index')
            ->with('message','Task created successfully.');
    }

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        $types = Task::TYPE;
        return view('Backend.task.task_edit',compact('task','types'));
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50',Rule::unique('tasks','title')->ignore($task->id)],
            'due_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'type' => ['required']
        ]);
//        dd($request->all());

        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->duration = $request->duration;
        $task->type = BaseHelper::IndexOf($request->type,Task::TYPE);
        $task->save();
        return redirect()->route('task.index')
            ->with('success','Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')
            ->with('success','Task deleted successfully');
    }
}
