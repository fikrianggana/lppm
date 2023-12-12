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
                            <a class="btn btn-primary" href="{{ route('karyawan.publikasi.hakpaten.create') }}">+ Tambah Hak Paten</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Hak Paten</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">No Pemohonan</th>
                                    <th class="text-center">Tanggal Pelaksanaan</th>
                                    <th class="text-center">Tanggal Penerimaan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Pengguna</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($hakpaten as $index => $hpt)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $hpt->hpt_namalengkap }}</td>
                                        <td class="text-center">{{ $hpt->hpt_judul }}</td>
                                        <td class="text-center">{{ $hpt->hpt_nopemohonan }}</td>
                                        <td class="text-center">{{ $hpt->hpt_tglpelaksanaan }}</td>
                                        <td class="text-center">{{ $hpt->hpt_tglpenerimaan }}</td>
                                        <td class="text-center">{{ $hpt->hpt_status }}</td>
                                        <td class="text-center">{{ $hpt->pgn_id }}</td>

                                        <td class="text-center">
                                            <a href="" id="detail-{{ $hpt->hpt_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $$hpt->hpt_namalengkap }}"
                                                data-judul="{{ $hpt->hpt_judul }}"
                                                data-nopemohonan="{{ $hpt->hpt_nopemohonan }}"
                                                data-tglpelaksanaan="{{ $hpt->hpt_tglpelaksanaan }}"
                                                data-tglpenerimaan="{{ $hpt->hpt_tglpenerimaan }}"
                                                data-status="{{ $pkm->hpt_status }}">
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
