//datatable
$('#listTable').DataTable({
    "responsive": true,
    "pageLength": 10,
    "language": {
        "emptyTable":    "Hiện tại đang không có dữ liệu",
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem khoảng _MENU_",
        "sZeroRecords":  "Không tìm thấy kết quả nào phù hợp",
        "sInfo":         "Đang xem từ _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm kiếm:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Đầu tiên",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối cùng"
        }
    }
});

//notyf
const notyf = new Notyf({
    duration: 5000,
    ripple: true,
    position: {
        x: 'right',
        y: 'top',
    },
    dismissible: true,
});


 //chon anh cau hoi
 $('.open-file-question').on('change', function() {
    if($('.file-question').hasClass('d-none')) $('.file-question').removeClass('d-none')
    else $('.file-question').addClass('d-none')
})
//tai anh
$('.file-question').on('change', function() {
    let select = $(this)[0].files[0];
    let html = ``;
    if (select) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (select.type.startsWith('image/')) {
                html = `<img src="${e.target.result}" alt="" class="img-question">`;
            } else if (select.type.startsWith('video/')) {
                html = `<video width="350" height="275" controls>
                    <source src="${e.target.result}" type="video/mp4">
                </video>`
            } else if (select.type.startsWith('audio/')) {
                html = `<audio controls>
                    <source src="${e.target.result}" type="audio/mpeg">
                </audio>`
            }
            $('.show-file-question').html(html);
        };
        reader.readAsDataURL(select);
    } else {
        notyf.error('Bạn chưa chọn file');
    }
})
//chon the loai cau hoi
$('.choose-answer').on('change', function() {
    let number = $(this).val();
    let html = frameAnswer(number);
    $('.list-answer').html(html);
    if (number != '') $('.list-answer').parent().find('textarea').removeAttr('disabled').removeClass('pe-none')
    else $('.list-answer').parent().find('textarea').addClass('pe-none').attr('disabled', 'disabled')
})