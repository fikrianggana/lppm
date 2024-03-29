@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin.user.update', ['usr_id' => $usr->usr_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">Update User</h5>
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
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="usr_nama" value="{{ old('usr_nama',  $usr -> usr_nama)}}" placeholder="Judul">
                                </div>

                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Penulis</label>
                                    <input type="text" class="form-control" name="bku_penulis" value="{{ old('bku_penulis',  $bk -> bku_penulis)}}" placeholder="Nama Penulis">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Nama Editor</label>
                                    <input type="text" class="form-control" name="bku_editor" value="{{ old('bku_editor',  $bk -> bku_editor)}}" placeholder="Nama Editor">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" class="form-control" name="bku_isbn" value="{{ old('bku_isbn',  $bk -> bku_isbn)}}" placeholder="ISBN">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Tahun</label>
                                    <input type="number" class="form-control" name="bku_tahun" value="{{ old('bku_tahun',  $bk -> bku_tahun)}}" placeholder="Tahun">
                                </div>
                                <br>

                                <div class="col-12">
                                    <label class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="bku_penerbit" value="{{ old('bku_penerbit',  $bk -> bku_penerbit)}}" placeholder="Penerbit">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Pengguna --</opton>
                                        @foreach ($users as $usr => $usr_nama)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr || $bk -> usr_id == $usr)>
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
