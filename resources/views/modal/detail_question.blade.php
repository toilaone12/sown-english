<div class="modal-dialog" role="document" style="width: 500px;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chi tiết câu hỏi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bolder">Tên câu hỏi: {{$one->name}}</h5>
                    @if ($one->image)
                    <img src="{{$one->image}}" class="card-img-top" alt="...">                           
                    @endif
                    @if (isset($answers) && $answers)    
                    @foreach ($answers as $key => $answer)
                    <p class="card-text{{$key != 1 ? '' : ' mt-5'}}">
                        @foreach ($answer as $key => $ans)
                            {{$key}}. {{$ans}}
                        @endforeach
                    </p>
                    @endforeach
                    @endif
                    <h4 class="fw-bold my-4">Đáp án: {{$one->correct}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
