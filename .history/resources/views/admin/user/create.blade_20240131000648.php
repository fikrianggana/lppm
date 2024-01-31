@extends('admin.layouts.layout')
<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('admin.user.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New User</h5>
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
                                    <input type="text" class="form-control" name="usr_nama" value="{{ old('usr_nama')}}" placeholder="Nama">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Prodi</label>
                                    <select name="usr_id" class="form-control" >
                                        <opton value="">-- Prodi --</opton>
                                        @foreach ($users as $usr => $prodi_id)
                                            <option value="{{ $usr }}" @selected(old('usr_id') == $usr)>
                                                {{ $usr_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Username</label>
                                    <input type="date" class="form-control" name="username" value="{{ old('username')}}" placeholder="Username">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Role</label>
                                    <select name="usr_role" class="form-control form-control-line">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Admin" @if(old('usr_role') == 'Admin') selected @endif>Admin</option>
                                        <option value="Karyawan" @if(old('usr_role') == 'Karyawan') selected @endif>Karyawan</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="usr_email" value="{{ old('usr_email')}}" placeholder="Email">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" name="usr_notelpon" value="{{ old('usr_notelpon')}}" placeholder="No Telp">
                                </div>
                                <br>
                            </div>
                            <br>
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
