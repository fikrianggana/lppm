@extends('karyawan.layouts.layout')

<body>
    @section('konten')
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-title">
                            <h5> List Jurnal</h5>
                        </div>
                        <br>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }} </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }} </div>
                        @endif

                        <p>
                            <a class="btn btn-primary" href="{{ route('karyawan.publikasi.jurnal.create') }}">+ Tambah Jurnal</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover table-bordered table-condensed table-striped grid">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Jurnal</th>
                                    <th class="text-center">Judul Makalah</th>
                                    <th class="text-center">Nama Jurnal</th>
                                    <th class="text-center">Nama Personil</th>
                                    <th class="text-center">ISSN</th>
                                    <th class="text-center">Volume</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Halaman Awal</th>
                                    <th class="text-center">Halaman Akhir</th>
                                    <th class="text-center">URL</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Pengguna</th>
                                    <th class="text-center">Atribut</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($jurnal as $jrn)
                                    <tr>
                                        <td>{{ $jrn->jrn_id }}</td>
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
