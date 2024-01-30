<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.others.departmentlist', [
            'departments' => Department::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'department_name' => 'required|unique:departments,department_name'
        ]);

        $department = Department::create($data);

        session()->flash('success', $department->department_name . ' added successfully.');
        return redirect()->route('department-index');
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'department_name' => 'required|unique:departments,department_name,'.$department->id.',id'
        ]);

        $department->fill($data);
        $department->save();

        session()->flash('success', $department->department_name . ' added successfully.');
        return redirect()->route('department-index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        session()->flash('success', $department->ndepartment_nameame .' deleted successfully.');
        return redirect()->route('department-index');
    }
}
