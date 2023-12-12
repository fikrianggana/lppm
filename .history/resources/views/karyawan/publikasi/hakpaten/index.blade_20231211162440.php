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
                                    <th>Status</th>
                                    <th>Pengguna</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($hakpaten as $hpt)
                                    <tr>
                                        <td>{{ $hpt->hpt_namalengkap }}</td>
                                        <td>{{ $hpt->hpt_judul }}</td>
                                        <td>{{ $hpt->hpt_nopemohonan }}</td>
                                        <td>{{ $hpt->hpt_tglpelaksanaan }}</td>
                                        <td>{{ $hpt->hpt_volume }}</td>
                                        <td>{{ $hpt->hpt_nomor }}</td>
                                        <td>{{ $hpt->hpt_halamanawal }}</td>
                                        <td>{{ $hpt->hpt_halamanakhir }}</td>
                                        <td>{{ $hpt->hpt_url }}</td>
                                        <td>{{ $hpt->hpt_kategori }}</td>
                                        <td>{{ $hpt->pgn_id }}</td>
                                        <td>{{ $hpt->hpt_atribut }}</td>

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
