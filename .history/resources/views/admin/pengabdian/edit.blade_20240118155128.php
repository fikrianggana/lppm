@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin.pengabdian.update', ['pkm_id' => $pkm->pkm_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">Update Pengabdian</h5>
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
                                    <input type="text" class="form-control" name="pkm_namakegiatan" value="{{ old('pkm_namakegiatan', $pkm -> pkm_namakegiatan)}}" placeholder="Nama Kegiatan">
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
                                    <input type="date" class="form-control" name="pkm_waktupelaksanaan" value="{{ old('pkm_waktupelaksanaan', $pkm -> pkm_waktupelaksanaan)}}" placeholder="Waktu Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Personil Yang Terlibat</label>
                                    <input type="text" class="form-control" name="pkm_personilterlibat" value="{{ old('pkm_personilterlibat', $pkm -> pkm_personilterlibat)}}" placeholder="Personil Yang Terlibat">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jumlah Penerima Manfaat</label>
                                    <input type="number" class="form-control" name="pkm_jumlahpenerimamanfaat" value="{{ old('pkm_jumlahpenerimamanfaat', $pkm -> pkm_jumlahpenerimamanfaat)}}" placeholder="Jumlah Penerima Manfaat">
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
                                    <input type="text" class="form-control" name="pkm_mahasiswa" value="{{ old('pkm_mahasiswa', $pkm -> pkm_mahasiswa) }}" placeholder="Nama Mahasiswa">
                                    <button id="Mhs" type="button">Kirim</button>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">NIM Mahasiswa</label>
                                    <input type="number" class="form-control" name="pkm_nim" value="{{ old('pkm_nim', $pkm -> pkm_nim) }}" placeholder="NIM Mahasiswa">
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
                                <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a class="btn btn-secondary" href="{{ route ('admin.pengabdian.index') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

@endsection
