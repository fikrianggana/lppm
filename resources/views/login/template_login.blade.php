<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@isset($title){{ $title . ' - ' . config('app.title') }}@else{{ config('app.title') }}@endisset</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">
    <link href="{{ asset('assets/Plugins/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Content/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Content/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Styles/Style.css') }}" rel="stylesheet">
    <!-- Include your other CSS files -->

    <style type="text/css">
        .btn:hover {
            cursor: pointer;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('assets/Images/IMG_Background.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="polman-nav-static-top" style="opacity: 0.9;">
        <div class="float-left">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/Images/IMG_Logo.png') }}" style="height: 50px;" />
            </a>
        </div>
    </div>

    @yield('content')

    <div class="mb-5"></div>

    <div class="mt-5" style="background-color: white; width: 100%; position: fixed; left: 0; bottom: 0;">
        <div class="container-fluid">
            <footer class="d-flex flex-wrap pt-3 pb-3 border-top">
                Copyright &copy; {{ date('Y') }} - KELOMPOK 4
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/Scripts/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/Plugins/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/highcharts.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/highcharts-more.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/modules/solid-gauge.js') }}"></script>
    <script src="{{ asset('assets/Scripts/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/Scripts/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ asset('assets/Scripts/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/Scripts/LetterAvatar.js') }}"></script>
    <!-- Include your other JS files -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        const base_url = '{{ url('/') }}';
    </script>

    @if(session('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    icon: 'success'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                    icon: 'error'
                });
            });
        </script>
    @endif

    @if(session('warning'))
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    title: 'Peringatan',
                    text: '{{ session('warning') }}',
                    showConfirmButton: true,
                    icon: 'warning'
                });
            });
        </script>
    @endif

    @if(session('info'))
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    title: 'Informasi',
                    text: '{{ session('info') }}',
                    showConfirmButton: true,
                    icon: 'info'
                });
            });
        </script>
    @endif

    @yield('scripts')

</body>
</html>
