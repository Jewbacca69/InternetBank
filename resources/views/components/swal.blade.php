<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error')}}',
            icon: 'error',
            timer: 3000,
            timerProgressBar: true
        });
        @endif
    });

    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success')}}',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true
        });
        @endif
    });

    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
        let errorMessage = '';
        @foreach ($errors->all() as $error)
            errorMessage += '{{ $error }}<br>';
        @endforeach

        Swal.fire({
            title: 'Validation Error',
            html: errorMessage,
            icon: 'error',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        @endif
    });
</script>
