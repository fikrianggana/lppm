@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                <form action="{{ route('admin.publikasi.hakpaten.edit', ['hpt_id' => $hpt->hpt_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Jurnal</h5>
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
                                    <input type="text" class="form-control" name="jrn_judulmakalah" value="{{ old('jrn_judulmakalah', $jrn -> jrn_judulmakalah)}}" placeholder="Judul Makalah">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Jurnal</label>
                                    <input type="text" class="form-control" name="jrn_namajurnal" value="{{ old('jrn_namajurnal', $jrn -> jrn_namajurnal)}}" placeholder="Nama Jurnal">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Personil</label>
                                    <input type="text" class="form-control" name="jrn_namapersonil" value="{{ old('jrn_namapersonil', $jrn -> jrn_namapersonil)}}" placeholder="Nama Personil">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">ISSN</label>
                                    <input type="number" class="form-control" name="jrn_issn" value="{{ old('jrn_issn', $jrn -> jrn_issn)}}" placeholder="ISSN">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Volume</label>
                                    <input type="text" class="form-control" name="jrn_volume" value="{{ old('jrn_volume', $jrn -> jrn_volume)}}" placeholder="Volume">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nomor</label>
                                    <input type="text" class="form-control" name="jrn_nomor" value="{{ old('jrn_nomor', $jrn -> jrn_nomor)}}" placeholder="Nomor">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Halaman Awal</label>
                                    <input type="number" class="form-control" name="jrn_halamanawal" value="{{ old('jrn_halamanawal', $jrn -> jrn_halamanawal)}}" placeholder="Halaman Awal">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Halaman Akhir</label>
                                    <input type="text" class="form-control" name="jrn_halamanakhir" value="{{ old('jrn_halamanakhir', $jrn -> jrn_halamanakhir)}}" placeholder="Halaman Akhir">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">URL</label>
                                    <input type="link" class="form-control" name="jrn_url" value="{{ old('jrn_url', $jrn -> jrn_url)}}" placeholder="URL">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Kategori</label>
                                    <select name="jrn_kategori" class="form-control form-control-line"  value="{{ old('jrn_kategori', $jrn -> jrn_kategori)}}">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Jurnal Nasional Tidak Terakreditasi" @if(old('jrn_kategori') == 'Jurnal Nasional Tidak Terakreditasi') selected @endif>Juara Nasional Tidak Terakreditasi</option>
                                        <option value="Jurnal Nasional Terakreditasi Sinta 2" @if(old('jrn_kategori') == 'Juara Nasional Terakreditasi Sinta 2') selected @endif>Juara Nasional Terakreditasi Sinta 2</option>
                                        <option value="Jurnal Nasional Terakreditasi Sinta 3" @if(old('jrn_kategori') == 'Juara Nasional Terakreditasi Sinta 3') selected @endif>Juara Nasional Terakreditasi Sinta 3</option>
                                        <option value="Jurnal Nasional Terakreditasi Sinta 4" @if(old('jrn_kategori') == 'Juara Nasional Terakreditasi Sinta 4') selected @endif>Juara Nasional Terakreditasi Sinta 4</option>
                                        <option value="Jurnal Nasional Terakreditasi Sinta 5" @if(old('jrn_kategori') == 'Juara Nasional Terakreditasi Sinta 5') selected @endif>Juara Nasional Terakreditasi Sinta 5</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr || $jrn -> usr_id == $usr)>
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
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

@endsection
