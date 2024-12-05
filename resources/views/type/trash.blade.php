@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h5 class="card-title fw-semibold mb-4 mt-1">Danh sách</h5>
                        <div class="mx-3">
                            <a href="{{route('type.create')}}" class="icon-hover">
                                <i class="ti ti-circle-plus fs-30 cursor-pointer text-primary" title="Thêm thể loại"></i>
                            </a>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('type.list')}}" class="icon-hover">
                                <i class="ti ti-list-details fs-30 cursor-pointer text-success" title="Danh sách"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="listTable" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên thể loại</th>
                                        <th>Kiểu thể loại</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $key => $one)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td width="200">{{$one->name}}</td>
                                        <td width="300">Có: <span class="text-danger fw-bolder">{{$one->number}}</span> kết quả trả lời</td>
                                        <td width="100">
                                            <a href="{{route('type.restore',['id' => $one->id])}}" class="d-block mb-2">
                                                <i class="ti ti-refresh fs-30 cursor-pointer text-success" title="Khôi phục"></i>
                                            </a>
                                            <a href="" class="d-block">
                                                <i class="ti ti-backspace fs-30 cursor-pointer text-danger" title="Xóa hoàn toàn"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
