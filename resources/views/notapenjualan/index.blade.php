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
    <h2>Daftar Nota Penjualan</h2>
    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Nota</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor Nota</th>
                    <th>Tanggal Pembuatan Nota</th>
                    <th>Nama Customer</th>
                    <th>Total Harga</th>
                    <th></th>
                    <th>Pembuat Nota</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_nota_{{$d->id}}'>{{$d->no_nota}}</td>
                    <td id='td_tanggal{{$d->id}}'>{{$d->tanggal}}</td>
                    <td id='td_customer_{{$d->id}}'>{{$d->customer->nama}}</td>
                    <td id='td_total_harga_{{$d->id}}'>Rp{{number_format($d->total_harga,2)}}</td>
                    <td> <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a>
                        <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$d->no_nota}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <hr>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna_id}}</td>
                    <td id='td_status_{{$d->id}}'>{{$d->status}}</td>
                    <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
                    </td>
                    <td>
                        <form method='POST' action="{{url('notapenjualan/'.$d->id)}}">
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
</div>
@endsection

<!-- add new data -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Nota</h4>
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
                url: '{{route("notapenjualan.getEditForm")}}',
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
</script>
@endsection