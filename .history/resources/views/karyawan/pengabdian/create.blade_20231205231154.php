@extends('karyawan.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('pengabdian.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Product</h5>
                                <hr />
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
                                    <input type="text" class="form-control" name="pkm_namakegiatan" value="{{ old('pkm_namakegiatan')}}" placeholder="#SKU">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jenis Pengabdian</label>
                                    <input type="text" class="form-control" name="pkm_jenis" value="{{ old('pkm_jenis')}}" placeholder="Name">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="text" class="form-control" name="pkm_waktupelaksanaan" value="{{ old('pkm_waktupelaksanaan')}}" placeholder="Name">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Orang Yang Terlibat</label>
                                    <input type="text" class="form-control" name="pkm_personilterlibat" value="{{ old('pkm_personilterlibat')}}" placeholder="Price">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jumlah Penerima Manfaat</label>
                                    <input type="number" class="form-control" name="pkm_jumlahpenerimamanfaat" value="{{ old('pkm_jumlahpenerimamanfaat')}}" placeholder="Stock">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="number" class="form-control" name="pkm_buktipendukung" value="{{ old('pkm_buktipendukung')}}" placeholder="Stock">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
