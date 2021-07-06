<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello {{Auth::user()->name}}


        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            @if(session('success'))
                            <b class="alert alert-success">{{session('success')}}</b>
                            @endif
                            <div class="card">
                                <div class="card-header">ชื่อตำแหน่งงาน</div>
                                <table class="table table-success table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">userID</th>
                                            <th scope="col">created_at</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($department as $row)
                                        <tr>
                                            <th scope="row">{{$department->firstItem()+$loop->index}}</th>
                                            <td>{{$row->department_name}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>{{$row->created_at->diffForHumans()}}</td>
                                            <td><a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a></td>
                                            <td><a href="{{url('/department/delete/'.$row->id)}}" class="btn btn-danger">ลบข้อมูล</a></td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{$department->links()}}
                            </div>
                            @if(count($departmentde)> 0)
                            <div class="card my-2">
                                <div class="card">


                                    <div class="card-header">ถังขยะ</div>
                                    <table class="table table-success table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">ชื่อ</th>
                                                <th scope="col">userID</th>
                                                <th scope="col">created_at</th>
                                                <th scope="col">กู้ข้อมูล</th>
                                                <th scope="col">ลบข้อมูลถาวร</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($departmentde as $row)
                                            <tr>
                                                <th scope="row">{{$departmentde->firstItem()+$loop->index}}</th>
                                                <td>{{$row->department_name}}</td>
                                                <td>{{$row->user->name}}</td>
                                                <td>{{$row->created_at->diffForHumans()}}</td>
                                                <td><a href="{{url('/department/restore/'.$row->id)}}" class="btn btn-primary">กู้ข้อมูล</a></td>
                                                <td><a href="{{url('/department/fdelete/'.$row->id)}}" class="btn btn-danger" onclick="return confirm('ต้องการลบข้อมูลถาวรหรือไม่ ?')">ลบข้อมูลถาวร</a></td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{$departmentde->links()}}
                                </div>

                            </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">แบบฟอร์ม</div>
                                <div class="card-body">
                                    <form action="{{route('addDepartment')}}" method="get">
                                        @csrf
                                        <div class="form-group">
                                            <label for="department_name">ชื่อตำแหน่งงาน</label>
                                            <input type="text" class="form-control" name="department_name">
                                        </div>
                                        @error('department_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <br>

                                        <input type="submit" value="บันทึก" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>