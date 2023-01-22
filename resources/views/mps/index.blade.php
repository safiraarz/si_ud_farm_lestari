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
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
    <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_spk_{{$d->id}}'>{{$d->surat_perintah_kerja->no_surat}}</td>
                    <td id='td_barang_{{$d->id}}'>{{$d->barang->nama}}</td>
                    <td id='td_kuantitas_{{$d->id}}'>{{number_format($d->kuantitas_barang_jadi)}}</td>
                    <td id='td_satuan_{{$d->id}}'>{{$d->barang->satuan}}</td>
                    <td id='td_tgl_mulai_produksi{{$d->id}}'>{{$d->tgl_mulai_produksi}}</td>
                    <td id='td_tgl_selesai_produksi{{$d->id}}'>{{$d->tgl_selesai_produksi}}</td>
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
                <h4 class="modal-title">Tambah MPS</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('mps') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nomor Surat Perintah Kerja</label>
                            <select class="form-control" name="spk" id="spk">
                                @foreach ($spk as $item)
                                <option value="{{ $item->id }}">{{ $item->no_surat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang Jadi</label>
                            <select class="form-control" name="barang" id="barang">
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas</label>
                            <input type="text" name="no_telepon" class="form-control" id='no_telepon' required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Produksi Mulai</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl mulai">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Produksi Selesai</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl selesai">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('mps')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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