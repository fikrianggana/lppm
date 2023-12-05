<div class="polman-nav-static-top">
    <div class="float-left">
        <a href="">
            <img src="{{asset('assets/Images/IMG_1687.png') }}" style="height: 50px;" />
        </a>
    </div>


    <div class="polman-menu">
    <div style="padding-top: 15px; margin-right: -30px;">
        <?php if (('username')) : ?>
            Hai,&nbsp;<b><?php echo ('username'); ?></b>
        <?php else : ?>
            Selamat datang, silakan login.
        <?php endif; ?>
    </div>
    </div>

    <div class="polman-menu-bar">
        <div class="float-right">
            <div class="fa fa-bars fa-2x" style="margin-top: 9px; cursor: pointer;" aria-hidden="true" data-toggle="collapse" data-target="#menu" aria-expanded="false" aria-controls="menu"></div>
        </div>
    </div>
</div>

<div class="polman-nav-static-right collapse scrollstyle" id="menu">
    <div id="accordions" role="tablist" aria-multiselectable="true">
        <div class="list-group">
            <!-- <a class="list-group-item list-group-item-action polman-username" style="border-radius: 0px; border: none; background-color: #EEE;">
                Hai,&nbsp;<b></b>
            </a> -->

            <a href="" class="list-group-item list-group-item-action" style="border-radius: 0px; border: none; padding-left: 23px;">
                <i class="fa fa-sign-out fa-lg fa-pull-left"></i>Logout
            </a>

            <a href='{{ route ('karyawan.dashboard.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class='fa fa-home fa-lg fa-pull-left'></i>Dashboard
            </a>

            <a href='{{ route ('karyawan.pengabdian.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class="fa fa-user fa-lg fa-pull-left fa-solid fa-people-roof"></i>Pengabdian Masyakarat
            </a>

            <a href='{{ route ('karyawan.pengajuan.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class="fa fa-envelope fa-pull-left"></i>Pengajuan Surat Tugas
            </a>

            <a href='{{ route ('karyawan.publikasi.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;' data-toggle="collapse" data-target="#submenuPublikasi">
                <i class="fas fa-folder-open"></i> Publikasi
            </a>

            <!-- Submenu items for Publikasi -->
            <div class="collapse submenu" id="submenuPublikasi">
            <a href='{{ route ('karyawan.publikasi.buku.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fas fa-book"></i> Buku
            </a>
            <a href='{{ route ('karyawan.publikasi.jurnal.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="far fa-file-alt"></i> Jurnal
            </a>
            <a href='{{ route ('karyawan.publikasi.seminar.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fas fa-microphone-alt"></i> Seminar
            </a>
            <a href='{{ route ('karyawan.publikasi.hakcipta.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="far fa-registered"></i> Hak Cipta
            </a>
            <a href='{{ route ('karyawan.publikasi.hakpaten.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fas fa-clipboard-check"></i> Hak Paten
            </a>
            <a href='{{ route ('karyawan.publikasi.prosiding.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fas fa-scroll"></i> Prosiding
            </a>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript/jQuery to toggle visibility -->
<script>
    $(document).ready(function () {
        $('#publikasi-link').click(function () {
            $('#publikasi-submenu').toggle();
        });
    });
</script>
