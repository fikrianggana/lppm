@extends('karyawan.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.publikasi.seminar.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Seminar</h5>
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
                                    <label class="form-label">Nama Penulis</label>
                                    <input type="text" class="form-control" name="smn_namapenulis" value="{{ old('smn_namapenulis')}}" placeholder="Nama Penulis">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Kategori</label>
                                    <input type="text" class="form-control" name="smn_kategori" value="{{ old('smn_kategori')}}" placeholder="Kategori">
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
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control" name="smn_penyelenggara" value="{{ old('smn_penyelenggara')}}" placeholder="Penyelenggara">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu</label>
                                    <input type="time" class="form-control" name="smn_waktu" value="{{ old('smn_waktu')}}" placeholder="Waktu">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tempat Pelaksanaan</label>
                                    <input type="text" class="form-control" name="smn_tempatpelaksaan" value="{{ old('smn_tempatpelaksaan')}}" placeholder="Tempat Pelaksanaan">
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
                                    <select name="pgn_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($penggunas as $pgn => $pgn_nama)
                                            <option value="{{ $pgn }}" @selected(old('pgn_id') == $pgn)>
                                                {{ $pgn_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Atribut</label>
                                    <input type="text" class="form-control" name="smn_atribut" value="{{ old('smn_atribut')}}" placeholder="Atribut">
                                </div>
                            </div>
                            <br>
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
