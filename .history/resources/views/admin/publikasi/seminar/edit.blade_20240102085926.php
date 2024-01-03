@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                <form action="{{ route('admin.publikasi.seminar.edit', ['bku_id' => $smn->smn_id]) }}" method="post">
                        @csrf
                        @method('PUT')
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
                                    <label class="form-label">Nama Penulis</label>
                                    <input type="text" class="form-control" name="smn_namapenulis" value="{{ old('smn_namapenulis', $smn -> smn_namapenulis)}}" placeholder="Nama Penulis">
                                </div>
                                <br>
                                 <div class="col-12">
                                    <label class="form-label">Kategori</label>
                                    <select name="smn_kategori" class="form-control form-control-line">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Seminar Internasional" @if(old('smn_kategori') == 'Seminar Internasional') selected @endif>Seminar Internasional</option>
                                        <option value="Seminar Nasional" @if(old('smn_kategori') == 'Seminar Nasional') selected @endif>Seminar Nasional</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control" name="smn_penyelenggara" value="{{ old('smn_penyelenggara, $smn -> smn_namapenulis')}}" placeholder="Penyelenggara">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu</label>
                                    <input type="date" class="form-control" name="smn_waktu" value="{{ old('smn_waktu', $smn -> smn_waktu)}}" placeholder="Waktu">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tempat Pelaksanaan</label>
                                    <input type="text" class="form-control" name="smn_tempatpelaksaan" value="{{ old('smn_tempatpelaksaan', $smn -> smn_tempatpelaksaan)}}" placeholder="Tempat Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="smn_keterangan" value="{{ old('smn_keterangan', $smn -> smn_keterangan)}}" placeholder="Keterangan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr || $smn -> usr_id == $usr)>
                                                {{ $usr_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                </div>
                            </div>
                        </div>
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
</body>

@endsection
