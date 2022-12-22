@extends('layout.conquer')
@section('content')

<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <div class="form-row align-items-center">
        <h2>Daftar Customer</h2>
    </div>
    <div class="form-group mx-sm-2 mb-2">
        <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Customer</a>
    </div>

    <table class="table table-bordered">
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
                <td class='editable' id='td_nama_{{$d->id}}'>{{$d->nama}}</td>
                <td class='editable' id='td_alamat_{{$d->id}}'>{{$d->alamat}}</td>
                <td class='editable' id='td_no_telepon_{{$d->id}}'>{{$d->no_telepon}}</td>
                <td>
                    <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
                </td>
                <td>
                    <form method='POST' action="{{url('customer/'.$d->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('Are you sure you wanna delete this data?')) return false;">
                    </form>
                    <a class='btn btn-danger btn-xs' onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{$d->id}})">Delete 2</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>

@endsection
<!-- modal add new -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Customer Baru</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('customer') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" id='nama' required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" rows="3" name="alamat" class="form-control" id='alamat' required>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" id='no_telepon' required>
                            </input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('customer')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                url: '{{route("customer.getEditForm")}}',
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
            url: '{{route("customer.saveData")}}',
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
            url: '{{route("customer.deleteData")}}',
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
</script>
@endsection
@section('initialscript')
<script>
    $('.editable').editable({
        closeOnEnter: true,
        callback: function(data) {
            if (data.content) {
                alert(data.content)
            }
        }
    });

    var s_id = data.$el[0].id
    var fnama = s_id.split('_')[1]
    var id = s_id.split('_')[2]
    $.ajax({
        type: 'POST',
        url: '{{route("customer.saveDataField")}}',
        data: {
            '_token': '<?php echo csrf_token() ?>',
            'id': id,
            'fnama': fnama,
            'value': data.content

        },
        success: function(data){
            alert(data.msg)
        }
    });
</script>
@endsection