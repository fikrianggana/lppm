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

                        <p>
                        <a class="btn btn-primary" href="{{ route('admin.pengaduan.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>   Tambah Pengajuan Surat Tugas</a>
                        </p>

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
                                    <th class="text-center">Nama Kegiatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengaduan as $index => $pdn)
                                    @if ($pdn->status === 1 || $pdn->status === 2 || $pdn->status === 4)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            @php
                                                $user = App\Models\User::find($pst->usr_id);
                                                echo $user ? $user->usr_nama : 'User Tidak Ditemukan';
                                            @endphp
                                        </td>
                                        <td class="text-center">{{ }}</td>


                                        <td class="text-center">
                                            @if ($pdn->status === 1)
                                            <!-- Confirm Button -->
                                            <a href="#" class="btn btn-success confirm-button" data-toggle="modal" data-target="#modal-validation" data-pstid="{{ $pst->pst_id }}">
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
                                                            <p>Apakah Anda ingin menerima Pengajuan Surat Tugas ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <a href="#" id="confirm-action" class="btn btn-success">Terima</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Reject Button -->
                                            <a href="#" class="btn btn-danger reject-button" data-toggle="modal" data-target="#modal-reject" data-pstid="{{ $pst->pst_id }}">
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

                                            {{--  <!-- Detail Button -->
                                            <a href="#" id="detail-{{ $pdn->pdn_id }}" class="btn btn-primary detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pdn->status }}"
                                                data-namasurat="{{ $pdn->keterangan }}"
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>  --}}

                                            @endif

                                            @if ($pdn->status === 2)
                                                <!-- Tampilkan tombol kirim hanya jika status pengiriman sudah diterima -->
                                                <a href="#" data-toggle="modal" data-target="#modal-feedback" data-pstid="{{ $pdn->pdn_id }}" class="btn btn-info feedback-button">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </a>

                                                <div class="modal fade" id="modal-feedback">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Terima Pengaduan - Kirim Pengaduan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="#" class="feedback-form" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="surattugas" class="col-sm-2 col-form-label">Surat Tugas <span style="color: red;">*</span></label>
                                                                    </br>

                                                                    <div class="col-sm-12">
                                                                        <input type="file" class="form-control" name="surattugas" id="surattugas" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary" id="feedback-action">Kirim</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($pst->status === 4)
                                            <a href="" id="detail-{{ $pst->pst_id }}" class="btn btn-default detail-button"
                                                data-toggle="modal" data-target="#modal-detail"
                                                data-nama="{{ $pst->usr_id }}"
                                                data-namasurat="{{ $pst->pst_namasurattugas }}"
                                                data-waktupelaksanaan="{{ \Carbon\Carbon::parse($pst->pst_masapelaksanaan)->format('d-F-Y') }}"
                                                data-buktipendukung="{{ $pst->pst_buktipendukung }}"
                                                data-status="{{ $pst->status }}"
                                                data-surattugas="{{ $pst->surattugas }}">
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
                                <th>Nama Pengaju</th>
                                <td><span id="name"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Surat Tugas</th>
                                <td><span id="jns"></span></td>
                            </tr>
                            <tr>
                                <th>Masa Pelaksanaan</th>
                                <td><span id="waktu"></span></td>
                            </tr>
                            <tr>
                                <th>Bukti Pendukung</th>
                                <td>
                                    <a id="bukti-download" href="" class="btn btn-primary btn-download" download>
                                    <i class="fa fa-download"></i> &nbsp;Download Bukti Pendukung
                                    </a>
                                </td>
                            </tr>

                            <tr id="surattugas-row">
                                <th>Surat Tugas</th>
                                <td>
                                    <a id="surattugas-download" href="" class="btn btn-primary btn-download" download>
                                        <i class="fa fa-download"></i> &nbsp;Download Surat Tugas
                                    </a>
                                </td>
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
            var nama = $(this).data('nama');
            var namasurat = $(this).data('namasurat');
            var waktupelaksanaan = $(this).data('waktupelaksanaan');
            var buktipendukung = $(this).data('buktipendukung');
            var surattugas = $(this).data('surattugas');
            var status = $(this).data('status');

            // Menampilkan data dalam modal
            $('#modal-detail').find('#name').text(nama);
            $('#modal-detail').find('#jns').text(namasurat);
            $('#modal-detail').find('#waktu').text(waktupelaksanaan);

            // Memperbarui tautan download dengan URL bukti pendukung
            var buktiDownloadLink = $('#modal-detail').find('#bukti-download');
            buktiDownloadLink.attr('href', buktipendukung);

            // Update the download link for surattugas based on the status
            var suratTugasRow = $('#modal-detail').find('#surattugas-row');
            var suratTugasDownloadLink = $('#modal-detail').find('#surattugas-download');

            if (status == 4 && surattugas) {
                suratTugasDownloadLink.attr('href', surattugas);
                suratTugasRow.show(); // Show the row for status 4
            } else {
                suratTugasRow.hide(); // Hide the row for other statuses
            }

            $('#modal-detail').modal('show');
        });

        // Additional script for downloading the file
        $('#bukti-download').on('click', function (e) {
            e.preventDefault();
            var downloadUrl = $(this).attr('href');

            // Use fetch API for downloading
            fetch(downloadUrl)
            .then(response => response.blob())
            .then(blob => {
                // Create a link element and trigger a click to download the file
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'bukti_pendukung_file_Surat_Tugas.pdf'; // Set desired file name
                link.click();
            })
            .catch(error => console.error('Error downloading file:', error));
        });
    });
</script>

<script>
    $(document).ready(function() {
        // CONFIRM SURAT TUGAS
        $('.confirm-button').on('click', function() {
            var pstId = $(this).data('pstid');
            var confirmUrl = '{{ route("admin.pengajuan.confirm", ["pst_id" => ":pst_id"]) }}'.replace(':pst_id', pstId);
            $('#modal-validation').find('#confirm-action').attr('href', confirmUrl);
        });

        // TOLAK SURAT TUGAS
        $('.reject-button').on('click', function() {
            var pstId = $(this).data('pstid');
            var rejectUrl = '{{ route("admin.pengajuan.reject", ["pst_id" => ":pst_id"]) }}'.replace(':pst_id', pstId);
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


        // KIRIM SURAT TUGAS
        $('.feedback-button').on('click', function() {
            var pstId = $(this).data('pstid');
            var feedbackUrl = '{{ route("admin.pengajuan.kirim", ["pst_id" => ":pst_id"]) }}'.replace(':pst_id', pstId);
            $('#modal-feedback').find('.feedback-form').attr('action', feedbackUrl);
        });

        $('#feedback-action').on('click', function(e) {
            e.preventDefault();

            var feedbackForm = $('#modal-feedback').find('.feedback-form');
            var formData = new FormData(feedbackForm[0]);

            $.ajax({
                type: feedbackForm.attr('method'),
                url: feedbackForm.attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Surat Tugas berhasil dikirim.');
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error mengirim Surat Tugas:', error.responseJSON.error);
                    // Display an error message to the user if needed
                }
            });

            $('#modal-feedback').modal('hide');
        });
    });
</script>

</html>

@endsection
