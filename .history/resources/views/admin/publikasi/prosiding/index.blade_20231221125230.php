@extends('admin.layouts.layout')

<body>
    @section('konten')
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-title">
                            <h5> List Prosiding</h5>
                        </div>
                        <br>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }} </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }} </div>
                        @endif

                        <p>
                            <a class="btn btn-primary" href="{{ route('admin.publikasi.prosiding.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Prosiding</a>
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

                                        <td class="text-center">
                                            <a href="{{ route('admin.publikasi.pro.edit', ['hpt_id' => $hpt->hpt_id]) }}" class="btn btn-warning">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <a href="{{ route('admin.publikasi.hakpaten.destroy', ['hpt_id' => $hpt->hpt_id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>


                                            <a href="" id="detail-{{ $pro->pro_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pro->pro_namapenulis }}"
                                                data-program="{{ $pro->pro_judulprogram }}"
                                                data-paper="{{ $pro->pro_judulpaper }}"
                                                data-kategori="{{ $pro->pro_kategori }}"
                                                data-penyelenggara="{{ $pro->pro_penyelenggara }}"
                                                data-waktu="{{ \Carbon\Carbon::parse($pro->pro_waktuterbit)->format('d-F-Y') }}"
                                                data-tempat="{{ $pro->pro_tempatpelaksanaan }}"
                                                data-keterangan="{{ $pro->pro_keterangan }}">
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
                            <h5 class="modal-title">Detail Prosiding</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered no-margin">
                                <tbody>

                                    <tr>
                                        <th>Nama Penulis</th>
                                        <td><span id="nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Program</th>
                                        <td><span id="program"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Paper</th>
                                        <td><span id="paper"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><span id="kategori"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Penyelenggara</th>
                                        <td><span id="penyelenggara"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Terbit</th>
                                        <td><span id="waktu"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Pelaksanaan</th>
                                        <td><span id="tempat"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td><span id="keterangan"></span></td>
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
                var name = $(this).data('nama');
                var pgrm = $(this).data('program');
                var ppr = $(this).data('paper');
                var kat = $(this).data('kategori');
                var penye = $(this).data('penyelenggara');
                var wkt = $(this).data('waktu');
                var tmpt = $(this).data('tempat');
                var ket = $(this).data('keterangan');


                // Menampilkan data dalam modal
                $('#modal-detail').find('#nama').text(name);
                $('#modal-detail').find('#program').text(pgrm);
                $('#modal-detail').find('#paper').text(ppr);
                $('#modal-detail').find('#kategori').text(kat);
                $('#modal-detail').find('#penyelenggara').text(penye);
                $('#modal-detail').find('#waktu').text(wkt);
                $('#modal-detail').find('#tempat').text(tmpt);
                $('#modal-detail').find('#keterangan').text(ket);

                $('#modal-detail').modal('show');
            });
        });
    </script>

    </html>
@endsection
