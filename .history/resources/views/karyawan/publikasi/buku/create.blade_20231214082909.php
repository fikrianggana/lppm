@extends('karyawan.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.publikasi.buku.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Buku</h5>
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
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="bku_judul" value="{{ old('bku_judul')}}" placeholder="Judul">
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
                                    <label class="form-label">Nama Penulis</label>
                                    <input type="text" class="form-control" name="bku_penulis" value="{{ old('bku_penulis')}}" placeholder="Nama Penulis">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Editor</label>
                                    <input type="text" class="form-control" name="bku_editor" value="{{ old('bku_editor')}}" placeholder="Nama Editor">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" class="form-control" name="bku_isbn" value="{{ old('bku_isbn')}}" placeholder="ISBN">
                                </div>
                                <br>


ng" value="{{ old('pkm_buktipendukung')}}">







                                <div class="col-12">
                                    <label class="form-label">Tahun</label>
                                    <input type="number" class="form-control" name="bku_tahun" value="{{ old('bku_tahun')}}" placeholder="Tahun">
                                </div>
                                <br>

                                <div class="col-12">
                                    <label class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="bku_penerbit" value="{{ old('bku_penerbit')}}" placeholder="Penerbit">
                                </div>
                                <br>
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
