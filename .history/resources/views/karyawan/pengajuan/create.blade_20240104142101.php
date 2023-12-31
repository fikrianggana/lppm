@extends('admin.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.pengajuan.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Pengajuan</h5>
                                <br>

                                @if ($errors -> any())
                                    <div class="alert alert-danger">
                                        <div class="alert-title"><h4>Whooppss</h4>
                                        There are some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li> {{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success')}} </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error')}} </div>
                                @endif

                                <div class="col-12">
                                    <label class="form-label">Nama Pengaju</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Nama Pengaju --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $pst_namapengaju }}" @selected(old('usr_id') == $pst_namapengaju)>
                                                {{ $usr_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Surat Tugas</label>
                                    <input type="text" class="form-control" name="pst_namasurattugas" value="{{ old('pst_namasurattugas')}}" placeholder="Nama Surat Tugas">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="date" class="form-control" name="pst_masapelaksanaan" value="{{ old('pst_masapelaksanaan')}}" placeholder="Masa Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="file" class="form-control" name="pst_buktipendukung" value="{{ old('pst_buktipendukung')}}">

                                    <!-- @error('pst_buktipendukung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                    @enderror -->
                                </div>
                                {{--  <br>
                                <div class="col-12">
                                    <label for="Detail" class="control-label">Detail</label>
                                    <textarea id="Detail" name="Detail" class="form-control">{{ old('Detail') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <!-- Span for validation error -->
                                    <input name="MahasiswaProdiNim" id="MahasiswaProdiNim" class="form-control" type="hidden" :value="old('MahasiswaProdiNim')" />
                                    <span id="MahasiswaProdiNimError" class="text-danger">@error('MahasiswaProdiNim') {{ $message }} @enderror</span>
                                </div>  --}}
                            </div>
                            <br>
                            </div>
                        </div>
                        <div class="col-12">
                        {{--  <button href="{{ route('karyawan.pengabdian.index') }}" type="cancel" class="btn btn-secondary">Batal</button>  --}}
                        <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

{{--  <script>
    // Handling form submission
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();

        var mahasiswaValue = document.querySelector('input[name="pkm_mahasiswa"]').value;
        var nimValue = document.querySelector('input[name="pkm_nim"]').value;
        var prodiValue = document.querySelector('[name="prodi_id"]').value;
        var detail = document.getElementById('Detail').value;

        var mahasiswaProdiNimValue = detail;

        document.getElementById('MahasiswaProdiNim').value = mahasiswaProdiNimValue;

        this.submit();
    });

    // Handling Mahasiswa button click
    document.getElementById('Mhs').addEventListener('click', function (e) {
        e.preventDefault();

        var mahasiswaValue = document.querySelector('input[name="pkm_mahasiswa"]').value;
        var currentDetailValue = document.getElementById('Detail').value;

        var separator = currentDetailValue ? '|' : '';
        var newDetailValue = mahasiswaValue + separator + (currentDetailValue ? currentDetailValue : '');

        document.getElementById('Detail').value = newDetailValue;
    });

    // Handling Nim button click
    document.getElementById('nm').addEventListener('click', function (e) {
        e.preventDefault();

        var nimValue = document.querySelector('input[name="pkm_nim"]').value;
        var currentDetailValue = document.getElementById('Detail').value;

        var separator = currentDetailValue ? '|' : '';
        var newDetailValue = nimValue + separator + (currentDetailValue ? currentDetailValue : '');

        document.getElementById('Detail').value = newDetailValue;
    });

    // Handling Prodi dropdown change
    document.querySelector('[name="prodi_id"]').addEventListener('change', function (e) {
        var prodiValue = this.options[this.selectedIndex].text;
        var currentDetailValue = document.getElementById('Detail').value;

        var separator = currentDetailValue ? '|' : '';
        var newDetailValue = prodiValue + separator + (currentDetailValue ? currentDetailValue : '');

        document.getElementById('Detail').value = newDetailValue;
    });
</script>  --}}

@endsection
