@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h5 class="card-title fw-semibold mb-4 mt-1">Thêm câu hỏi</h5>
                        <div class="mx-3">
                            <a href="{{route('question.list')}}" class="icon-hover">
                                <i class="ti ti-clipboard-data fs-30 cursor-pointer text-success" title="Danh sách"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('question.insert')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="d-flex align-items-center mb-5 pb-5">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input open-file-question" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Có hình ảnh (video, âm thanh)</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="">
                                                <input class="form-control file-question rounded-end-0 d-none" type="file" id="formFile">
                                            </div>
                                        </div>
                                        <div class="col-5 show-file-question ms-5"></div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Câu hỏi <span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="name" name="name" required
                                                aria-describedby="emailHelp">
                                            @error('name')
                                                <span class="fs-13 text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mb-4">
                                            <label for="type_id" class="form-label">Số lượng câu trả lời <span class="text-danger">(*)</span></label>
                                            <select class="form-select choose-answer" name="type_id" aria-label="Default select example" required id="type_id">
                                                <option value="">-----Vui lòng chọn số lượng câu trả lời-----</option>
                                                @foreach ($types as $key => $type)
                                                <option value="{{$type['number']}}">{{$type['name']}}</option>
                                                @endforeach
                                            </select>
                                            @error('type_id')
                                                <span class="fs-13 text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="list-answer row">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="correct" class="form-label">Đáp án <span class="text-danger">(*)</span></label>
                                            <textarea name="correct" disabled id="" cols="30" required rows="10" id="correct" class="form-control pe-none"></textarea>
                                            @error('correct')
                                                <span class="fs-13 text-danger">{{$message}}</span>
                                            @enderror
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
