@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                <form action="{{ route('admin.publikasi.prosiding.edit', ['pro_id' => $pro->pro_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Prosiding</h5>
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
                                    <input type="text" class="form-control" name="pro_namapenulis" value="{{ old('pro_namapenulis', $pro -> pro_namapenulis)}}" placeholder="Nama Penulis">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Judul Program</label>
                                    <input type="text" class="form-control" name="pro_judulprogram" value="{{ old('pro_judulprogram', $pro -> pro_namapenulis)}}" placeholder="Judul Program">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Judul Paper</label>
                                    <input type="text" class="form-control" name="pro_judulpaper" value="{{ old('pro_judulpaper', $pro -> pro_namapenulis)}}" placeholder="Judul Paper">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Kategori</label>
                                    <select name="pro_kategori" class="form-control form-control-line">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Prosiding Nasional" @if(old('pro_kategori') == 'Prosiding Nasional') selected @endif>Prosiding Nasional</option>
                                        <option value="Prosiding Internasional" @if(old('pro_kategori') == 'Prosiding Internasional') selected @endif>Prosiding Internasional</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control" name="pro_penyelenggara" value="{{ old('pro_penyelenggara', $pro -> pro_namapenulis)}}" placeholder="Penyelenggara">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Terbit</label>
                                    <input type="date" class="form-control" name="pro_waktuterbit" value="{{ old('pro_waktuterbit', $pro -> pro_namapenulis)}}" placeholder="Waktu Terbit">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tempat Pelaksanaan</label>
                                    <input type="text" class="form-control" name="pro_tempatpelaksanaan" value="{{ old('pro_tempatpelaksanaan', $pro -> pro_namapenulis)}}" placeholder="Tempat Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="pro_keterangan" value="{{ old('pro_keterangan', $pro -> pro_namapenulis)}}" placeholder="Keterangan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr || $pro -> usr_id == $usr)>
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
