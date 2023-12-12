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
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Penulis</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Penyelenggara</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Tempat Pelaksanaan</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Pengguna</th>
                                    <th class="text-center">Atribut</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($seminar as $index => $smn)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $smn->smn_namapenulis }}</td>
                                        <td class="text-center">{{ $smn->smn_kategori }}</td>
                                        <td class="text-center">{{ $smn->smn_penyelenggara }}</td>
                                        <td class="text-center">{{ $smn->smn_waktu }}</td>
                                        <td class="text-center">{{ $smn->smn_tempatpelaksaan }}</td>
                                        <td class="text-center">{{ $smn->smn_keterangan }}</td>
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
