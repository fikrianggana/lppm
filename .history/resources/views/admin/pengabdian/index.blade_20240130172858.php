@extends('admin.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                <div class="card-title">
                    <h5> List Pengabdian Masyakarat </h5>
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
                            <a class="btn btn-primary" href="{{ route('admin.pengabdian.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengabdian Masyakarat</a>
                          </p>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('admin.pengabdian.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fa fa-search"></i>&nbsp;Cari
                                            </button>
                                            </span>
                                        </form>

                                        <!-- Export Excel Button -->
                                        <div class="text-right">
                                            <a class="btn btn-success" href="{{ route('admin.pengabdian.export', ['search' => request('search')]) }}">
                                                <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Unduh Excel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          <!-- Table with stripped rows -->
                            <table class="table table-hover table-bordered table-condensed table-striped grid">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kegiatan</th>
                                        <th class="text-center">Jenis Pengabdian</th>
                                        <th class="text-center">Waktu Pelaksanaan</th>
                                        <th class="text-center">Personil Yang Terlibat</th>
                                        <th class="text-center">Jumlah Penerima Manfaat</th>
                                        {{--  <th class="text-center">Bukti Pendukung</th>  --}}
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse ($pengabdian as $index => $pkm)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $pkm->pkm_namakegiatan }}</td>
                                    <td class="text-center">{{ $pkm->pkm_jenis }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($pkm->pkm_waktupelaksanaan)->format('d-F-Y') }}</td>
                                    <td class="text-center">{{ $pkm->pkm_personilterlibat }}</td>
                                    <td class="text-center">{{ $pkm->pkm_jumlahpenerimamanfaat }}</td>
                                    {{--  <td class="text-center"><a href="{{ $pkm->pkm_buktipendukung }}" class="fa fa-solid fa-download" type="button"></a></td>  --}}

                                    <td class="text-center">
                                        <a href="{{ route('admin.pengabdian.edit', ['pkm_id' => $pkm->pkm_id]) }}" class="btn btn-primary">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>

                                        <!-- Delete Button -->
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
                                                            document.getElementById('delete-form-{{ $pkm->pkm_id  }}').submit();
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

                                        <form id="delete-form-{{ $pkm->pkm_id }}" action="{{ route('admin.pengabdian.destroy', ['pkm_id' => $pkm->pkm_id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <a href="" id="detail-{{ $pkm->pkm_id }}" class="btn btn-primary detail-button"
                                            data-toggle="modal" data-target="#modal-detail"
                                            data-nama="{{ $pkm->pkm_namakegiatan }}"
                                            data-jenis="{{ $pkm->pkm_jenis }}"
                                            data-waktupelaksanaan="{{ \Carbon\Carbon::parse($pkm->pkm_waktupelaksanaan)->format('d-F-Y') }}"
                                            data-personilterlibat="{{ $pkm->pkm_personilterlibat }}"
                                            data-jumlahpenerimamanfaat="{{ $pkm->pkm_jumlahpenerimamanfaat }}"
                                            data-mahasiswa="{{ $pkm->pkm_mahasiswa }}"
                                            data-buktipendukung="{{ $pkm->pkm_buktipendukung }}">
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
                                    <th>Personil</th>
                                    <td><span id="terlibat"></span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penerima Manfaat</th>
                                    <td><span id="jumlah"></span></td>
                                </tr>
                                <tr>
                                    <th>Mahasiswa Yang Terlibat</th>
                                    <td><span id="mahasiswa"></span></td>
                                </tr>
                                <tr>
                                    <th>Bukti Pendukung</th>
                                    <td>
                                        <a id="bukti-download" href="" class="btn btn-primary btn-download" download>
                                        <i class="fa fa-download"></i> &nbsp;Download Bukti Pendukung
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
                var mhs = $(this).data('mahasiswa');
                var buktipendukung = $(this).data('buktipendukung');

                // Menampilkan data dalam modal
                $('#modal-detail').find('#name').text(nama);
                $('#modal-detail').find('#jns').text(jenis);
                $('#modal-detail').find('#waktu').text(waktupelaksanaan);
                $('#modal-detail').find('#terlibat').text(personilterlibat);
                $('#modal-detail').find('#jumlah').text(jumlahpenerimamanfaat);
                $('#modal-detail').find('#mahasiswa').text(mhs);
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
