@extends('karyawan.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.pengaduan.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Pengaduan</h5>
                                <br>

                                @if ($errors -> any())
                                    <div class="alert alert-danger">
                                        <div class="alert-title"><h4>Whooppss</h4>
                                        There are some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li> {{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success')}} </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error')}} </div>
                                @endif

                                <div class="col-12">
                                    <label class="form-label">Tipe Pengaduan</label>
                                    <!-- <input type="text" class="form-control" name="pdn_tipe" value="{{ old('pdn_tipe')}}" placeholder="Tipe Pengaduan"> -->
                                    <select name="pdn_tipe" class="form-control form-control-line" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Ubah" @if(old('pdn_tipe') == 'Ubah') selected @endif>Ubah </option>
                                        <option value="Hapus" @if(old('pdn_tipe') == 'Hapus') selected @endif>Hapus </option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Jenis Pengaduan</label>
                                    <select name="pdn_jenis" class="form-control form-control-line" id="datajenispengaduan" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Pengabdian Masyarakat" @if(old('pdn_jenis') == 'Pengabdian Masyarakat') selected @endif>Pengabdian Masyarakat </option>
                                        <option value="Buku" @if(old('pdn_jenis') == 'Buku') selected @endif>Buku </option>
                                        <option value="Jurnal" @if(old('pdn_jenis') == 'Jurnal') selected @endif>Jurnal </option>
                                        <option value="Seminar" @if(old('pdn_jenis') == 'Seminar') selected @endif>Seminar </option>
                                        <option value="Hak Cipta" @if(old('pdn_jenis') == 'Hak Cipta') selected @endif>Hak Cipta </option>
                                        <option value="Hak Paten" @if(old('pdn_jenis') == 'Hak Paten') selected @endif>Hak Paten </option>
                                        <option value="Prosiding" @if(old('pdn_jenis') == 'Prosiding') selected @endif>Prosiding </option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Data</label>
                                    <select id="databre" class="form-control form-control-line" required>
                                        foreach($buku as $bk)
                                        <option value="">Pilih Data</option>
                                        
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan')}}">
                                </div>
                            </div>
                            <br>
                            </div>
                        </div>
                        <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

<!-- Letakkan di bagian head atau sebelum penutup tag </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika jenis pengaduan berubah
        $('#datajenispengaduan').change(function() {
            var jenisPengaduan = $(this).val();

            // Kirim AJAX request untuk mendapatkan data berdasarkan jenis pengaduan
            $.ajax({
                url: {{ route('pengaduan.getData') }} // Ganti URL sesuai dengan route yang kamu buat
                type: 'GET',
                success: function(data) {
                    // Hapus semua opsi pada select dengan id 'databre'
                    $('#databre').empty();

                    // Tambahkan opsi baru berdasarkan data yang didapatkan dari server
                    $.each(data, function(key, value) {
                        $('#databre').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>


@endsection



