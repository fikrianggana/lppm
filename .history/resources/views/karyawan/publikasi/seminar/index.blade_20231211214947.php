@extends('karyawan.layouts.layout')

<body>
    @section('konten')
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-title">
                            <h5> List Seminar</h5>
                        </div>
                        <br>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }} </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }} </div>
                        @endif

                        <p>
                            <a class="btn btn-primary" href="{{ route('karyawan.publikasi.seminar.create') }}">+ Tambah Seminar</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Penulis</th>
                                    <th>Kategori</th>
                                    <th>Penyelenggara</th>
                                    <th>Waktu</th>
                                    <th>Tempat Pelaksanaan</th>
                                    <th>Keterangan</th>
                                    <th>Pengguna</th>
                                    <th>Atribut</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($seminar as $smn)
                                    <tr>
                                        <td>{{ $smn->smn_namapenulis }}</td>
                                        <td>{{ $smn->smn_kategori }}</td>
                                        <td>{{ $smn->smn_penyelenggara }}</td>
                                        <td>{{ $smn->smn_waktu }}</td>
                                        <td>{{ $smn->smn_tempatpelaksaan }}</td>
                                        <td>{{ $smn->smn_keterangan }}</td>
                                        <td>{{ $smn->pgn_id }}</td>
                                        <td>{{ $smn->smn_atribut }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            No Record found!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                </div>
            </section>
        </main><!-- End #main -->


    </body>

    </html>
@endsection
