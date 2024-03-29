@extends('layout.conquer')
@section('content')

<div class="container">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i>Master Supplier
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
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr id='tr_{{$d->id}}'>
                        <td>{{$d->id}}</td>
                        <td id='td_nama_{{$d->id}}'>{{$d->nama}}</td>
                        <td id='td_alamat_{{$d->id}}'>{{$d->alamat}}</td>
                        <td id='td_no_telepon_{{$d->id}}'>{{$d->no_telepon}}</td>
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
                <h4 class="modal-title">Tambah Supplier Baru</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('supplier') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" maxlength="45" name="nama" class="form-control" id='nama' placeholder="Masukkan nama" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" maxlength="100" name="alamat" class="form-control" id='alamat' placeholder="Masukkan alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="number" min="0" max="99999999999" maxlength="15" name="no_telepon" class="form-control" id='no_telepon' placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('supplier')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                url: '{{route("supplier.getEditForm")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
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
            url: '{{route("supplier.saveData")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'nama': eNama,
                'alamat': eAlamat,
                'no_telepon': eNoTelp,
            },
            success: function(data) {
                if (data.status == 'ok') {
                    alert(data.msg)
                    $('#td_nama_' + id).html(eNama);
                    $('#td_alamat_' + id).html(eAlamat);
                    $('#td_no_telepon_' + id).html(eNoTelp);
                }
            }
        });
    }

    function deleteDataRemoveTR(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("supplier.deleteData")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
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