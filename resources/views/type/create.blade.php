@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h5 class="card-title fw-semibold mb-4 mt-1">Thêm thể loại câu hỏi</h5>
                        <div class="mx-3">
                            <a href="{{route('type.list')}}" class="icon-hover">
                                <i class="ti ti-clipboard-data fs-30 cursor-pointer text-success" title="Danh sách"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('type.insert')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên thể loại <span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="name" name="name" required
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mb-4">
                                            <label for="number" class="form-label">Số lượng câu trả lời <span class="text-danger">(*)</span></label>
                                            <select class="form-select" name="number" aria-label="Default select example" required id="number">
                                                <option>-----Vui lòng chọn số lượng-----</option>
                                                @foreach ($numbers as $key => $number)
                                                <option value="{{$key}}">{{$number}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <button type="reset" class="btn btn-secondary mx-3">Nhập lại</button>
                                    <a href="{{route('type.list')}}" class="btn btn-warning">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
