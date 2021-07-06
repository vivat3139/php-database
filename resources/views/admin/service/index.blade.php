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
                                            <th scope="col">ภาพประกอบ</th>
                                            <th scope="col">เวลาเริ่มใช้งาน</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $row)
                                        <tr>
                                            <th scope="row">{{$services->firstItem()+$loop->index}}</th>
                                            <td><img src="{{asset($row->service_image)}}" alt="" width="350" height="350"></td>
                                            <td>{{$row->created_at->diffForHumans()}}</td>
                                            <td>{{$row->service_name}}</td>
                                            <td><a href="{{url('/service/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a></td>
                                            <td><a href="{{url('/service/delete/'.$row->id)}}" class="btn btn-danger" >ลบข้อมูล</a></td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{$services->links()}}
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">แบบฟอร์ม</div>
                                <div class="card-body">
                                    <form action="{{route('addServices')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="service_name">ชื่อ</label>
                                            <input type="text" class="form-control" name="service_name">
                                        </div>
                                        @error('service_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label for="service_image">ภาพประกอบ</label>
                                            <input type="file" class="form-control" name="service_image">
                                        </div>
                                        @error('service_image')
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