<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello {{Auth::user()->name}}

            <b class="float-end">จำนวนผู้ใช้ <span>{{count($users)}}</span> คน</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">userID</th>
                            <th scope="col">created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$row->name}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->created_at->diffForHumans()}}</td>
                            
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>