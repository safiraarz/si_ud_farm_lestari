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
                <i class="fa fa-reorder"></i>Daftar Pemberian Pakan
            </div>
            <div class="actions">
                <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Data</a>
            </div>
        </div>
        <div class="portlet-body">
            <table id='myTable' class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Pemberian</th>
                        <th>Jenis Pakan</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Flok Tujuan</th>
                        <th>Keterangan</th>
                        <th>Pencatat Transaksi</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td id='td_tgl_pemberian_'>{{$d->tgl_pemberian}}</td>
                        <td id='td_jenis_telur_'>{{$d->barang->nama}}</td>
                        <td id='td_kuantitas'>{{number_format($d->kuantitas)}}</td>
                        <td id='td_satuan'>{{$d->barang->satuan}}</td>
                        <td id='td_flok_tujuan_'>{{$d->flok->nama}}</td>
                        <td id='td_keterangan_'>{{$d->keterangan}}</td>
                        <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
                        <!-- <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm('{{ $d->created_at }}')">EDIT</a>
                    </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    <!-- tambah jadwalpakan -->

    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Tambah Jadwal Pakan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jadwalpakan.store') }}" class="form-horizontal" method='POST'>
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Tanggal Pencatatan</label>
                                <div>
                                    <input type="date" name="tgl_pemberian" class="form-control input-sm" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Pakan Ternak</label>
                                <select class="form-control" name="jenis_pakan" id="jenis_pakan">
                                    @foreach ($barang as $item)
                                    @if ($item->jenis == "Barang Jadi")

                                    <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Asal Flok</label>
                                <select class="form-control" name="asal_flok" id="asal_flok">
                                    @foreach ($flok as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                                </input>
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
        $('#myTable').DataTable();
    </script>
    @endsection