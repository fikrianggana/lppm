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
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($jurnal as $index => $jrn)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $jrn->jrn_judulmakalah }}</td>
                                        <td class="text-center">{{ $jrn->jrn_namajurnal }}</td>
                                        <td class="text-center">{{ $jrn->jrn_namapersonil }}</td>
                                        <td class="text-center">{{ $jrn->jrn_issn }}</td>
                                        <td class="text-center">{{ $jrn->jrn_volume }}</td>
                                        <td class="text-center">{{ $jrn->jrn_nomor }}</td>
                                        <td class="text-center">{{ $jrn->jrn_halamanawal }}</td>
                                        <td class="text-center">{{ $jrn->jrn_halamanakhir }}</td>
                                        <td class="text-center">{{ $jrn->jrn_url }}</td>
                                        <td class="text-center">{{ $jrn->jrn_kategori }}</td>
                                        <td class="text-center">{{ $jrn->pgn_id }}</td>
                                        <td class="text-center">{{ $jrn->jrn_atribut }}</td>

                                        <td class="text-center">
                                            <a href="" id="detail-{{ $jrn->jrn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-judul="{{ $jrn->jrn_judulmakalah }}"
                                                data-nama="{{ $jrn->jrn_namajurnal }}"
                                                data-namapersonal="{{ $jrn->jrn_namapersonil }}"
                                                data-issn="{{ $jrn->jrn_issn }}"
                                                data-volume="{{ $jrn->jrn_volume }}"
                                                data-nomor="{{ $jrn->jrn_nomor }}">
                                                data-halamanawal="{{ $jrn->jrn_halamanawal }}">
                                                data-halamanakhir="{{ $jrn->jrn_halamanakhir }}">
                                                data-url="{{ $jrn->jrn_url }}">
                                                data-kategori="{{ $jrn->jrn_kategori }}">
                                                

                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                        </td>
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
