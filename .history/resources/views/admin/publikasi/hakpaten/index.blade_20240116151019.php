@extends('admin.layouts.layout')

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
                            <a class="btn btn-primary" href="{{ route('admin.publikasi.hakpaten.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Hak Paten</a>
                            <a class="btn btn-success" href="{{ route('admin.publikasi.hakpaten.export') }}"><i class="fa fa-download" aria-hidden="true"></i>  Export Data</a>
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover table-bordered table-condensed table-striped grid">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">No Pemohonan</th>
                                    <th class="text-center">Tanggal Penerimaan</th>
                                    <th class="text-center">Status</th>
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
                                        <td class="text-center">{{ \Carbon\Carbon::parse($hpt->hpt_tglpenerimaan)->format('d-F-Y') }}</td>
                                        <td class="text-center">{{ $hpt->hpt_status }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.publikasi.hakpaten.edit', ['hpt_id' => $hpt->hpt_id]) }}" class="btn btn-warning">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $hpt->hpt_id }}" action="{{ route('admin.publikasi.hakpaten.destroy', ['hpt_id' => $hpt->hpt_id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $hpt->hpt_id }}').submit(); }">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>


                                            <a href="" id="detail-{{ $hpt->hpt_id }}" class="btn btn-primary detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $hpt->hpt_namalengkap }}"
                                                data-judul="{{ $hpt->hpt_judul }}"
                                                data-nopemohonan="{{ $hpt->hpt_nopemohonan }}"
                                                data-tglpenerimaan="{{ \Carbon\Carbon::parse($hpt->hpt_tglpenerimaan)->format('d-F-Y') }}"
                                                data-status="{{ $hpt->hpt_status }}">
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
