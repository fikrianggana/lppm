@extends('karyawan.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('karyawan.pengajuan.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">New Pengajuan</h5>
                                <br>

                                @if ($errors -> any())
                                <div class="alert alert-danger">
                                    <div class="alert-title">
                                        <h4>Whooppss</h4>
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
                                    <!-- MENGAMBL NAMA USER BERDASARKAN YANG LOGIN -->
                                    <input type="hidden" name="usr_id" value="{{ Auth::user()->usr_id }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nama Surat Tugas</label>
                                    <input type="text" class="form-control" name="pst_namasurattugas"
                                        value="{{ old('pst_namasurattugas')}}" placeholder="Nama Surat Tugas">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Waktu Pelaksanaan</label>
                                    <input type="date" class="form-control" name="pst_masapelaksanaan"
                                        value="{{ old('pst_masapelaksanaan')}}" placeholder="Masa Pelaksanaan">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <input type="file" class="form-control" name="pst_buktipendukung"
                                        value="{{ old('pst_buktipendukung')}}">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Pengguna</label>
                                    <select name="usr_id" class="form-control" id="listPengguna">
                                        <option value="">-- Pengguna --</option>
                                        @foreach ($users as $usr_id => $usr_nama)
                                        <option value="{{ $usr_id }}" @if(old('usr_id')==$usr_id) selected @endif>
                                            {{ $usr_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

                                <!-- Added code for displaying selected users -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: bold;">Data Pengguna yang Dipilih</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pengguna</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selectedUsersTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Button to add selected user to the list -->
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" onclick="addSelectedUser()">Tambah Pengguna</button>
                                </div>
                                <br>
                                <div class="col-12" id="detailTempContainer" style="display: none;">
                                    <input type="hidden" class="form-control" id="detailTemp" name="detailTemp">
                                </div>
                            </div>
                            <br>
                        </div>
                </div>
                <div class="col-12">
                    {{-- <button href="{{ route('karyawan.pengabdian.index') }}" type="cancel"
                        class="btn btn-secondary">Batal</button> --}}
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
            </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

<script>
    function addSelectedUser() {
        var selectedUserId = $('#listPengguna').val();
        var selectedUserName = $('#listPengguna option:selected').text();

        // Check if the user is already added
        if ($('#selectedUsersTableBody').find('input[value="' + selectedUserId + '"]').length === 0) {
            var newRow = '<tr><td>' + selectedUserName + '</td><td><input type="hidden" name="selectedUsers[]" value="' + selectedUserId + '"><button type="button" class="btn btn-danger" onclick="removeSelectedUser(this)">Remove</button></td><td><input type="hidden" name="selectedUsersIds[]" value="' + selectedUserId + '"></td></tr>';
            $('#selectedUsersTableBody').append(newRow);

            updateDetailTemp();
        }
    }

    function updateDetailTemp() {
        var selectedUserIds = [];
        $('#selectedUsersTableBody input[name="selectedUsersIds[]"]').each(function () {
            selectedUserIds.push($(this).val());
        });

        // Update the detailTemp input with the concatenated IDs
        $('#detailTemp').val(selectedUserIds.join(','));
        $('#detailTempContainer').show();
    }

    function removeSelectedUser(button) {
        // Get the removed user name
        var removedUserName = $(button).closest('tr').find('td:first').text();

        // Remove the user from the detailTemp input
        var currentDetail = $('#detailTemp').val();
        var updatedDetail = currentDetail.replace(removedUserName, '').trim();
        $('#detailTemp').val(updatedDetail);

        // Remove the table row
        $(button).closest('tr').remove();

        // Setel nilai textbox detailTemp menjadi kosong jika tidak ada pengguna terpilih
        if ($('#selectedUsersTableBody').find('tr').length === 0) {
            $('#detailTemp').val('');
            $('#detailTempContainer').hide();
        }

    }
</script>

@endsection