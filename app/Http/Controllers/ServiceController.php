<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function index()
    {
        $services = Services::paginate(2);
        return view('admin.service.index', compact('services'));
    }

    function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|unique:services|max:255',
            'service_image' => 'required|mimes:jpg,jpeg,png'
        ], [
            'service_name.required' => 'กรุณาป้อนชื่อด้วยครับ',
            'service_name.unique' => 'ชื่อนี้มีแล้วครับ',
            'service_name.max' => 'ห้ามป้อนเกิน 255 ตัวอักษร',
            'service_image.required' => 'กรุณาใส่ภาพประกอบด้วยครับ'
        ]);

        $service_image = $request->file('service_image');
        $name_ex = hexdec(uniqid());
        $image_ex = strtolower($service_image->getClientOriginalExtension());
        $name_image = $name_ex . "." . $image_ex;

        $localtion = 'image/service/';
        $fullpart = $localtion . $name_image;

        Services::insert([
            'service_name' => $request->service_name,
            'service_image' => $fullpart,
            'created_at' => Carbon::now()
        ]);

        $service_image->move($localtion, $name_image);
        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    function edit($id)
    {
        $services = Services::find($id);
        return view('admin.service.edit', compact('services'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|max:255',

        ], [
            'service_name.required' => 'กรุณาป้อนชื่อด้วยครับ',
            'service_name.max' => 'ห้ามป้อนเกิน 255 ตัวอักษร',

        ]);
        $service_image = $request->file('service_image');

        if ($service_image) {
            $name_ex = hexdec(uniqid());
            $image_ex = strtolower($service_image->getClientOriginalExtension());
            $name_image = $name_ex . "." . $image_ex;

            $localtion = 'image/service/';
            $fullpart = $localtion . $name_image;

            Services::find($id)->update([
                'service_name' => $request->service_name,
                'service_image' => $fullpart

            ]);

            $old_image = $request->old_image;
            unlink($old_image);

            $service_image->move($localtion, $name_image);
            return redirect()->route('services')->with('success', 'บันทึกข้อมูลเรียบร้อย');
        } else {
            Services::find($id)->update([
                'service_name' => $request->service_name,
            ]);
            return redirect()->route('services')->with('success', 'บันทึกข้อมูลเรียบร้อย');
        }
    }
    function delete($id)
    {
        $deleteimage = Services::find($id)->service_image;
        unlink($deleteimage);
        $delete = Services::find($id)->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
