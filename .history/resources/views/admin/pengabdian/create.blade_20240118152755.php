@extends('admin.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('admin.pengabdian.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Pengabdian</h5>
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
                                    <label class="form-label">Nama Kegiatan</label>
                                    <input type="text" class="form-control" name="pkm_namakegiatan" value="{{ old('pkm_namakegiatan')}}" placeholder="Nama Kegiatan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jenis Pengabdian</label>
                                    <!-- <input type="text" class="form-control" name="pkm_jenis" value="{{ old('pkm_jenis')}}" placeholder="Jenis Pengabdian"> -->
                                    <select name="pkm_jenis" class="form-control form-control-line" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="UMKM" @if(old('pkm_jenis') == 'UMKM') selected @endif>UMKM </option>
                                        <option value="SMK" @if(old('pkm_jenis') == 'SMK') selected @endif>SMK </option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="date" class="form-control" name="pkm_waktupelaksanaan" value="{{ old('pkm_waktupelaksanaan')}}" placeholder="Waktu Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Personil Yang Terlibat</label>
                                    <input type="text" class="form-control" name="pkm_personilterlibat" value="{{ old('pkm_personilterlibat')}}" placeholder="Personil Yang Terlibat">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jumlah Penerima Manfaat</label>
                                    <input type="number" class="form-control" name="pkm_jumlahpenerimamanfaat" value="{{ old('pkm_jumlahpenerimamanfaat')}}" placeholder="Jumlah Penerima Manfaat">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="file" class="form-control" name="pkm_buktipendukung" value="{{ old('pkm_buktipendukung')}}">

                                    <!-- @error('pkm_buktipendukung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                    @enderror -->
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="pkm_mahasiswa" value="{{ old('pkm_mahasiswa') }}" placeholder="Nama Mahasiswa">
                                    <button id="Mhs" type="button">Kirim</button>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">NIM Mahasiswa</label>
                                    <input type="number" class="form-control" name="pkm_nim" value="{{ old('pkm_nim') }}" placeholder="NIM Mahasiswa">
                                    <button id="nm" type="button">Kirim</button>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Prodi</label>
                                    <select name="prodi_id" class="form-control">
                                        @foreach ($prodis as $prd => $prd_nama)
                                            <option value="{{ $prd }}" {{ old('prd_id') == $prd ? 'selected' : '' }}>
                                                {{ $prd_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label for="Detail" class="control-label">Detail</label>
                                    <textarea id="Detail" name="Detail" class="form-control">{{ old('Detail') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <!-- Span for validation error -->
                                    <input name="MahasiswaProdiNim" id="MahasiswaProdiNim" class="form-control" type="hidden" :value="old('MahasiswaProdiNim')" />
                                    <span id="MahasiswaProdiNimError" class="text-danger">@error('MahasiswaProdiNim') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <br>
                            </div>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary" href="{{ route('admin.pengabdian.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengabdian Masyakarat</a><a class="btn btn-primary" href="{{ route('admin.pengabdian.index')}}"><i class="fa fa-backward" aria-hidden="true"></i> Back </a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

<script>
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
</script>

@endsection
