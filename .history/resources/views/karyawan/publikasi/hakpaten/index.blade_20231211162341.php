@extends('karyawan.layouts.layout')

<body>
    @section('konten')
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-title">
                            <h5> List Hak Paten</h5>
                        </div>
                        <br>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }} </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }} </div>
                        @endif

                        <p>
                            <a class="btn btn-primary" href="">+ Tambah Hak Paten</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Judul</th>
                                    <th>No Pemohonan</th>
                                    <th>Tanggal Pelaksanaan</th>
                                    <th>Tanggal Penerimaan</th>
                                    <th>Nomor</th>
                                    <th>Halaman Awal</th>
                                    <th>Halaman Akhir</th>
                                    <th>URL</th>
                                    <th>Kategori</th>
                                    <th>Pengguna</th>
                                    <th>Atribut</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($jurnal as $jrn)
                                    <tr>
                                        <td>{{ $jrn->jrn_judulmakalah }}</td>
                                        <td>{{ $jrn->jrn_namajurnal }}</td>
                                        <td>{{ $jrn->jrn_namapersonil }}</td>
                                        <td>{{ $jrn->jrn_issn }}</td>
                                        <td>{{ $jrn->jrn_volume }}</td>
                                        <td>{{ $jrn->jrn_nomor }}</td>
                                        <td>{{ $jrn->jrn_halamanawal }}</td>
                                        <td>{{ $jrn->jrn_halamanakhir }}</td>
                                        <td>{{ $jrn->jrn_url }}</td>
                                        <td>{{ $jrn->jrn_kategori }}</td>
                                        <td>{{ $jrn->pgn_id }}</td>
                                        <td>{{ $jrn->jrn_atribut }}</td>

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
