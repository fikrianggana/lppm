@extends('karyawan.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card-title">
                          <h5> List Buku</h5>
                  </div>
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          <p>
                          <a class="btn btn-primary" href="">+ Tambah Buku</a>
                          </p>

                          <!-- Table with stripped rows -->
                          <table class="table table-hover table-bordered table-condensed table-striped grid">
                              <thead>
                                  <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Judul Buku</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Editor</th>
                                        <th class="text-center">ISBN</th>
                                        <th class="text-center">Penerbit</th>
                                        <th class="text-center">Tahun</th>
                                        <th class="text-center">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($buku as $index => $bk)
                                     <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{$bk->bku_judul}}</td>
                                            <td class="text-center">{{$bk->bku_penulis}}</td>
                                            <td class="text-center">{{$bk->bku_editor}}</td>
                                            <td class="text-center">{{$bk->bku_isbn}}</td>
                                            <td class="text-center">{{$bk->bku_penerbit}}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($bk->bku_tahun)->format('Y') }}</td>

                                            <td class="text-center">
                                                <a href="" id="detail-{{ $bk->bku_id }}" class="btn btn-default detail-button"
                                                    data-toggle="modal" data-target="#modal-detail"
                                                    data-nama="{{ $bk->bku_judul }}"
                                                    data-judul="{{ $bk->bku_penulis }}"
                                                    data-nopemohonan="{{ $bk->bku_editor }}"
                                                    data-status="{{ $bk->bku_isbn }}"
                                                    data-pengguna="{{ $bk->bku_penerbit }}"
                                                    data-pengguna="{{ \Carbon\Carbon::parse($bk->bku_tahun)->format('Y') }}">

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

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Detail Hak Paten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
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
                            <tr>
                                <th>Pengguna</th>
                                <td><span id="pengguna"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>


</html>

@endsection
