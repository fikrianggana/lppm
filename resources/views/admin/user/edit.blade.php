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
                                    <div class="alert alert-success">{{ session('success')}} </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error')}} </div>
                                @endif


                                <div class="col-12">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="usr_nama" value="{{ old('usr_nama',  $usr -> usr_nama)}}" placeholder="Nama">
                                </div>

                                <br>
                                <div class="col-12">
                                    <label class="form-label">Prodi</label>
                                    <select name="prodi_id" class="form-control">
                                        <option value="">Pilih Prodi</option>
                                        @foreach ($prodis as $prd => $prd_nama)
                                            <option value="{{ $prd }}" @selected(old('prodi_id') == $usr)>
                                                {{ $prd_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="{{ old('username', $usr->username)}}" placeholder="Username">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" value="{{ old('password',  $usr -> password)}}" placeholder="Password">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Role</label>
                                    <select name="usr_role" class="form-control form-control-line">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="admin" @if(old('usr_role') == 'admin') selected @endif>Admin</option>
                                        <option value="karyawan" @if(old('usr_role') == 'karyawan') selected @endif>Karyawan</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="usr_email" value="{{ old('usr_email',  $usr -> usr_email)}}" placeholder="Email">
                                </div>
                                <br>

                                <div class="col-12">
                                    <label class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" name="usr_notelpon" value="{{ old('usr_notelpon',  $usr -> usr_notelpon)}}" placeholder="Penerbit">
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
