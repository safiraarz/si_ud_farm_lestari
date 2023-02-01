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
                <i class="fa fa-reorder"></i>Daftar Pemasukan Telur
            </div>
            <div class="actions">
                <a href="{{url('pemasukantelur/create')}}" class="btn btn-info" type="button">Tambah Data</a>
            </div>
        </div>
        <div class="portlet-body">
            <table id='myTable' class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Pencatatan</th>
                        <th>Karantina</th>
                        <th>Afkir</th>
                        <th>Kematian</th>
                        <th>Keterangan</th>
                        <th>Flok Asal</th>
                        <th>Daftar Barang</th>
                        <th>Pencatat Transaksi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr id='tr_{{$d->id}}'>
                        <td>{{$d->id}}</td>
                        <td id='td_tgl_pencatatan_'>{{$d->tgl_pencatatan}}</td>
                        <td id='td_karantina_'>{{$d->karantina}} ekor</td>
                        <td id='td_afkir_'>{{$d->afkir}} ekor</td>
                        <td id='td_kematian_'>{{$d->kematian}} ekor</td>
                        <td id='td_keterangan_'>{{$d->keterangan}}</td>
                        <td id='td_asal_flok_'>{{$d->flok->nama}}</td>

                        <td>
                            {{-- <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a> --}}
                            <a class="btn btn-default edittable" data-toggle="modal" href="#detail_{{$d->id}}">
                                Detail
                            </a>
                            {{-- {{ $ }} --}}
                            <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$d->tgl_pencatatan}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{-- {{ $d->barang() }} --}}
                                            
                                            @foreach ($d->daftar_barang as $key =>$item)
                                            <p>
                                                <span>- Barang {{ $key+1 }}</span>

                                            </p>
                                            <p>
                                                <span>Nama Barang</span> : <span> {{$item->nama}}</span>

                                            </p>
                                            <p>
                                                <span>Kuantitas Bersih</span> : <span> {{$item->pivot->kuantitas_bersih}}</span>

                                            </p>
                                            <p>
                                                <span>Kuantitas Reject</span> : <span> {{ $item->pivot->kuantitas_reject }}</span>

                                            </p>
                                            <p>
                                                <span>Total Kuantitas</span> : <span> {{ $item->pivot->total_kuantitas }}</span>
                                            </p>
                                            @endforeach
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
                                <input type="text" id="kuantitas_bersih" name="kuantitas_bersih" class="form-control" required>
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas Reject</label>
                                <input type="text" id="kuantitas_reject" name="kuantitas_reject" class="form-control" required>
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Total Kuantitas</label>
                                <input type="text" id="total_kuantitas" name="total_kuantitas" class="form-control" readonly="true">
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea id="keterangan" type="text" class="form-control" name="keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pencatatan</label>
                                <td>
                                    <div>
                                        <input type="date" name="tanggal_pencatatan" class="form-control input-sm" required />
                                    </div>
                                </td>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{url('pemasukantelur')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
        // Generate Total 
        $("#kuantitas_bersih").on('change', function() {
            $("#kuantitas_reject").on('change', function() {
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

            if ($("#kuantitas_bersih").val() != 0 && $("#kuantitas_reject").val() != 0) {

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
        $('#myTable').DataTable();
    </script>
    @endsection