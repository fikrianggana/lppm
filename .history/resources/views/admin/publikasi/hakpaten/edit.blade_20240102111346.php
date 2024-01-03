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
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="hpt_namalengkap" value="{{ old('hpt_namalengkap', $hpt -> hpt_namalengkap)}}" placeholder="Nama Lengkap">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="hpt_judul" value="{{ old('hpt_judul', $hpt -> hpt_judul)}}" placeholder="Judul">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">No Pemohonan</label>
                                    <input type="text" class="form-control" name="hpt_nopemohonan" value="{{ old('hpt_nopemohonan', $hpt -> hpt_nopemohonan)}}" placeholder="No Pemohonan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tanggal Penerima</label>
                                    <input type="date" class="form-control" name="hpt_tglpenerimaan" value="{{ old('hpt_tglpenerimaan', $hpt -> hpt_tglpenerimaan)}}" placeholder="Tanggal Penerima">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control" name="hpt_status" value="{{ old('hpt_status', $hpt -> hpt_status)}}" placeholder="Status">
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
