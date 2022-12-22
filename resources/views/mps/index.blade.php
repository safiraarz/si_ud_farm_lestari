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
    <h2>Daftar Master Production Schedule</h2>
    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah MPS</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID SPK</th>
                    <th>Nama Barang Jadi</th>
                    <th>Kuantitas</th>
                    <th>Satuan</th>
                    <th>Tanggal Mulai Produksi</th>
                    <th>Tanggal Selesai Produksi</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_spk_{{$d->id}}'>{{$d->spk->no_surat}}</td>
                    <td id='td_barang_{{$d->id}}'>{{$d->barang->nama}}</td>
                    <td id='td_kuantitas_{{$d->id}}'>{{number_format($d->kuantitas_barang_jadi)}}</td>
                    <td id='td_satuan_{{$d->id}}'>{{$d->barang->satuan}}</td>
                    <td id='td_tanggal_mulai_produksi{{$d->id}}'>{{$d->tgl_mulai_produksi}}</td>
                    <td id='td_tanggal_selesai_produksi{{$d->id}}'>{{$d->tgl_akhir_produksi}}</td>

                    <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
                    </td>
                    <td>
                        <form method='POST' action="{{url('mps/'.$d->id)}}">
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
                <h4 class="modal-title">Tambah Surat</h4>
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
                url: '{{route("mps.getEditForm")}}',
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