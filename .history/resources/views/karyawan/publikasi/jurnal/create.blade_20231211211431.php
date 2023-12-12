@extends('karyawan.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.publikasi.jurnal.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Hak Paten</h5>
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
                                    <label class="form-label">Judul Makalah</label>
                                    <input type="text" class="form-control" name="jrn_judulmakalah" value="{{ old('jrn_judulmakalah')}}" placeholder="Nama Lengkap">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Jurnal</label>
                                    <input type="text" class="form-control" name="jrn_namajurnal" value="{{ old('jrn_namajurnal')}}" placeholder="Judul">
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
                                    <label class="form-label">Nama Personil</label>
                                    <input type="text" class="form-control" name="jrn_namapersonil" value="{{ old('jrn_namapersonil')}}" placeholder="Nama Personil">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">ISSN</label>
                                    <input type="number" class="form-control" name="jrn_issn" value="{{ old('jrn_issn')}}" placeholder="ISSN">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tanggal Penerima</label>
                                    <input type="date" class="form-control" name="hpt_tglpenerimaan" value="{{ old('hpt_tglpenerimaan')}}" placeholder="Tanggal Penerima">
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
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control" name="hpt_status" value="{{ old('hpt_status')}}" placeholder="Status">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <input type="text" class="form-control" name="pgn_id" value="{{ old('pgn_id')}}" placeholder="Jumlah Penerima Manfaat">
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
