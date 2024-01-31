@extends('admin.layouts.layout')

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
                                <a class="btn btn-primary" href="{{ route('admin.prodi.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>  Tambah Prodi</a>
                            </p>

                            <!-- Search Form and Export Excel Button -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('admin.prodi.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </span>
                                        </form>

                                        <!-- Export Excel Button -->
                                        <div class="text-right">
                                            <a class="btn btn-success" href="{{ route('admin.prodi.export', ['search' => request('search')]) }}">
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
                                        <th class="text-center">Nama Prodi</th>
                                        <th class="text-center">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($prodi as $index => $prd)
                                     <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{$prd->prd_nama}}</td>


                                        <td class="text-center">


                                            <a href="{{ route('admin.prodi.edit', ['id' => $prd->id]) }}" class="btn btn-default">
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
                                                                    document.getElementById('delete-form-{{ $prd->id }}').submit();
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

                                            <form id="delete-form-{{ $bk->bku_id }}" action="{{ route('admin.prodi.destroy', ['bku_id' => $bk->bku_id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>


                                            <a href="" id="detail-{{ $bk->bku_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-judul="{{ $bk->bku_judul }}"
                                                data-penulis="{{ $bk->bku_penulis }}"
                                                data-editor="{{ $bk->bku_editor }}"
                                                data-isbn="{{ $bk->bku_isbn }}"
                                                data-penerbit="{{ $bk->bku_penerbit }}"
                                                data-tahun="{{$bk->bku_tahun}}">

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
