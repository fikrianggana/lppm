@extends('admin.layouts.layout')

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
                            <a class="btn btn-primary" href="{{ route('admin.publikasi.seminar.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Seminar</a>
                            <a class="btn btn-success" href="{{ route('admin.publikasi.seminar.export') }}"><i class="fa fa-download" aria-hidden="true"></i>  Export Data</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover table-bordered table-condensed table-striped grid">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Penulis</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Penyelenggara</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Tempat Pelaksanaan</th>
                                    <th class="text-center">Keterangan</th>
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
                                        <td class="text-center">{{ \Carbon\Carbon::parse($smn->smn_waktu)->format('d-F-Y') }}</td>
                                        <td class="text-center">{{ $smn->smn_tempatpelaksaan }}</td>
                                        <td class="text-center">{{ $smn->smn_keterangan }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.publikasi.seminar.edit', ['smn_id' => $smn->smn_id]) }}" class="btn btn-warning">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $smn->smn_id }}" action="{{ route('admin.publikasi.seminar.destroy', ['smn_id' => $smn->smn_id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $smn->smn_id }}').submit(); }">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>

                                            <a href="" id="detail-{{ $smn->smn_id }}" class="btn btn-primary detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $smn->smn_namapenulis }}"
                                                data-kategori="{{ $smn->smn_kategori }}"
                                                data-penyelenggara="{{ $smn->smn_penyelenggara }}"
                                                data-waktu="{{ \Carbon\Carbon::parse($smn->smn_waktu)->format('d-F-Y') }}"
                                                data-tempat="{{ $smn->smn_tempatpelaksaan }}"
                                                data-keterangan="{{ $smn->smn_keterangan }}">
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
                            <h5 class="modal-title">Detail Seminar</h5>
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
                                        <th>Kategori</th>
                                        <td><span id="kategori"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Penyelenggara</th>
                                        <td><span id="penyelenggara"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
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
                    var nama = $(this).data('nama');
                    var kategori = $(this).data('kategori');
                    var penyelenggara = $(this).data('penyelenggara');
                    var waktu = $(this).data('waktu');
                    var tempat = $(this).data('tempat');
                    var keterangan = $(this).data('keterangan');

                    // Menampilkan data dalam modal
                    $('#modal-detail').find('#nama').text(nama);
                    $('#modal-detail').find('#kategori').text(kategori);
                    $('#modal-detail').find('#penyelenggara').text(penyelenggara);
                    $('#modal-detail').find('#waktu').text(waktu);
                    $('#modal-detail').find('#tempat').text(tempat);
                    $('#modal-detail').find('#keterangan').text(keterangan);


                    $('#modal-detail').modal('show');
                });
            });
        </script>

    </html>
@endsection
