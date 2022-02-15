<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{

    public function index()
    {
        $data = Employee::all();
        return view('Backend.employee.employee_index', compact('data'));
    }

    public function create()
    {
       $statuses = Employee::STATUSES;
       return  view('Backend.employee.employee_create',compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'office_id' => ['required','numeric','digits_between:3,5'],
            'designation' => ['required', 'string'],
            'email' => ['required','email'],
            'mobile' => ['required','digits:11'],
            'status' => ['required'],
        ]);
        $item = new Employee();
        $item->name = $request->name;
        $item->office_id = $request->office_id;
        $item->designation = $request->designation;
        $item->email = $request->email;
        $item->mobile = $request->mobile;
        $item->mobile = $request->mobile;
        $item->save();
        return redirect()->route('employee.index')
            ->with('message', 'Employee created successfully.');
    }


    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        $statuses = Employee::STATUSES;
        return view('Backend.employee.employee_edit', compact( 'employee', 'statuses'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'office_id' => ['required', 'numeric', 'min:3', Rule::unique('employees', 'office_id')->ignore($employee->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($employee->id)],
            'designation' => ['required', 'string'],
            'mobile' => ['required','digits:11'],
            'status' => ['required'],
        ]);
        $employee->name = $request->name;
        $employee->office_id = $request->office_id;
        $employee->designation = $request->designation;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->mobile = $request->mobile;
        $employee->save();
        return redirect()->route('employee.index')
            ->with('message', 'Employee created successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully');
    }
}
