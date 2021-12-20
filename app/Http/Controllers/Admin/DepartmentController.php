<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //

    public function index()
    {
        $data = [
            'departments' => Department::all()
        ];
        return view('admin.departments.index')->with($data);
    }

    public function create()
    {
        return view('admin.departments.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $department = Department::create([
            'name' => $request->name
        ]);
        $request->session()->flash('success', 'Department has been successfully added');
        return redirect()->route('admin.departments.index');
    }

    public function destroy($department_id) {
    $department = Department::findOrFail($department_id);
        // deletes the department
        $department->delete();
        request()->session()->flash('success', 'Department record has been successfully deleted');
        return back();
    }

}
