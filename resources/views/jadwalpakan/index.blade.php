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
    <h2>Daftar Pemberian Pakan Ayam</h2>
    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Jadwal</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Pemberian</th>
                    <th>Jenis Pakan</th>
                    <th>Kuantitas</th>
                    <th>Satuan</th>
                    <th>Flok Tujuan</th>
                    <th>Pencatat Transaksi</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td id='td_tanggal_pemberian_'>{{$d->tanggal_pemberian}}</td>
                    <td id='td_jenis_telur_'>{{$d->barang->nama}}</td>
                    <td id='td_kuantitas'>{{number_format($d->kuantitas)}}</td>
                    <td id='td_satuan'>{{$d->barang->satuan}}</td>
                    <td id='td_flok_tujuan_'>{{$d->flok->nama}}</td>
                    <td id='td_pencatat_transaksi_'>{{$d->pengguna_id}}</td>
                    <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm()">EDIT</a>
                    </td>
                    <td>
                        <form method='POST' action="{{url('jadwalpakan/')}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('Are you sure you wanna delete this data?')) return false;">
                        </form>
                        <a class='btn btn-danger btn-xs' onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR()">Delete 2</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- tambah jadwalpakan -->

<!-- <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('jadwalpakan.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Barang">
                        </div>
                         <div class="form-group">
                            <label>Jenis Barang</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Jenis Barang">
                        </div>
                        <div class="form-group">
                            <label>Jenis Telur</label>
                            <select class="form-control" name="jenis_telur" id="jenis_telur">
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Asal Flok</label>
                            <select class="form-control" name="asal_flok" id="asal_flok">
                                @foreach ($flok as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas Reject</label>
                            <input type="text" name="kuantitas_reject" class="form-control" placeholder="Kuantitas Reject">
                        </div>
                        <div class="form-group">
                            <label>Kuantitas Bersih</label>
                            <input type="text" name="kuantitas_bersih" class="form-control" placeholder="Kuantitas Bersih">
                        </div>
                        <div class="form-group">
                            <label>Total Kuantitas</label>
                            <input type="text" name="total_kuantitas" class="form-control" placeholder="Total Kuantitas">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="harga" class="form-control" placeholder="Harga per-Satuan">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            @foreach ($barang as $item)
                            <input type="text" value="{{ $item->id }}">{{ $item->satuan }}</input>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pencatatan</label>
                            <input type="text" name="tanggal_pencatatan" class="form-control" placeholder="Pilih tanggal">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  -->

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
                url: '{{route("jadwalpakan.getEditForm")}}',
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

    // function saveDataUpdateTD(id) {
    //     var eNama = $('#eNama').val();
    //     var eHarga = $('#eHarga').val();
    //     var eLeadTime = $('#eLeadTime').val();
    //     var eKuantitas_stok_onorder_supplier = $('#eKuantitas_stok_onorder_supplier').val();
    //     var eKuantitas_stok_onorder_produksi = $('#eKuantitas_stok_onorder_produksi').val();
    //     var eKuantitas_stok_ready = $('#eKuantitas_stok_ready').val();
    //     var eTotal_kuantitas_stok = $('#eTotal_kuantitas_stok').val();
    //     var eJenis = $('#eJenis').val();
    //     var eSatuan = $('#eSatuan').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: '{{route("jadwalpakan.saveData")}}',
    //         data: {
    //             '_token': '<?php echo csrf_token() ?>',
    //             'id': id,
    //             'nama': eNama,
    //             'harga': eHarga,
    //             'lead_time': eLeadTime,
    //             'kuantitas_stok_onorder_supplier': eKuantitas_stok_onorder_supplier,
    //             'kuantitas_stok_onorder_produksi': eKuantitas_stok_onorder_produksi,
    //             'kuantitas_stok_ready': eKuantitas_stok_ready,
    //             'total_kuantitas_stok': eTotal_kuantitas_stok,
    //             'jenis': eJenis,
    //             'satuan': eSatuan,
    //         },
    //         success: function(data) {
    //             if (data.status == 'ok') {
    //                 alert(data.msg)
    //                 $('#td_nama_' + id).html(eNama);
    //                 $('#td_harga_' + id).html(eHarga);
    //                 $('#td_lead_time_' + id).html(eLead_time);
    //                 $('#td_kuantitas_stok_onorder_supplier_' + id).html(eKuantitas_stok_onorder_supplier);
    //                 $('#td_kuantitas_stok_onorder_produksi_' + id).html(eKuantitas_stok_onorder_produksi);
    //                 $('#td_kuantitas_stok_ready_' + id).html(eKuantitas_stok_ready);
    //                 $('#td_total_kuantitas_stok_' + id).html(eTotal_kuantitas_stok);
    //                 $('#td_jenis_' + id).html(eJenis);
    //                 $('#td_satuan' + id).html(eSatuan);
    //             }
    //         }
    //     });
    // }

    // function deleteDataRemoveTR(id) {
    //     $.ajax({
    //         type: 'POST',
    //         url: '{{route("jadwalpakan.deleteData")}}',
    //         data: {
    //             '_token': '<?php echo csrf_token() ?>',
    //             'id': id
    //         },
    //         success: function(data) {
    //             if (data.status == 'ok') {
    //                 alert(data.msg)
    //                 $('#tr_' + id).remove();
    //             } else {
    //                 alert(data.msg)
    //             }
    //         }
    //     });
    // }
</script>
@endsection