@extends('karyawan.layouts.layout')

<body>
    @section('konten')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-title">
                        <h5>List Detail Pengajuan Surat Tugas</h5>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group w-100">
                                <!-- Search Form -->
                                <form action="{{ route('karyawan.pengajuan.index') }}" method="GET"
                                    class="form-inline w-100">
                                    <input name="search" type="search" class="form-control"
                                        placeholder="Pencarian" />
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
                                <th class="text-center">Pengguna</th>
                                <th class="text-center">Nama Surat Tugas</th>
                                <th class="text-center">Masa Pelaksanaan</th>
                                <th class="text-center">Surat Tugas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @forelse ($pengajuanSuratTugas as $pengajuan)
                                @foreach ($involvedUsers[$pengajuan->pst_id] as $userId => $userName)
                                    @if ($userId == Auth::user()->usr_id && $pengajuan->status === 4) 
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">{{ $userName }}</td>
                                            <td class="text-center">{{ $pengajuan->pst_namasurattugas }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($pengajuan->pst_masapelaksanaan)->format('d-F-Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($pengajuan->status === 4)
                                                    <a href="{{ $pengajuan->surattugas }}" class="btn btn-primary btn-download" download>
                                                        <i class="fa fa-download"></i> &nbsp;Download Surat Tugas
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5">No Record found!</td>
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

@endsection
