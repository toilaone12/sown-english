<!-- Notyf JS -->
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
{{-- Swal Alert 2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('be/js/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('be/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('be/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('be/js/app.min.js') }}"></script>
<script src="{{ asset('be/js/main.js') }}"></script>
<script src="{{ asset('be/js/function.js') }}"></script>
@if (!request()->is('/'))
    <script src="{{ asset('be/js/apexcharts.min.js') }}"></script>
@endif
<script src="{{ asset('be/js/simplebar.js') }}"></script>
<script src="{{ asset('be/js/dashboard.js') }}"></script>
<script>
    let modalAllBox = $('#modal_all_box');;
    $('.btn-open-modal').click(function() {
        var href = $(this).attr('data-href');
        modalAllBox.load(href, '', function() {
            modalAllBox.modal().on("hidden.bs.modal", function() {
                $('#modal_all_box').children().remove();
            });
        });
        return false;
    });
    @if (session('error'))
        notyf.error({
            message: '{{ session('error') }}'
        })
    @elseif (session('success'))
        notyf.success({
            message: '{{ session('success') }}'
        })
    @endif
    //xoa the loai cau hoi
    $('.delete-type').on('click', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let url = "{{ route('type.delete') }}";
        let data = {
            id: id
        };
        swalInfo(`Vào thùng rác!`, `Bạn có muốn cho ${name} vào thùng rác không?`, () => {
            postAjax(url, data, (data) => {
                notyf.success({
                    message: data.message
                })
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }, (error) => {
                console.error(error);
            })
        })

    })
    //xoa cau hoi
    $('.delete-question').on('click', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let url = "{{ route('question.delete') }}";
        let data = {
            id: id
        };
        swalInfo(`Vào thùng rác!`, `Bạn có muốn cho câu hỏi: ${name} vào thùng rác không?`, () => {
            postAjax(url, data, (data) => {
                notyf.success({
                    message: data.message
                })
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }, (error) => {
                console.error(error);
            })
        })

    })
</script>
