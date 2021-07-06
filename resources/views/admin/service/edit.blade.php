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
                            <div class="card">
                                <div class="card-header">แบบฟอร์ม</div>
                                <div class="card-body">
                                    <form action="{{url('/service/update/'.$services->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="service_name">ชื่อตำแหน่งงาน</label>
                                            <input type="text" class="form-control" name="service_name" value="{{$services->service_name}}">
                                        </div>
                                        @error('service_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label for="service_image">ภาพประกอบ</label>
                                            <input type="file" class="form-control" name="service_image" value="{{$services->service_image}}">
                                        </div>
                                        @error('service_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <br>
                                        <input type="hidden" name="old_image" value="{{$services->service_image}}">
                                        <div class="form-group">
                                        <img src="{{asset($services->service_image)}}" alt="" width="350" height="350">
                                        </div>

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