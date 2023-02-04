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
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i>Master Production Schedule
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
                        <th>No. SPK</th>
                        <th>Nama Barang Jadi</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Tanggal Mulai Produksi</th>
                        <th>Tanggal Selesai Produksi</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
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
                        <td id='td_tgl_mulai_produksi{{$d->id}}'>{{$d->tgl_mulai_produksi}}</td>
                        <td id='td_tgl_selesai_produksi{{$d->id}}'>{{$d->tgl_selesai_produksi}}</td>
                        <td id='td_status_{{$d->id}}'>{{$d->status}}</td>
                        <!-- <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
                    </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
                                <option value="">Silahkan Pilih SPK</option>
                                @foreach ($spk as $item)
                                <option value="{{ $item->id }}">{{ $item->no_surat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="barang_spk">

                        </div>
                        <div class="form-group" id="selected_bahan_baku" style="display: none;">
                            <label>Nama Bahan Baku</label>
                            <select class="form-control" name="bahan_baku" id="bahan_baku">

                            </select>
                        </div> 
                        <div id="data_bahan_baku" style="display: none;">
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <input type="text" name="kuantitas_barang_jadi" class="form-control" id='kuantitas' required>
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Produksi Mulai</label>
                                <td>
                                    <div>
                                        <input type="date" id="tgl_mulai_produksi" name="tgl_mulai_produksi" class="form-control input-sm" required />
                                    </div>
                                </td>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Produksi Selesai</label>
                                <td>
                                    <div>
                                        <input type="date" id="tgl_selesai_produksi" name="tgl_selesai_produksi" class="form-control input-sm" required />
                                    </div>
                                </td>
                            </div>
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

@endsection


@section('javascript')
<script>
    var spkbarang = [
        @foreach($spk as $item)[
            "{{ $item->id }}",
                [
                    @foreach($item->daftar_barang as $barangs)[
                        "{{ $barangs->id }}",
                        "{{ $barangs->nama }}",
                        "{{ $barangs->pivot->kuantitas }}",
                        "{{ $barangs->pivot->tgl_mulai_produksi }}",
                        "{{ $barangs->pivot->tgl_selesai_produksi }}",
                        
                    ],
                    @endforeach
                ]
            ],
            @endforeach
        ];
    $("#spk").on('change', function() {
        $("#data_bahan_baku").hide();
        $("#selected_bahan_baku").show();
        $('#bahan_baku').html("");
        var id_spk= $(this).val();
        spkbarang.forEach(element => {
            if (id_spk == element[0]) {
                // Show Supplier
                for (let index = 0; index < element[1].length; index++) {
                    const elements = element[1][index];
                    var barang_id = elements[0];
                    var barang_name = elements[1];
                    var barang_pesanan = '<option value="' + barang_id + '" >' + barang_name + '</option>';
                    $('#bahan_baku').append(barang_pesanan);
                    
                }
            }
        });
    });

    $("#bahan_baku").on('change', function() {
        spkbarang.forEach(element => {
            if ($('#spk').val() == element[0]) {
                // Show Supplier
                for (let index = 0; index < element[1].length; index++) {
                    const elements = element[1][index];
                    var barang_id = elements[0];
                    if($("#bahan_baku").val() == barang_id) {
                        $("#data_bahan_baku").show();
                        $("#kuantitas").val(elements[2]);
                        $("#tgl_mulai_produksi").val(elements[3]);
                        $("#tgl_selesai_produksi").val(elements[4]);
                    }
           
                }
            }
        });
    });
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
    $('#myTable').DataTable();
</script>
@endsection