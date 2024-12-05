
function getAjax(url, data, success, error, dataType = 'json') {
    $.ajax({
        method: "GET",
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: dataType,
        success: success,
        error: error
    });
}

function postAjax(url, data, success, error, dataType = 'json', isFormData = 0) {
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: isFormData ? false : true,
        contentType: isFormData ? false : 'application/x-www-form-urlencoded',
        dataType: dataType,
        success: success,
        error: error
    });
}

function swalInfo(title, text, callback) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'info',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
    }).then((res) => {
        if (res.isConfirmed) {
            callback(true);
        }
    });
}

function swalNoti(title, text, icon, textConfirm, callback) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCloseButton: true,
        confirmButtonText: textConfirm,
    }).then((res) => {
        if (res.isConfirmed) {
            callback(true);
        }
    });
}

function frameAnswer(number) {
    let html = ``;
    for (let i = 0; i < number; i++) {
        let arr = ['']
        if(number == 2) arr = ['A','B'];
        if(number == 3) arr = ['A','B','C'];
        if(number == 4) arr = ['A','B','C','D'];
        html += `<div class="col-${number == 1 ? '12' : (number == 2 ? '6' : (number == 3 ? '4' : '3'))}">
            <div class="mb-4">
                <div class="mb-3">
                    <label for="answer${number == 1 ? '' : '-'+arr[i]}" class="form-label">Câu trả lời ${arr[i]} <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" id="answer${number == 1 ? '' : '-'+arr[i]}" name="answer[]" required
                        aria-describedby="emailHelp">
                </div>
            </div>
        </div>`
    }
    return html;
}
