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
                                                data-status="{{ $hpt->hpt_status }}">
                                                data-pengguna="{{ $hpt->pgn_id }}">
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
                            <h5 class="modal-title">Detail Pengabdian Masyarakat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered no-margin">
                                <tbody>

                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <td><span id="name"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pengabdian</th>
                                        <td><span id="jns"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Pelaksanaan</th>
                                        <td><span id="waktu"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Orang Yang Terlibat</th>
                                        <td><span id="terlibat"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Penerima Manfaat</th>
                                        <td><span id="jumlah"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pendukung</th>
                                        <td>
                                            <a id="bukti-download" href="" class="btn btn-primary btn-download" download>
                                            <i class="fa fa-download"></i> Download Bukti Pendukung
                                            </a>
                                        </td>
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
                var jenis = $(this).data('jenis');
                var nopemohonan = $(this).data('waktupelaksanaan');
                var tglpelaksanaan = $(this).data('personilterlibat');
                var tglpenerimaan = $(this).data('jumlahpenerimamanfaat');
                var status = $(this).data('buktipendukung');
                var pengguna = $(this).data('pgn_id')

                // Menampilkan data dalam modal
                $('#modal-detail').find('#name').text(nama);
                $('#modal-detail').find('#jns').text(jenis);
                $('#modal-detail').find('#waktu').text(waktupelaksanaan);
                $('#modal-detail').find('#terlibat').text(personilterlibat);
                $('#modal-detail').find('#jumlah').text(jumlahpenerimamanfaat);
                // $('#modal-detail').find('#bukti').text(buktipendukung);

                // Memperbarui tautan download dengan URL bukti pendukung
                var buktiDownloadLink = $('#modal-detail').find('#bukti-download');
                buktiDownloadLink.attr('href', buktipendukung);

                $('#modal-detail').modal('show');
            });
        });
    </script>

    </html>
@endsection