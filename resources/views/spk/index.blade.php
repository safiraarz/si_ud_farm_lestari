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
    <h2>Daftar Surat Perintah Kerja</h2>
    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Surat</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor SPK</th>
                    <th>Tanggal Pembuatan SPK</th>
                    <th>Tanggal Mulai Produksi</th>
                    <th>Tanggal Selesai Produksi</th>
                    <th></th>
                    <th>Pembuat Surat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_spk_{{$d->id}}'>{{$d->no_surat}}</td>
                    <td id='td_tgl_pembuatan_spk_{{$d->id}}'>{{$d->tgl_pembuatan_surat}}</td>
                    <td id='td_tgl_mulai_produksi{{$d->id}}'>{{$d->tgl_mulai_produksi}}</td>
                    <td id='td_tgl_selesai_produksi{{$d->id}}'>{{$d->tgl_selesai_produksi}}</td>
                    <td> <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a>
                        <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$d->no_surat}}</h4>
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
                <h4 class="modal-title">Tambah Surat</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('spk') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nomor SPK</label>
                            <input type="text" name="nomor_spk" class="form-control" id='nomor_spk' required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembuatan SPK</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Mulai Produksi</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai Produksi</label>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id='keterangan'></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang Jadi</label>
                            <select class="form-control" name="jenis_telur" id="jenis_telur">
                                <!-- seharusnya dikasih where jenis==barang jadi -->
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas</label>
                            <input type="text" name="kuantitas" class="form-control" id='eKuantitas' required>
                            </input>
                        </div>
                        <button type="tambah" class="btn btn-success">Tambah ke Tabel</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('spk')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                url: '{{route("spk.getEditForm")}}',
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