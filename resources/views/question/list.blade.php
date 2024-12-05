@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h5 class="card-title fw-semibold mb-4 mt-1">Danh sách</h5>
                        <div class="mx-3">
                            <a href="{{route('question.create')}}" class="icon-hover">
                                <i class="ti ti-circle-plus fs-30 cursor-pointer text-primary" title="Thêm câu hỏi"></i>
                            </a>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('question.trash')}}" class="icon-hover">
                                <i class="ti ti-recycle fs-30 cursor-pointer text-warning" title="Xem thùng rác"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="listTable" class="table table-stripped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên câu hỏi</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $key => $one)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td width="500">{{$one->name}}</td>
                                        <td width="100">
                                            <div data-href="{{route('question.detail',['id' => $one->id])}}" data-bs-toggle="modal" data-bs-target="#modal_all_box" class="btn-open-modal d-block mb-2">
                                                <i class="ti ti-list-details fs-30 cursor-pointer text-primary" title="Xem chi tiết"></i>
                                            </div>
                                            <a href="{{route('question.edit',['id' => $one->id])}}" class="d-block mb-2">
                                                <i class="ti ti-edit fs-30 cursor-pointer text-success" title="Sửa"></i>
                                            </a>
                                            <div class="d-block delete-question" data-id="{{$one->id}}" data-name="{{$one->name}}">
                                                <i class="ti ti-trash fs-30 cursor-pointer text-danger" title="Bỏ vào thùng rác"></i>
                                            </div>
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
