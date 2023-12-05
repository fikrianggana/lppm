@extends('karyawan.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card-title">
                          <h5> List Pengajuan </h5>
                  </div>
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          <p>
                          <a class="btn btn-primary" href="">+ Tambah Pengabdian</a>
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

                                 @forelse ($pengabdian as $pkm)
                                     <tr>
                                         <td>{{$pkm->pkm_namakegiatan}}</td>
                                         <td>{{$pkm->pkm_jenis}}</td>
                                         <td>{{ \Carbon\Carbon::parse($pkm->pkm_waktupelaksanaan)->format('d-F-Y') }}</td>
                                         {{-- <td>{{ implode(',', $product->categories->pluck('name')->toArray()) }}</td> --}}
                                         <td>{{$pkm->pkm_personilterlibat}}</td>
                                         <td>{{$pkm->pkm_jumlahpenerimamanfaat}}</td>
                                         <td>{{$pkm->pkm_buktipendukung}}</td>

                                         {{-- <td>
                                         @if ($product->image)
                                             <img src="{{ asset('storage/' . $product->image) }}"  style="max-width: 100px; max-height: 100px;">
                                         @else
                                             No Image
                                         @endif

                                         </td> --}}

                                         <td>
                                             {{-- <a href="{{ route('products.edit', ['pkm_id' => $pkm -> pkm_id] ) }}" class="btn btn-secondary btn-sm fas fa-edit"></a> --}}
                                             {{-- <a href="#" class="btn btn-sm btn-danger fas fa-trash" onclick="
                                                 event.preventDefault();
                                                 if (confirm('Do you want to remove this?')){
                                                     document.getElementById('delete-row-{{ $pkm->pkm_id }}').submit();
                                                 }">
                                             </a>
                                             <form id="delete-row-{{ $pkm->pkm_id }}" action="{{ route('products.destroy', ['pkm_id'=>$pkm->pkm_id]) }}" method="POST">
                                                 <input type="hidden" name="_method" value="DELETE">
                                                 @csrf
                                             </form> --}}

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
