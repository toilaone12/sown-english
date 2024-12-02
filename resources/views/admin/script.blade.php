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
    @if (session('error'))
        notyf.error({message: '{{session("error")}}'})
    @elseif (session('success'))
        notyf.success({message: '{{session("success")}}'})
    @endif
    //xoa the loai cau hoi
    $('.delete-type').on('click', function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        let url = "{{route('type.delete')}}";
        let data = {id: id};
        swalInfo(`Vào thùng rác!`, `Bạn có muốn cho ${name} vào thùng rác không?`, () => {
            postAjax(url, data, (data) => {
                notyf.success({message: data.message})
            },(error) => {
                console.error(error);
            })
        })
        
    })
    //chon the loai cau hoi
    $('.choose-answer').on('change', function(){
        let number = $(this).val();
        let html = frameAnswer(number);
        $('.list-answer').html(html);
        if(number != 0) $('.list-answer').parent().find('textarea').removeAttr('disabled').removeClass('pe-none')
        else $('.list-answer').parent().find('textarea').addClass('pe-none').attr('disabled','disabled')
    })
</script>
