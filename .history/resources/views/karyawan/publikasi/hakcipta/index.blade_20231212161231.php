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
                            <a class="btn btn-primary" href="{{ route('karyawan.publikasi.hakcipta.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Hak Paten</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover table-bordered table-condensed table-striped grid">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">No Aplikasi</th>
                                    <th class="text-center">No Sertifikat</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($hakcipta as $index => $hcp)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $hcp->hcp_namalengkap }}</td>
                                        <td class="text-center">{{ $hcp->hcp_judul }}</td>
                                        <td class="text-center">{{ $hcp->hcp_noapk }}</td>
                                        <td class="text-center">{{ $hcp->hcp_sertifikat }}</td>
                                        <td class="text-center">{{ $hcp->hcp_keterangan }}</td>

                                        <td class="text-center">
                                            <a href="" id="detail-{{ $hcp->hcp_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $hcp->hcp_namalengkap }}"
                                                data-judul="{{ $hcp->hcp_judul }}"
                                                data-n="{{ $hcp->hcp_noapk }}"
                                                data-status="{{ $hcp->hcp_sertifikat }}"
                                                data-pengguna="{{ $hcp->hcp_keterangan }}">
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

            <!-- Untuk memunculkan form modal detail -->
            <div class="modal fade" id="modal-detail">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Hak Paten</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered no-margin">
                                <tbody>

                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td><span id="nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td><span id="jdl"></span></td>
                                    </tr>
                                    <tr>
                                        <th>No Pemohonan</th>
                                        <td><span id="no"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Penerimaan</th>
                                        <td><span id="tglPen"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span id="status"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Pengguna</th>
                                        <td><span id="pengguna"></span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- End #main -->


    </body>

    <!-- script untuk mengambil data dan memunculkan kedalam modal detail -->
    <script>
        $(document).ready(function() {
            $('.detail-button').on('click', function() {
                var nama = $(this).data('nama');
                var judul = $(this).data('judul');
                var nopemohonan = $(this).data('nopemohonan');
                var tglpenerimaan = $(this).data('tglpenerimaan');
                var status = $(this).data('status');
                var pengguna = $(this).data('pengguna');

                // Menampilkan data dalam modal
                $('#modal-detail').find('#nama').text(nama);
                $('#modal-detail').find('#jdl').text(judul);
                $('#modal-detail').find('#no').text(nopemohonan);
                $('#modal-detail').find('#tglPen').text(tglpenerimaan);
                $('#modal-detail').find('#status').text(status);
                $('#modal-detail').find('#pengguna').text(pengguna);

                $('#modal-detail').modal('show');
            });
        });
    </script>

    </html>
@endsection
