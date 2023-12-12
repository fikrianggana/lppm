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
                                    <th class="text-center">Aksi</th>
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
                                        <td class="text-center">{{ $smn->pgn_id }}</td>
                                        <td class="text-center">{{ $smn->smn_atribut }}</td>

                                        <td class="text-center">
                                            <a href="" id="detail-{{ $sn->smn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $smn->smn_namapenulis }}"
                                                data-kategori="{{ $smn->smn_kategori }}"
                                                data-waktupelaksanaan="{{ $smn->smn_penyelenggara }}"
                                                data-personilterlibat="{{ $smn->smn_waktu }}"
                                                data-jumlahpenerimamanfaat="{{ $smn->smn_jumlahpenerimamanfaat }}"
                                                data-buktipendukung="{{ $smn->smn_buktipendukung }}">
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
                    var waktupelaksanaan = $(this).data('waktupelaksanaan');
                    var personilterlibat = $(this).data('personilterlibat');
                    var jumlahpenerimamanfaat = $(this).data('jumlahpenerimamanfaat');
                    var buktipendukung = $(this).data('buktipendukung');

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
