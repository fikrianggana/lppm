@extends('karyawan.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card-title">
                          <h5> List Pengaduan</h5>
                  </div>
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          <p>
                            <a class="btn btn-primary" href="{{ route('karyawan.pengaduan.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengaduan</a>
                          </p>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('karyawan.pengaduan.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>

                          <!-- Table with stripped rows -->
                          <table class="table table-hover table-bordered table-condensed table-striped grid">
                              <thead>
                                  <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tipe Pengaduan</th>
                                        <th class="text-center">Jenis Pengaduan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($pengaduan as $index => $pdn)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            @php
                                                $user = App\Models\User::find($pdn->usr_id);
                                                echo $user ? $user->usr_nama : 'User Tidak Ditemukan';
                                            @endphp
                                        </td>
                                        <td class="text-center">{{$pdn->pdn_namasurattugas}}</td>
                                        <td class="text-center">{{ $pdn->pdn_tipe }}</td>
                                        <td class="text-center">{{ $pdn->pdn_jenis }}</td>
                                        <td class="text-center">
                                            @if ($pdn->status === 1)
                                                <span class="badge badge-info">Sedang Diajukan</span>
                                            @elseif ($pdn->status === 2)
                                                <span class="badge badge-success">Pengajuan Diterima</span>
                                            @elseif ($pdn->status === 3)
                                                <span class="badge badge-danger">Pengajuan Ditolak</span>
                                            @elseif ($pdn->status === 4)
                                                <span class="badge badge-primary">Pengaduan Telah Diunggah,</span><br>
                                                <span class="badge badge-primary">Tolong Cek Kembali</span>
                                            @else
                                                <span class="badge badge-warning">Belum Dikirim</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($pdn->status === 3)
                                                {{$pdn->keterangan}}
                                            @endif
                                        </td>
                                        <!-- ... Bagian HTML lainnya ... -->

                                        <td class="text-center">
                                            @if ($pdn->status === 0)
                                                <a href="{{ route('karyawan.pengaduan.kirim', $pdn->pdn_id) }}" class="btn btn-default">  <i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                            @endif

                                            @if ($pdn->status === 0)
                                                <a href="{{ route('karyawan.pengaduan.edit', ['pdn_id' => $pdn->pdn_id]) }}" class="btn btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif

                                            <a href="" id="detail-{{ $pdn->pdn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-tipe="{{ $pdn->pdn_tipe }}"
                                                data-jenis="{{ $pdn->pdn_jenis }}"
                                                data-status="{{ $pdn->status }}"
                                                data-keterangan="{{ $pdn->keterangan }}">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            @if($pdn->status == 0)
                                                <a href="{{ route('karyawan.pengaduan.destroy', ['pdn_id' => $pdn->pdn_id]) }}"
                                                class="btn btn-default"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $pdn->pdn_id }}').submit(); }">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            <form id="delete-form-{{ $pdn->pdn_id }}" action="{{ route('karyawan.pengaduan.destroy', ['pdn_id' => $pdn->pdn_id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
    </main><!-- End #main -->

    <!-- Untuk memunculkan form modal detail -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengaduan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body table-responsive">
                    <table class="table table-bordered no-margin">
                        <tbody>

                            <tr>
                                <th>Tipe Pengaduan</th>
                                <td><span id="tipe"></span></td>
                            </tr>
                            <tr>
                                <th>Jenis Pengaduan</th>
                                <td><span id="jns"></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span id="status"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><span id="ket"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

    <!-- script untuk mengambil data dan memunculkan kedalam modal detail -->
    <script>
        $(document).ready(function() {
            $('.detail-button').on('click', function() {
                var nama = $(this).data('nama');
                var namasurat = $(this).data('namasurat');
                var waktupelaksanaan = $(this).data('waktupelaksanaan');
                var buktipendukung = $(this).data('buktipendukung');
                var surattugas = $(this).data('surattugas');
                var status = $(this).data('status');

                // Display data in the modal
                $('#modal-detail').find('#name').text(nama);
                $('#modal-detail').find('#jns').text(namasurat);
                $('#modal-detail').find('#waktu').text(waktupelaksanaan);

                // Update the download link for bukti pendukung
                var buktiDownloadLink = $('#modal-detail').find('#bukti-download');
                buktiDownloadLink.attr('href', buktipendukung);

                // Update the download link for surattugas based on the status
                var suratTugasRow = $('#modal-detail').find('#surattugas-row');
                var suratTugasDownloadLink = $('#modal-detail').find('#surattugas-download');

                if (status == 4 && surattugas) {
                    suratTugasDownloadLink.attr('href', surattugas);
                    suratTugasRow.show(); // Show the row for status 4
                } else {
                    suratTugasRow.hide(); // Hide the row for other statuses
                }

                // Show the modal
                $('#modal-detail').modal('show');
            });
        });


    </script>
</html>

@endsection
