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
                                                    data-judul="{{ $bk->bku_judul }}"
                                                    data-penulis="{{ $bk->bku_penulis }}"
                                                    data-editor="{{ $bk->bku_editor }}"
                                                    data-isbn="{{ $bk->bku_isbn }}"
                                                    data-penerbit="{{ $bk->bku_penerbit }}"
                                                    data-tahun="{{ \Carbon\Carbon::parse($bk->bku_tahun)->format('Y') }}">

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
                                <th>Judul</th>
                                <td><span id="judul"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Penulis</th>
                                <td><span id="penulis"></span></td>
                            </tr>
                            <tr>
                                <th>Editor</th></th>
                                <td><span id="editor"></span></td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td><span id="isbn"></span></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td><span id="penerbit"></span></td>
                            </tr>
                            <tr>
                                <th>tahun</th>
                                <td><span id="tahun"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
<!-- script untuk mengambil data dan memunculkan kedalam modal detail -->
<script>
    $(document).ready(function() {
        $('.detail-button').on('click', function() {
            var nama = $(this).data('judul');
            var judul = $(this).data('penulis');
            var nopemohonan = $(this).data('editor');
            var tglpenerimaan = $(this).data('isbn');
            var status = $(this).data('penerbit');
            var pengguna = $(this).data('pengguna')
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

@endsection