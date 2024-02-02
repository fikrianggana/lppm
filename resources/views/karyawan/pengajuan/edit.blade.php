@extends('karyawan.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                <form action="{{ route('karyawan.pengajuan.update', ['pst_id' => $pst->pst_id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">Edit Pengajuan Surat Tugas</h5>
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
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}',
                                    });
                                    </script>
                                @endif
                                        
                                @if (session('error'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: '{{ session('error') }}',
                                        });
                                    </script>
                                @endif

                                <div class="col-12">
                                    <!-- MENGAMBL NAMA USER BERDASARKAN YANG LOGIN -->
                                    <input type="hidden" name="usr_id" value="{{ Auth::user()->usr_id }}">
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Nama Surat Tugas</label>
                                    <input type="text" class="form-control" name="pst_namasurattugas" value="{{ old('pst_namasurattugas',  $pst -> pst_namasurattugas)}}" placeholder="Nama Surat Tugas">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="date" class="form-control" name="pst_masapelaksanaan" value="{{ old('pst_masapelaksanaan',  $pst -> pst_masapelaksanaan)}}" placeholder="Masa Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="file" class="form-control" name="pst_buktipendukung" value="{{ old('pst_buktipendukung',  $pst -> pst_buktipendukung)}}">
                                </div>
                                <br>
                            </div>
                        </div>
                        </br>
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
