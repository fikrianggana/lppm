@extends('admin.layouts.layout')

<body>
   @section('konten')


   <main id="main" class="main">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card-title">
                          <h5> List Pengaduan</h5>
                  </div>
                  <br>

                          @if (session('success'))
                              <div class="alert alert-success">{{ session('success')}} </div>
                          @endif

                          @if (session('error'))
                              <div class="alert alert-danger">{{ session('error')}} </div>
                          @endif

                          {{--  <p>
                            <a class="btn btn-primary" href="{{ route('karyawan.pengaduan.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengaduan</a>
                          </p>  --}}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group w-100">
                                        <!-- Search Form -->
                                        <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="form-inline w-100">
                                            <input name="search" type="search" class="form-control" placeholder="Pencarian" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </span>
                                        </form>

                                        <!-- Export Excel Button -->
                                        <div class="text-right">
                                            <a class="btn btn-success" href="{{ route('admin.pengaduan.export') }}">
                                                <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Unduh Excel
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                          <!-- Table with stripped rows -->
                          <table class="table table-hover table-bordered table-condensed table-striped grid">
                              <thead>
                                  <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tipe Pengaduan</th>
                                        <th class="text-center">Jenis Pengaduan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>
                                @forelse ($pengaduan as $index => $pdn)
                                    @if ($pdn->status === 1 || $pdn->status === 2 || $pdn->status === 4)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{$pdn->pdn_tipe}}</td>
                                        <td class="text-center">{{$pdn->pdn_jenis}}</td>
                                        <td class="text-center">{{$pdn->keterangan}}</td>

                                        <td class="text-center">
                                            @if ($pdn->status === 1)
                                            <!-- Confirm Button -->
                                            <a href="#" class="btn btn-default confirm-button" data-toggle="modal" data-target="#modal-validation" data-pdnid="{{ $pdn->pdn_id }}">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>

                                            <!-- Confirmation Modal -->
                                            <div class="modal fade" id="modal-validation">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Penerimaan <span style="color: red;">*</span></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda ingin menerima Pengaduan ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <a href="#" id="confirm-action" class="btn btn-success">Terima</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Reject Button -->
                                            <a href="#" class="btn btn-default reject-button" data-toggle="modal" data-target="#modal-reject" data-pdnid="{{ $pdn->pdn_id }}">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>

                                            <!-- Rejection Modal -->
                                            <div class="modal fade" id="modal-reject">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Apakah Anda ingin menolak pengajuan ini?</strong></p>
                                                            <!-- </br> -->
                                                            <form action="#" method="POST" class="reject-form">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="reject_reason" class="col-sm-2 col-form-label">Alasan Ditolak: <span style="color: red;">*</span></label>
                                                                    <div class="col-sm-12">
                                                                    <textarea class="form-control" id="reject_reason" name="keterangan" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-danger" id="reject-action">Tolak</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Detail Button -->
                                            <a href="" id="detail-{{ $pdn->pdn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-tipe="{{ $pdn->pdn_tipe }}"
                                                data-jenis="{{ $pdn->pdn_jenis }}"
                                                data-status="{{ $pdn->status }}"
                                                data-keterangan="{{ $pdn->keterangan }}">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>

                                            @endif

                                            @if ($pdn->status === 2)
                                                <!-- Tampilkan tombol kirim hanya jika status pengiriman sudah diterima -->
                                                <a href="#" data-toggle="modal" data-target="#modal-feedback" data-pdnid="{{ $pdn->pdn_id }}" class="btn btn-info feedback-button">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </a>

                                                <div class="modal fade" id="modal-feedback">
                                            </div>
                                            @endif

                                            @if ($pdn->status === 4)
                                            <a href="" id="detail-{{ $pdn->pdn_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pdn->usr_id }}"
                                                data-namasurat="{{ $pdn->pdn_namasurattugas }}"
                                                data-waktupelaksanaan="{{ \Carbon\Carbon::parse($pdn->pdn_masapelaksanaan)->format('d-F-Y') }}"
                                                data-buktipendukung="{{ $pdn->pdn_buktipendukung }}"
                                                data-status="{{ $pdn->status }}"
                                                data-surattugas="{{ $pdn->surattugas }}">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
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
                    <h5 class="modal-title">Detail Pengaduan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body table-responsive">
                    <table class="table table-bordered no-margin">
                        <tbody>

                            <tr>
                                <th>Tipe Pengaduan</th>
                                <td><span id="tipe"></span></td>
                            </tr>
                            <tr>
                                <th>Jenis Pengaduan</th>
                                <td><span id="jns"></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span id="status"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><span id="ket"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- script untuk mengambil data dan memunculkan kedalam modal detail -->
<script>
    $(document).ready(function() {
        $('.detail-button').on('click', function() {
            var tipe = $(this).data('tipe');
            var jenis = $(this).data('jenis');
            var status = $(this).data('status');
            var ket = $(this).data('keterangan');

            // Display data in the modal
            $('#modal-detail').find('#tipe').text(tipe);
            $('#modal-detail').find('#jns').text(jenis);
            $('#modal-detail').find('#status').text(status);
            $('#modal-detail').find('#ket').text(ket);

            // Show the modal
            $('#modal-detail').modal('show');
        });
    });

</script>

<script>
    $(document).ready(function() {
        // CONFIRM SURAT TUGAS
        $('.confirm-button').on('click', function() {
            var pdnId = $(this).data('pdnid');
            var confirmUrl = '{{ route("admin.pengaduan.confirm", ["pdn_id" => ":pdn_id"]) }}'.replace(':pdn_id', pdnId);
            $('#modal-validation').find('#confirm-action').attr('href', confirmUrl);
        });

        // TOLAK SURAT TUGAS
        $('.reject-button').on('click', function() {
            var pdnId = $(this).data('pdnid');
            var rejectUrl = '{{ route("admin.pengaduan.reject", ["pdn_id" => ":pdn_id"]) }}'.replace(':pdn_id', pdnId);
            $('#modal-reject').find('.reject-form').attr('action', rejectUrl);
        });

        $('#reject-action').on('click', function() {
            var rejectForm = $('#modal-reject').find('.reject-form');
            $.ajax({
                type: rejectForm.attr('method'),
                url: rejectForm.attr('action'),
                data: rejectForm.serialize(),
                success: function(response) {
                    console.log('Data rejected and deleted successfully');
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error rejecting and deleting data:', error);
                }
            });
            $('#modal-reject').modal('hide');
        });
    });
</script>

</html>


@endsection
