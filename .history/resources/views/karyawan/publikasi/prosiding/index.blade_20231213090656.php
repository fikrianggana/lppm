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
                            <a class="btn btn-primary" href="{{ route('karyawan.publikasi.hakpaten.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Hak Paten</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover table-bordered table-condensed table-striped grid">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Penulis</th>
                                    <th class="text-center">Judul Program</th>
                                    <th class="text-center">Judul Paper</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Penyelenggara</th>
                                    <th class="text-center">Waktu Terbit</th>
                                    <th class="text-center">Tempat Pelaksanaan</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($prosiding as $index => $pro)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $pro->pro_namapenulis }}</td>
                                        <td class="text-center">{{ $pro->pro_judulprogram }}</td>
                                        <td class="text-center">{{ $pro->pro_judulpaper }}</td>
                                        <td class="text-center">{{ $pro->pro_kategori }}</td>
                                        <td class="text-center">{{ $pro->pro_penyelenggara }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($pro->pro_waktuterbit)->format('d-F-Y') }}</td>
                                        <td class="text-center">{{ $pro->pro_tempatpelaksanaan }}</td>
                                        <td class="text-center">{{ $pro->pro_keterangan }}</td>
                                        <td class="text-center">{{ $pro->pgn_id }}</td>

                                        <td class="text-center">
                                            <a href="" id="detail-{{ $pro->hpt_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pro->hpt_namalengkap }}"
                                                data-judul="{{ $pro->hpt_judul }}"
                                                data-nopemohonan="{{ $pro->hpt_nopemohonan }}"
                                                data-tglpenerimaan="{{ \Carbon\Carbon::parse($pro->hpt_tglpenerimaan)->format('d-F-Y') }}"
                                                data-status="{{ $pro->hpt_status }}"
                                                data-pengguna="{{ $pro->pgn_id }}">
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
