@extends('karyawan.layouts.layout')

@section('konten')

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="{{ route('karyawan.pengaduan.update', ['pengaduan' => $pengaduan->pdn_id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-header">Edit Pengaduan</h5>
                            <br>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-title">
                                        <h4>Whoops!</h4>
                                        There are some problems with your input.
                                    </div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="col-12">
                                <label class="form-label">Tipe Pengaduan</label>
                                <input type="hidden" id="iduser" name="usr_id" value="{{ Auth::user()->usr_id }}">
                                <select name="pdn_tipe" class="form-control form-control-line" id="tipePengaduan" required>
                                    <option value="Ubah" @if($pengaduan->pdn_tipe == 'Ubah') selected @endif>Ubah</option>
                                    <option value="Hapus" @if($pengaduan->pdn_tipe == 'Hapus') selected @endif>Hapus</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <label class="form-label">Jenis Pengaduan</label>
                                <select name="pdn_jenis" class="form-control form-control-line" id="jenisPengaduan" required>
                                    <!-- Pilihan jenis pengaduan disesuaikan dengan data yang ada -->
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <label class="form-label">Data</label>
                                <select id="databre" class="form-control form-control-line" required>
                                    <!-- Options akan diisi oleh JavaScript berdasarkan jenis pengaduan -->
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan', $pdn->keterangan) }}">
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@endsection
