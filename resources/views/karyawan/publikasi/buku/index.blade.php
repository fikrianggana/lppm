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

                            <!-- @if(session('info'))
                            <div class="alert alert-info">
                                {{ session('info') }}
                            </div>
                            @endif -->

                          <p>
                          <a class="btn btn-primary" href="{{ route('karyawan.publikasi.buku.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>  Tambah Buku</a>
                          </p>

                          <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('karyawan.publikasi.buku.index') }}" method="GET" class="form-inline w-100">
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
                                            <td class="text-center">{{$bk->bku_tahun}}</td>

                                            <td class="text-center">
                                                <a href="" id="detail-{{ $bk->bku_id }}" class="btn btn-default detail-button"
                                                    data-toggle="modal" data-target="#modal-detail"
                                                    data-judul="{{ $bk->bku_judul }}"
                                                    data-penulis="{{ $bk->bku_penulis }}"
                                                    data-editor="{{ $bk->bku_editor }}"
                                                    data-isbn="{{ $bk->bku_isbn }}"
                                                    data-penerbit="{{ $bk->bku_penerbit }}"
                                                    data-tahun="$bk->bku_tahun}}">
                                                    <!-- data-tahun="{{ \Carbon\Carbon::parse($bk->bku_tahun)->format('Y') }}" -->


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
                    <h5 class="modal-title">Detail Buku</h5>
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
                                <th>Tahun</th>
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
            var jdl = $(this).data('judul');
            var pnl = $(this).data('penulis');
            var edt = $(this).data('editor');
            var isb = $(this).data('isbn');
            var pnr = $(this).data('penerbit');
            var thn = $(this).data('tahun');

            // Menampilkan data dalam modal
            $('#modal-detail').find('#judul').text(jdl);
            $('#modal-detail').find('#penulis').text(pnl);
            $('#modal-detail').find('#editor').text(edt);
            $('#modal-detail').find('#isbn').text(isb);
            $('#modal-detail').find('#penerbit').text(pnr);
            $('#modal-detail').find('#tahun').text(thn);
            $('#modal-detail').modal('show');
        });
    });
</script>

@endsection
