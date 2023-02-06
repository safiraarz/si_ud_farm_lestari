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
                <i class="fa fa-reorder"></i>Daftar Hasil Produksi
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
                        <th>Nomor SPK</th>
                        <th>Tanggal Pencatatan</th>
                        <th>Nama Barang Jadi</th>
                        <th>Total Hasil Produksi</th>
                        <th>Satuan</th>
                        <th>Daftar Barang</th>
                        <th>Pembuat Surat</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr id='tr_{{$d->id}}'>
                        <td>{{$d->id}}</td>
                        <td id='td_surat_perintah_kerja_{{$d->id}}'>{{$d->surat_perintah_kerja->no_surat}}</td>
                        <td id='td_tgl_pencatatan_{{$d->id}}'>{{$d->tgl_pencatatan}}</td>
                        <td id='td_barang_{{$d->id}}'>{{$d->barang->nama}}</td>

                        <td id='td_total_kuantitas_{{$d->id}}'>{{number_format($d->total_kuantitas)}}</td>
                        <td id='td_satuan_{{$d->id}}'>{{$d->barang->satuan}}</td>
                        <td> <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a>
                            <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$d->surat_perintah_kerja->no_surat}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <b>Kuantitas Reject:</b>
                                            <p>{{number_format($d->kuantitas_reject)}} {{$d->barang->satuan}}</p>
                                            <b>Kuantitas Bersih:</b>
                                            <p>{{number_format($d->kuantitas_bersih)}} {{$d->barang->satuan}}</p>
                                            <b>Keterangan:</b>
                                            <p>{{$d->keterangan}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
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
                <h4 class="modal-title">Tambah Hasil Produksi</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('hasilproduksi.store') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Tanggal Pencatatan:</label>
                            <div>
                                <input type="date" class="form-control input-sm" name="tgl_pencatatan" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat Perintah Kerja:</label>
                            <select class="form-control" name="no_surat_perintah_kerja" id="no_surat_perintah_kerja">
                                <option value="">Silahkan Pilih Nomor Perintah Kerja</option>
                                @foreach ($surat_perintah_kerja as $item)
                                <option value="{{ $item->id }}">{{ $item->no_surat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="selected_bahan_baku" style="display: none;">
                        <div class="form-group"  >
                            <label>Nama Bahan Baku</label>
                            <select class="form-control" name="bahan_baku" id="bahan_baku">

                            </select>
                        </div> 
                       
                        <div class="form-group">
                            <label>Kuantitas Barang Reject:</label>
                            <input type="text" name="input_kn_reject" class="form-control" id='input_kn_reject' required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Kuantitas Barang Bersih:</label>
                            <input type="text" name="input_kn_bersih" class="form-control" id='input_kn_bersih' required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Total Kuantitas:</label>
                            <input type="text" name="input_kn_total" class="form-control" id='input_kn_total' required readonly>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Keterangan:</label>
                            <textarea type="text" class="form-control" name="keterangan" id='keterangan'></textarea>
                        </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('hasilproduksi')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
        @foreach($surat_perintah_kerja as $item)[
            "{{ $item->id }}",
                [
                    @foreach($item->daftar_barang as $barangs)[
                        "{{ $barangs->id }}",
                        "{{ $barangs->nama }}",
                        "{{ $barangs->pivot->harga }}",
                        "{{ $barangs->pivot->kuantitas }}",
                    ],
                    @endforeach
                ]
            ],
            @endforeach
        ];
    $("#input_kn_reject").on('change', function() {
        // alert($("#input_kn_reject").val());
        $("#input_kn_bersih").on('change', function() {
            // alert($("#input_kn_bersih").val());

            var total = parseInt($("#input_kn_reject").val()) + parseInt($("#input_kn_bersih").val());

            $('#input_kn_total').val(total);
        })
    })
    $("#no_surat_perintah_kerja").on('change', function() {
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
                    var barang_pesanan =  '<option value="' + barang_id + '" >' + barang_name + '</option>';
                    $('#bahan_baku').append(barang_pesanan);

                }
            }

        });

    });


    $('#myTable').DataTable();
</script>
@endsection