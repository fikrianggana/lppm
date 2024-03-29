@extends('admin.layouts.layout')

<body>
    @section('konten')
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-title">
                            <h5> List Hak Cipta</h5>
                        </div>
                        <br>

                        @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                            });
                            </script>
                        @endif

                        @if (session('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ session('error') }}',
                                });
                            </script>
                        @endif


                        <p>
                            <a class="btn btn-primary" href="{{ route('admin.publikasi.hakcipta.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Hak Cipta</a>
                        </p>

                         <!-- Search Form and Export Excel Button -->
                         <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('admin.publikasi.hakcipta.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </span>
                                        </form>

                                        <!-- Export Excel Button -->
                                        <div class="text-right">
                                            <a class="btn btn-success" href="{{ route('admin.publikasi.hakcipta.export', ['search' => request('search')]) }}">
                                                <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Unduh Excel
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

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
                                            <a href="{{ route('admin.publikasi.hakcipta.edit', ['hcp_id' => $hcp->hcp_id]) }}" class="btn btn-default">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $hcp->hcp_id }}" action="{{ route('admin.publikasi.hakcipta.destroy', ['hcp_id' => $hcp->hcp_id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a href="#"
                                                class="btn btn-default"
                                                    onclick="event.preventDefault();
                                                        swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'You will not be able to recover this item!',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Yes, delete it!',
                                                            cancelButtonText: 'No, cancel!',
                                                            reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    document.getElementById('delete-form-{{ $hcp->hcp_id  }}').submit();
                                                                } else if (result.dismiss === swal.DismissReason.cancel) {
                                                                    swal.fire(
                                                                    'Cancelled',
                                                                    'Your item is safe :)',
                                                                    'error'
                                                                )
                                                            }
                                                        });
                                                    ">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>


                                            <a href="" id="detail-{{ $hcp->hcp_id }}" class="btn btn-primary detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $hcp->hcp_namalengkap }}"
                                                data-judul="{{ $hcp->hcp_judul }}"
                                                data-noapk="{{ $hcp->hcp_noapk }}"
                                                data-sertifikat="{{ $hcp->hcp_sertifikat }}"
                                                data-ket="{{ $hcp->hcp_keterangan }}">
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
                                        <td><span id="judul"></span></td>
                                    </tr>
                                    <tr>
                                        <th>No Pemohonan</th>
                                        <td><span id="noapk"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Penerimaan</th>
                                        <td><span id="sertifikat"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span id="ket"></span></td>
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
                var apk = $(this).data('noapk');
                var ser = $(this).data('sertifikat');
                var ktr = $(this).data('ket');

                // Menampilkan data dalam modal
                $('#modal-detail').find('#nama').text(nama);
                $('#modal-detail').find('#judul').text(judul);
                $('#modal-detail').find('#noapk').text(apk);
                $('#modal-detail').find('#sertifikat').text(ser);
                $('#modal-detail').find('#ket').text(ktr);

                $('#modal-detail').modal('show');
            });
        });
    </script>

    </html>
@endsection
