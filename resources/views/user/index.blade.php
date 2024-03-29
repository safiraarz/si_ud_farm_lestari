@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Master Pengguna
                </div>
                <div class="actions">
                    <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Data</a>
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_nama_{{ $d->id }}'>{{ $d->nama }}</td>
                                <td id='td_username_{{ $d->id }}'>{{ $d->username }}</td>
                                <td id='td_jabatan_{{ $d->id }}'>{{ $d->password }}</td>
                                <td id='td_jabatan_{{ $d->id }}'>{{ $d->jabatan->nama }}</td>
                                <td>
                                    {{-- <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs'
                                onclick="getEditForm({{ $d->id }})">
                                <i class="fa fa-pencil"></i>
                            </a> --}}
                                    <a class='btn btn-danger btn-xs'
                                        onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{ $d->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
@endsection
<!-- modal add new -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Pengguna Baru</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('user') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" maxlength="45" name="nama" class="form-control" id='nama'
                                required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" maxlength="20" name="username" class="form-control" id='username'
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="">Password</label>
                            <input id="password" type="password" maxlength="20"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="">Confirm
                                Password</label>
                            <input id="password-confirm" type="password" class="form-control" maxlength="20"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                                <option class="jabatan custom-select" selected>
                                    ===Pilih jabatan karyawan===
                                </option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" class="jabatan custom-select">{{ $jabatan->nama }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ url('user') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id='modalContent'>
        </div>
    </div>
</div>

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                    type: 'POST',
                    url: '{{ route('user.getEditForm') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': id
                    },
                    success: function(data) {
                        $('#modalContent').html(data.msg)
                    }
                },

            );
        }

        function saveDataUpdateTD(id) {
            var eNama = $('#eNama').val();
            var eAlamat = $('#eAlamat').val();
            var eNoTelp = $('#eNoTelp').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('user.saveData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'nama': eNama,
                    'username': eAlamat,
                    'jabatan': eNoTelp,
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#td_nama_' + id).html(eNama);
                        $('#td_username_' + id).html(eAlamat);
                        $('#td_jabatan_' + id).html(eNoTelp);
                    }
                }
            });
        }

        function deleteDataRemoveTR(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('user.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#tr_' + id).remove();
                    } else {
                        alert(data.msg)
                    }
                }
            });
        }
        $('#myTable').DataTable();
    </script>
@endsection
