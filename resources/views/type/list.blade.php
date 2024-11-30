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
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="listTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tên thể loại</th>
                                        <th>Kiểu thể loại</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $one)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
