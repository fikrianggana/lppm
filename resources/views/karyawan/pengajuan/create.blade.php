@extends('admin.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.pengajuan.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Pengajuan</h5>
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
                                    <!-- MENGAMBL NAMA USER BERDASARKAN YANG LOGIN -->
                                    <input type="hidden" name="usr_id" value="{{ Auth::user()->usr_id }}">
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Nama Surat Tugas</label>
                                    <input type="text" class="form-control" name="pst_namasurattugas" value="{{ old('pst_namasurattugas')}}" placeholder="Nama Surat Tugas">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="date" class="form-control" name="pst_masapelaksanaan" value="{{ old('pst_masapelaksanaan')}}" placeholder="Masa Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="file" class="form-control" name="pst_buktipendukung" value="{{ old('pst_buktipendukung')}}">
                                </div>
                               
                            </div>
                            <br>
                            </div>
                        </div>
                        <div class="col-12">
                        {{--  <button href="{{ route('karyawan.pengabdian.index') }}" type="cancel" class="btn btn-secondary">Batal</button>  --}}
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
