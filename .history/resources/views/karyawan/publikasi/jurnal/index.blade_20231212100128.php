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
                                                data-nomor="{{ $jrn->jrn_nomor }}"
                                                data-halamanawal="{{ $jrn->jrn_halamanawal }}"
                                                data-halamanakhir="{{ $jrn->jrn_halamanakhir }}"
                                                data-url="{{ $jrn->jrn_url }}"
                                                data-kategori="{{ $jrn->jrn_kategori }}"
                                                data-pengguna="{{ $jrn->pgn_id }}"
                                                data-atribut="{{ $jrn->jrn_atribut }}">

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
                            <h5 class="modal-title">Detail Jurnal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered no-margin">
                                <tbody>

                                    <tr>
                                        <th>Judul Makalah</th>
                                        <td><span id="jdl"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurnal</th>
                                        <td><span id="nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Personil</th>
                                        <td><span id="namapersonil"></span></td>
                                    </tr>
                                    <tr>
                                        <th></th>
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
