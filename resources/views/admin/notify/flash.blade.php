@if (session()->has('flash_message'))
    <script type="text/javascript">
        $(function(){
            swal({
                title: "{{ session('flash_message.title') }}",
                text: "{{ session('flash_message.message') }}",
                type: "{{ session('flash_message.level') }}",
                timer: 60,
                showConfirmButton: false,
                allowEscapeKey: true,
                allowOutsideClick: true
            },
            function() {
                location.reload(true);
            });
        });
    </script>
@endif
