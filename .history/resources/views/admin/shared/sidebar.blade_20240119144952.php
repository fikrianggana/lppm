<div class="polman-nav-static-top">
    <div class="float-left">
        <a href="">
            <img src="{{asset('assets/Images/IMG_Logo.png') }}" style="height: 50px;" />
        </a>
    </div>

    <div class="polman-menu">
        <div style="padding-top: 15px; margin-right: -30px;">
            @auth
                Hai, <b>{{ Auth::user()->usr_nama }}</b>
            @else
                Selamat datang, silakan login.
            @endauth
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

            <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" style="border-radius: 0px; border: none; padding-left: 23px;">
                <i class="fa fa-sign-out fa-lg fa-pull-left"></i>Logout
            </a>
            <a href='{{ route ('admin.dashboard.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class='fa fa-home fa-lg fa-pull-left'></i>Dashboard
            </a>
            <a href='{{ route ('admin.pengabdian.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class="fa fa-user fa-lg fa-pull-left fa-solid fa-people-roof"></i>Pengabdian Masyakarat
            </a>
            <a href='{{ route ('admin.pengajuan.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
                <i class="fa fa-envelope fa-pull-left"></i>Pengajuan Surat Tugas
            </a>

            <a href= class='list-group-item list-group-item-action'
			    style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'>
			    <i class="fa fa-lg fa-bullhorn fa-pull-left"></i>Pengaduan
		    </a>

            <a href='' class='list-group-item list-group-item-action'
            style='border-radius: 0px; border: none; padding-left: 22px; display: inherit;'
            data-toggle="collapse" data-target="#submenuPublikasi" id="publikasiToggle">
            <i class="fa fa-chevron-right fa-sm fa-pull-left"></i> Publikasi
            </a>

            <script>
            document.getElementById('publikasiToggle').addEventListener('click', function() {
                var icon = document.querySelector('#publikasiToggle i');
                if (icon.classList.contains('fa-chevron-right')) {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-down');
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-right');
                }
            });
            </script>


            <!-- Submenu items for Publikasi -->
            <div class="collapse submenu" id="submenuPublikasi">
            <a href='{{ route ('admin.publikasi.buku.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fa fa-book fa-pull-left"></i> Buku
            </a>
            <a href='{{ route ('admin.publikasi.jurnal.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fa fa-file fa-pull-left"></i> Jurnal
            </a>
            <a href='{{ route ('admin.publikasi.seminar.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https:fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M96 32C60.7 32 32 60.7 32 96V384H96V96l384 0V384h64V96c0-35.3-28.7-64-64-64H96zM224 384v32H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H544c17.7 0 32-14.3 32-32s-14.3-32-32-32H416V384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32z"/></svg> Seminar
            </a>
            <a href='{{ route ('admin.publikasi.hakcipta.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fa fa-solid fa-copyright fa-pull-left"></i> Hak Cipta
            </a>
            <a href='{{ route ('admin.publikasi.hakpaten.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <i class="fa fa-solid fa-registered fa-pull-left"></i> Hak Paten
            </a>
            <a href='{{ route ('admin.publikasi.prosiding.index') }}' class='list-group-item list-group-item-action'
                style='border-radius: 0px; border: none; padding-left: 40px; display: inherit;'>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https:fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg> Prosiding
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

