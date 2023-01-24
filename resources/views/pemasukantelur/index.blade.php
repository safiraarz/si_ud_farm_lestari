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
    <h2>Daftar Pemasukan Telur</h2>
    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Barang</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jenis Telur</th>
                    <th>Asal Flok</th>
                    <th>Kuantitas Reject</th>
                    <th>Kuantitas Bersih</th>
                    <th>Total Kuantitas Telur</th>
                    <th>Satuan</th>
                    <th>Tanggal Pencatatan</th>
                    <th>Pencatat Transaksi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td id='td_jenis_telur_'>{{$d->barang->nama}}</td>
                    <td id='td_asal_flok_'>{{$d->flok->nama}}</td>
                    <td id='td_kuantitas_reject_'>{{number_format($d->kuantitas_reject)}}</td>
                    <td id='td_kuantitas_bersih_'>{{number_format($d->kuantitas_bersih)}}</td>
                    <td id='td_total_kuantitas_'>{{number_format($d->total_kuantitas)}}</td>
                    <td id='td_satuan'>{{$d->barang->satuan}}</td>
                    <td id='td_tgl_pencatatan_'>{{$d->tgl_pencatatan}}</td>
                    <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
                    <td>
                        {{-- {{$d->created_at}} --}}
                        {{-- @php
                            $create = strval($d->created_at);
                            $created = str_replace(" ","",$create);
                            echo $created;
                        @endphp --}}
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm('{{ $d->created_at }}')">EDIT</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- tambah pemasukantelur -->

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('pemasukantelur.store') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Jenis Telur</label>
                            <select class="form-control" name="barang_id" id="jenis_telur">
                                <!-- seharusnya dikasih where jenis==barang -->
                                @foreach ($barang as $item)
                                @if ($item->jenis == "Barang Jadi")
                                    
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Asal Flok</label>
                            <select class="form-control" name="flok_id" id="jenis_telur">
                                @foreach ($flok as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas Bersih</label>
                            <input type="text" id="kuantitas_bersih" name="kuantitas_bersih" class="form-control"  required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas Reject</label>
                            <input type="text" id="kuantitas_reject" name="kuantitas_reject" class="form-control"  required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Total Kuantitas</label>
                            <!-- ini seharusnya otomatis penjumlahan kuantitas bersih+reject -->
                            <input type="text" id="total_kuantitas" name="total_kuantitas" class="form-control"  readonly="true">
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="keterangan" type="text" class="form-control" name="keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pencatatan</label>
                            <td>
                                <!-- <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tgl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div> -->
                                <div>
                                    <input type="date" name="tanggal_pencatatan" class="form-control input-sm"required />
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
    // Generate Total 
    $("#kuantitas_bersih").on('change', function () {
        $("#kuantitas_reject").on('change', function () {
            var total = parseInt($("#kuantitas_reject").val()) + parseInt($("#kuantitas_bersih").val());
            // alert(total);
            $('#total_kuantitas').val(total);
        })
    })
    // $('').onChange(function() {
    //         $('#kuantitas_reject').onChange(function() {
    //             var total = $("#kuantitas_reject").val() + $("#kuantitas_bersih").val();
    //             // alert(total);
    //             $('#total_kuantitas').val(total);

           
    //         });
    //     });
    $(document).ready(function() {
        
        if($("#kuantitas_bersih").val() != 0 && $("#kuantitas_reject").val() !=0){
           
        }
    });
    function getEditForm(id) {

        $.ajax({
                type: 'POST',
                url: '{{route("pemasukantelur.getEditForm")}}',
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
    //         url: '{{route("pemasukantelur.saveData")}}',
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
    //         url: '{{route("pemasukantelur.deleteData")}}',
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