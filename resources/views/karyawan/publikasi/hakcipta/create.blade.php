@extends('karyawan.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.publikasi.hakcipta.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Hak Cipta</h5>
                                <br>

                                @if ($errors -> any())
                                    <div class="alert alert-danger">
                                        <div class="alert-title"><h4>Terjadi Kesalahan</h4>
                                        Data yang di inputkan tidak valid.
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
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="hcp_namalengkap" value="{{ old('hcp_namalengkap')}}" placeholder="Nama Lengkap">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="hcp_judul" value="{{ old('hcp_judul')}}" placeholder="Judul">
                                </div>
                                {{--  <div class="col-12">
                                    <label class="form-label">Jenis Pengabdian</label>
                                    <!-- <input type="text" class="form-control" name="pkm_jenis" value="{{ old('pkm_jenis')}}" placeholder="Jenis Pengabdian"> -->
                                    <select name="pkm_jenis" class="form-control form-control-line" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="UMKM" @if(old('pkm_jenis') == 'UMKM') selected @endif>UMKM </option>
                                        <option value="SMK" @if(old('pkm_jenis') == 'SMK') selected @endif>SMK </option>
                                    </select>
                                </div>  --}}
                                <br>
                                <div class="col-12">
                                    <label class="form-label">No Aplikasi</label>
                                    <input type="text" class="form-control" name="hcp_noapk" value="{{ old('hcp_noapk')}}" placeholder="No Aplikasi">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">No Sertifikat</label>
                                    <input type="number" class="form-control" name="hcp_sertifikat" value="{{ old('hcp_sertifikat')}}" placeholder="No Sertifikat">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="hcp_keterangan" value="{{ old('hcp_keterangan')}}" placeholder="Keterangan">
                                </div>
                                <br>
                                {{--  <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="text" class="form-control" name="pkm_buktipendukung" value="{{ old('pkm_buktipendukung')}}">

                                    <!-- @error('pkm_buktipendukung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                    @enderror -->
                                </div>  --}}
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr)>
                                                {{ $usr_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                        <!-- <button type="cancel" class="btn btn-secondary">Batal</button> -->
                        <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

@endsection
