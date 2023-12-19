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

    

</body>
</html>

@endsection
