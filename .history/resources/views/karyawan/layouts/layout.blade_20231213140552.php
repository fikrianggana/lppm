@include('karyawan.shared.header')
@include('karyawan.shared.sidebar')
<div class="polman-adjust5">
    <ol class="breadcrumb polman-breadcrumb">
        <li class="breadcrumb-item"><a href="https://sia.polman.astra.ac.id/sso" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Menuju Hal SSO">LPPM</a></li>
        <li class="breadcrumb-item"></li>
    </ol>

    <hr />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"></script>
    @yield('konten')

</div>
