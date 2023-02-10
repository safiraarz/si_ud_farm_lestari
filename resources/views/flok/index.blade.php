@extends('layout.conquer')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Master Flok
                </div>
                <div class="actions">
                    <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Flok</a>
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Cage</th>
                            <th>Strain</th>
                            <th>Populasi</th>
                            <th>Usia</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>{{ $d->cage }}</td>
                                <td>{{ $d->strain }}</td>
                                <td>{{ number_format($d->populasi) }}</td>
                                <td>{{ $d->usia }}</td>
                                <td>
                                    <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs'
                                        onclick="getEditForm({{ $d->id }})">
                                        <i class="fa fa-pencil"></i>
                                    </a>
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
                <h4 class="modal-title">Tambah Flok Baru</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('flok') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" id='nama' required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id='keterangan' required>
                        </div>
                        <div class="form-group">
                            <label>Cage</label>
                            <input type="text" name="cage" class="form-control" id='cage' required>
                        </div>
                        <div class="form-group">
                            <label>Strain</label>
                            <input type="text" name="strain" class="form-control" id='strain' required>
                        </div>
                        <div class="form-group">
                            <label>Populasi</label>
                            <input type="number" min="0" name="populasi" class="form-control" id='populasi'
                                required>
                        </div>
                        <div class="form-group">
                            <label>Usia/Hari</label>
                            <input type="type" min="0" name="usia" class="form-control" id='usia'
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ url('flok') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                    url: '{{ route('flok.getEditForm') }}',
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
            var eKeterangan = $('#eKeterangan').val();
            var eCage = $('#eCage').val();
            var eStrain = $('#eStrain').val();
            var ePopulasi = $('#ePopulasi').val();
            var eUsia = $('#eUsia').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('flok.saveData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'nama': eNama,
                    'keterangan': eKeterangan,
                    'cage': eCage,
                    'strain': eStrain,
                    'populasi': ePopulasi,
                    'usia': eUsia
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#td_nama_' + id).html(eNama);
                    }
                }
            });
        }

        function deleteDataRemoveTR(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('flok.deleteData') }}',
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
