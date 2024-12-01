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
