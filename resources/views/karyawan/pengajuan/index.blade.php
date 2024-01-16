@extends('karyawan.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card-title">
                          <h5> List Pengajuan Surat Tugas</h5>
                  </div>
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          <p>
                            <a class="btn btn-primary" href="{{ route('karyawan.pengajuan.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengajuan Surat Tugas</a>
                          </p>

                          <!-- Table with stripped rows -->
                          <table class="table table-hover table-bordered table-condensed table-striped grid">
                              <thead>
                                  <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Pengaju</th>
                                        <th class="text-center">Nama Surat Tugas</th>
                                        <th class="text-center">Masa Pelaksanaan</th>
                                        <!-- <th class="text-center">Status</th> -->
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($pengajuan as $index => $pst)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            @php
                                                $user = App\Models\User::find($pst->usr_id);
                                                echo $user ? $user->usr_nama : 'User Tidak Ditemukan';
                                            @endphp
                                        </td>
                                        <td class="text-center">{{$pst->pst_namasurattugas}}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}</td>
                                        <td class="text-center">
                                            @if ($pst->status === 1)
                                                <span class="badge badge-info">Sedang Diajukan</span>
                                            @elseif ($pst->status === 2)
                                                <span class="badge badge-success">Pengajuan Diterima</span>
                                            @elseif ($pst->status === 3)
                                                <span class="badge badge-danger">Pengajuan Ditolak</span>
                                            @elseif ($pst->status === 4)
                                                <span class="badge badge-primary">Surat Tugas Telah Diunggah,</span><br>
                                                <span class="badge badge-primary">Tolong Cek Kembali</span>
                                            @else
                                                <span class="badge badge-warning">Belum Dikirim</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($pst->status === 3)
                                                {{$pst->keterangan}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                        
                                            @if ($pst->status === 0)
                                                <a href="{{ route('karyawan.pengajuan.kirim', $pst->pst_id) }}" class="btn btn-default detail-button">  <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            @if ($pst->status === 0)
                                                <a href="{{ route('karyawan.pengajuan.edit', ['pst_id' => $pst->pst_id]) }}" class="btn btn-default detail-button">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif

                                            <a href="" id="detail-{{ $pst->pst_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pst->usr_id }}"
                                                data-namasurat="{{ $pst->pst_namasurattugas }}"
                                                data-waktupelaksanaan="{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}"
                                                data-buktipendukung="{{ $pst->pst_buktipendukung }}">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            @if($pst->status == 0)
                                                <a href="{{ route('karyawan.pengajuan.destroy', ['pst_id' => $pst->pst_id]) }}"
                                                class="btn btn-default detail-button"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $pst->pst_id }}').submit(); }">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            <form id="delete-form-{{ $pst->pst_id }}" action="{{ route('karyawan.pengajuan.destroy', ['pst_id' => $pst->pst_id]) }}" method="POST" style="display: none;">
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
                                <th>Nama Pengaju</th>
                                <td><span id="name"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Surat Tugas</th>
                                <td><span id="jns"></span></td>
                            </tr>
                            <tr>
                                <th>Masa Pelaksanaan</th>
                                <td><span id="waktu"></span></td>
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
                var namasurat = $(this).data('namasurat');
                var waktupelaksanaan = $(this).data('waktupelaksanaan');
                var buktipendukung = $(this).data('buktipendukung');

                // Menampilkan data dalam modal
                $('#modal-detail').find('#name').text(nama);
                $('#modal-detail').find('#jns').text(namasurat);
                $('#modal-detail').find('#waktu').text(waktupelaksanaan);
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
