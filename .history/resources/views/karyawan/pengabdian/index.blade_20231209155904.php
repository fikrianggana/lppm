@extends('karyawan.layouts.layout')

<body>
   @section('konten')

   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <!-- <div class="card-title">
                          <h5> List Pengabdian Masyakarat </h5>
                  </div> -->
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          <p>
                          <a class="btn btn-primary" href="">+ Tambah Pengabdian Masyakarat</a>
                          </p>

                          <!-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input name="ctl00$MainContent$txtCari" type="text" id="txtCari" class="form-control" placeholder="Pencarian" />
                                        <span class="input-group-btn">
                                            <a id="MainContent_linkCari" class="btn btn-secondary" href="javascript:__doPostBack(&#39;ctl00$MainContent$linkCari&#39;,&#39;&#39;)"><i class="fa fa-search"></i>&nbsp;Cari</a>
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                            <div class="dropdown-menu dropdown-menu-right" style="padding: 20px; min-width: 300px !important;">
                                                <div class="form-group">
                                                    <label style='font-weight: bold;' for="ddUrut">Urut Berdasarkan</label>
                                                    <select name="ctl00$MainContent$ddUrut" id="MainContent_ddUrut" class="form-control dropdown" style="min-width: 260px !important;">
                                                        <option selected="selected" value="lastreply desc">Balasan Terakhir [↓]</option>
                                                        <option value="lastreply asc">Balasan Terakhir [↑]</option>
                                                        <option value="pwa_created_date desc">Tanggal Topik Dibuat [↓]</option>
                                                        <option value="pwa_created_date asc">Tanggal Topik Dibuat [↑]</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div> -->
                            <br>

                          <!-- Table with stripped rows -->
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Nama Kegiatan</th>
                                      <th>Jenis Pengabdian</th>
                                      <th>Waktu Pelaksanaan</th>
                                      <th>Orang Yang Terlibat</th>
                                      <th>Jumlah Penerima Manfaat</th>
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
                                    <th>Nama Kegiatan</th>
                                    <td><span id="name"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Pengabdian</th>
                                    <td><span id="jns"></span></td>
                                </tr>
                                <tr>
                                    <th>Waktu Pelaksanaan</th>
                                    <td><span id="waktu"></span></td>
                                </tr>
                                <tr>
                                    <th>Orang Yang Terlibat</th>
                                    <td><span id="terlibat"></span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penerima Manfaat</th>
                                    <td><span id="jumlah"></span></td>
                                </tr>
                                <tr>
                                    <th>Bukti Pendukung</th>
                                    <td>
                                        <a id="bukti-download" href="" class="btn btn-primary btn-download" download>
                                        <i class="fa fa-download"></i> Download Bukti Pendukung
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
                var buktipendukung = $(this).data('buktipendukung');

                // Menampilkan data dalam modal
                $('#modal-detail').find('#name').text(nama);
                $('#modal-detail').find('#jns').text(jenis);
                $('#modal-detail').find('#waktu').text(waktupelaksanaan);
                $('#modal-detail').find('#terlibat').text(personilterlibat);
                $('#modal-detail').find('#jumlah').text(jumlahpenerimamanfaat);
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
