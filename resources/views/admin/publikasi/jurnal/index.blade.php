@extends('admin.layouts.layout')

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
                            <a class="btn btn-primary" href="{{ route('admin.publikasi.jurnal.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>  Tambah Jurnal</a>
                            
                        </p>

                        <!-- Search Form and Export Excel Button -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('admin.publikasi.jurnal.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </span>
                                        </form>

                                        <!-- Export Excel Button -->
                                        <div class="text-right">
                                            <a class="btn btn-success" href="{{ route('admin.publikasi.jurnal.export', ['search' => request('search')]) }}">
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
                                    <th class="text-center">Judul Makalah</th>
                                    <th class="text-center">Nama Jurnal</th>
                                    <th class="text-center">Nama Personil</th>
                                    <th class="text-center">ISSN</th>
                                    {{--  <th class="text-center">Volume</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Halaman Awal</th>
                                    <th class="text-center">Halaman Akhir</th>  --}}

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
                                        {{--  <td class="text-center">{{ $jrn->jrn_volume }}</td>
                                        <td class="text-center">{{ $jrn->jrn_nomor }}</td>
                                        <td class="text-center">{{ $jrn->jrn_halamanawal }}</td>
                                        <td class="text-center">{{ $jrn->jrn_halamanakhir }}</td>  --}}


                                        <td class="text-center">
                                            <a href="{{ route('admin.publikasi.jurnal.edit', ['jrn_id' => $jrn->jrn_id]) }}" class="btn btn-default">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $jrn->jrn_id }}" action="{{ route('admin.publikasi.jurnal.destroy', ['jrn_id' => $jrn->jrn_id]) }}" method="POST" style="display: none;">
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
                                                                    document.getElementById('delete-form-{{ $jrn->jrn_id  }}').submit();
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


                                            <a href="" id="detail-{{ $jrn->jrn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-judul="{{ $jrn->jrn_judulmakalah }}"
                                                data-nama="{{ $jrn->jrn_namajurnal }}"
                                                data-namapersonil="{{ $jrn->jrn_namapersonil }}"
                                                data-issn="{{ $jrn->jrn_issn }}"
                                                data-volume="{{ $jrn->jrn_volume }}"
                                                data-nomor="{{ $jrn->jrn_nomor }}"
                                                data-halamanawal="{{ $jrn->jrn_halamanawal }}"
                                                data-halamanakhir="{{ $jrn->jrn_halamanakhir }}"
                                                data-url="{{ $jrn->jrn_url }}"
                                                data-kategori="{{ $jrn->jrn_kategori }}">

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
                                        <th>ISSN</th>
                                        <td><span id="issn"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Volume</th>
                                        <td><span id="volume"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor</th>
                                        <td><span id="nomor"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Halaman Awal</th>
                                        <td><span id="halamanawal"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Halaman Akhir</th>
                                        <td><span id="halamanakhir"></span></td>
                                    </tr>
                                    <tr>
                                        <th>URL</th>
                                        <td><span id="url"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><span id="kategori"></span></td>
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
                    var judul = $(this).data('judul');
                    var nama = $(this).data('nama');
                    var namapersonil = $(this).data('namapersonil');
                    var issn = $(this).data('issn');
                    var volume = $(this).data('volume');
                    var nomor = $(this).data('nomor');
                    var halamanawal = $(this).data('halamanawal');
                    var halamanakhir = $(this).data('halamanakhir');
                    var url = $(this).data('url');
                    var kategori = $(this).data('kategori');

                    // Menampilkan data dalam modal
                    $('#modal-detail').find('#jdl').text(judul);
                    $('#modal-detail').find('#nama').text(nama);
                    $('#modal-detail').find('#namapersonil').text(namapersonil);
                    $('#modal-detail').find('#issn').text(issn);
                    $('#modal-detail').find('#volume').text(volume);
                    $('#modal-detail').find('#nomor').text(nomor);
                    $('#modal-detail').find('#halamanawal').text(halamanawal);
                    $('#modal-detail').find('#halamanakhir').text(halamanakhir);
                    $('#modal-detail').find('#url').text(url);
                    $('#modal-detail').find('#kategori').text(kategori);

                    $('#modal-detail').modal('show');
                });
            });
        </script>

    </html>
@endsection
