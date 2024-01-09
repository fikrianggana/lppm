@extends('admin.layouts.layout')

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
                          <a class="btn btn-primary" href="{{ route('admin.pengajuan.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengabdian Masyakarat</a>
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
                                        <td>
                                            @php
                                                $user = App\Models\User::find($pst->usr_id);
                                                echo $user ? $user->usr_nama : 'User Tidak Ditemukan';
                                            @endphp
                                        </td>
                                         <td>{{$pst->pst_namasurattugas}}</td>
                                         <td>{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}</td>
                                         {{-- <td>{{ implode(',', $product->categories->pluck('name')->toArray()) }}</td> --}}
                                         <td>{{$pst->pst_buktipendukung}}</td>
                                         
                                         <td class="text-center">
                                            <a href="" id="detail-{{ $pst->pst_id }}" class="btn btn-primary detail-button"
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


</body>
</html>

@endsection
