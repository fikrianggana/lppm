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
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Judul Buku</th>
                                      <th>Penulis</th>
                                      <th>Editor</th>
                                      <th>ISBN </th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>

                                 @forelse ($buku as $bk)
                                     <tr>
                                         <td>{{$bk->bk_judul}}</td>
                                         <td>{{$bk->bk_penulis}}</td>
                                         <td>{{$bk->bk_editor}}</td>
                                         <td>{{$bk->bk_isbn}}</td>
                                         <td>{{$bk->bk_penerbit}}</td>

                                         <td>{{ \Carbon\Carbon::parse($bk->bk_tahun)->format('Y') }}</td>

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
