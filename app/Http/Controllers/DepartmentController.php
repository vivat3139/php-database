<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    function index()
    {
        $department = Departments::paginate(3);
        $departmentde = Departments::onlyTrashed()->paginate(2);
        return view('admin.department.index', compact('department', 'departmentde'));
    }

    function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|unique:departments|max:255'
        ], [
            'department_name.required' => 'กรุณาป้อนชื่อตำแหน่งด้วยครับ',
            'department_name.unique' => 'ชื่อตำแหน่งนี้มีแล้วครับ',
            'department_name.max' => 'ห้ามป้อนเกิน 255 ตัวอักษร'
        ]);

        $department = new Departments;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    function edit($id)
    {
        $department = Departments::find($id);
        return view('admin.department.edit', compact('department'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required|unique:departments|max:255'
        ], [
            'department_name.required' => 'กรุณาป้อนชื่อตำแหน่งด้วยครับ',
            'department_name.unique' => 'ชื่อตำแหน่งนี้มีแล้วครับ',
            'department_name.max' => 'ห้ามป้อนเกิน 255 ตัวอักษร'
        ]);
        $department = Departments::find($id)->update([
            'department_name' => $request->department_name,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('departments')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    function delete($id)
    {
        $delete = Departments::find($id)->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลเรียบร้อย');
    }

    function restore($id)
    {
        $restore = Departments::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'กู้ข้อมูลเรียบร้อย');
    }
    function fdelete($id)
    {
        $fdelete = Departments::onlyTrashed()->find($id)->forcedelete();
        return redirect()->back()->with('success', 'ลบข้อมูลถาวรเรียบร้อย');
    }
}
