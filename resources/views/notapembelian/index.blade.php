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
    <h2>Daftar Nota Pembelian</h2>
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
                    <th>Nama Supplier</th>
                    <th>Total Harga</th>
                    <th></th>
                    <th>Pembuat Nota</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_nota_{{$d->id}}'>{{$d->no_nota}}</td>
                    <td id='td_tgl_pembuatan_nota_{{$d->id}}'>{{$d->tgl_pembuatan_nota}}</td>
                    <td id='td_supplier_{{$d->id}}'>{{$d->supplier->nama}}</td>
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
                    <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
                    <td id='td_status_{{$d->id}}'>{{$d->status}}</td>
                    <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
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
            <div class="modal-body">
                <form action="{{ url('notapembelian') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>No Nota Pemesanan</label>
                            <select class="form-control" name="no_pesanan" id="no_pesanan">
                                @foreach ($notapemesanan as $item)
                                <option value="{{ $item->id }}">{{ $item->no_nota}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Nota Pembelian</label>
                            <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembuatan Nota</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <select class="form-control" name="supplier" id="supplier">
                                @foreach ($supplier as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Bahan Baku</label>
                            <select class="form-control" name="bahan_baku" id="bahan_baku">
                                <!-- seharusnya dikasih where jenis==bahan baku -->
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga per-satuan</label>
                            <input type="text" name="harga" class="form-control" id='harga' required>
                            </input>
                        </div>

                        <div class="form-group">
                            <label>Kuantitas</label>
                            <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                            </input>
                        </div>
                        <button type="tambah" class="btn btn-success">Tambah ke Nota</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('notapembelian')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                url: '{{route("notapembelian.getEditForm")}}',
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