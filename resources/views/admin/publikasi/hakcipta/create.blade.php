@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('admin.publikasi.hakcipta.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Hak Cipta</h5>
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
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="hcp_namalengkap" value="{{ old('hcp_namalengkap')}}" placeholder="Nama Lengkap">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="hcp_judul" value="{{ old('hcp_judul')}}" placeholder="Judul">
                                </div>
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
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <option value="">-- Pengguna --</option>
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
