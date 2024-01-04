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
                            <a class="btn btn-primary" href="{{ route('karyawan.pengajuan.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengabdian Masyakarat</a>
                          </p>

                          <!-- Table with stripped rows -->
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Nama Pengajuan</th>
                                      <th>Nama Surat Tugas</th>
                                      <th>Masa Pelaksanaan</th>
                                      <th>Bukti Pendukung</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($pengajuan as $pst)
                                     <tr>
                                         <td>{{$pst->usr_id}}</td>
                                         <td>{{$pst->pst_namasurattugas}}</td>
                                         <td>{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}</td>
                                         {{-- <td>{{ implode(',', $product->categories->pluck('name')->toArray()) }}</td> --}}
                                         <td>{{$pst->pst_buktipendukung}}</td>

                                         <td class="text-center">
                                            <a href="" id="detail-{{ $pst->pst_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pst->usr_id }}"
                                                data-namasurat="{{ $pst->pst_namasurattugas }}"
                                                data-waktupelaksanaan="{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}"
                                                data-buktipendukung="{{ $pst->pst_buktipendukung }}">
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
