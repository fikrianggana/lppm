

@extends('admin.layouts.layout')

@section('konten')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-title">
                        <h5>Edit Jurnal</h5>
                    </div>
                    <br>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.publikasi.jurnal.update', ['jurnal' => $jrn->jrn_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="judul">Judul Makalah:</label>
                            <input type="text" name="jrn_judulmakalah" class="form-control" value="{{ $jrn->jrn_judulmakalah }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Jurnal:</label>
                            <input type="text" name="jrn_namajurnal" class="form-control" value="{{ $jrn->jrn_namajurnal }}" required>
                        </div>
                        <div class="form-group">
                            <label for="namapersonil">Nama Personil:</label>
                            <input type="text" name="jrn_namapersonil" class="form-control" value="{{ $jrn->jrn_namapersonil }}" required>
                        </div>
                        <div class="form-group">
                            <label for="issn">ISSN:</label>
                            <input type="text" name="jrn_issn" class="form-control" value="{{ $jrn->jrn_issn }}" required>
                        </div>
                        {{-- Tambahkan input dan field sesuai kebutuhan --}}

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
