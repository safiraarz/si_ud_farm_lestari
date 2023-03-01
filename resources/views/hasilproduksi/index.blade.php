@extends('layout.conquer')
@section('content')
    <div class="container">
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
                    <form method="post">
                        @csrf
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="container-fluid">
                                    <div class="form-group row">
                                        <label for="date" class="col-form-label col-sm-2">Dari Tanggal</label>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control input-sm date_filter_min"
                                                id="date_filter_min" name="dariTgl" />
                                        </div>
                                        <label for="date" class="col-form-label col-sm-2">Sampai Tanggal</label>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control input-sm date_filter_max"
                                                id="date_filter_max" name="sampaiTgl" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_surat_perintah_kerja_{{ $d->id }}'>
                                    {{ $d->surat_perintah_kerja->no_surat }}</td>
                                <td id='td_tgl_pencatatan_{{ $d->id }}'>{{ $d->tgl_pencatatan->format('d/m/Y') }}
                                </td>
                                <td id='td_barang_{{ $d->id }}'>{{ $d->barang->nama }}</td>

                                <td id='td_total_kuantitas_{{ $d->id }}'>{{ number_format($d->total_kuantitas) }}
                                </td>
                                <td id='td_satuan_{{ $d->id }}'>{{ $d->barang->satuan }}</td>
                                <td> <a class="btn btn-default" data-toggle="modal"
                                        href="#detail_{{ $d->id }}">Detail</a>
                                    <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">ID: {{ $d->id }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Keterangan:</b>
                                                    <p>{{ $d->keterangan }}</p>
                                                    <b>Kuantitas Reject:</b>
                                                    <p>{{ number_format($d->kuantitas_reject) }} {{ $d->barang->satuan }}
                                                    </p>
                                                    <b>Kuantitas Bersih:</b>
                                                    <p>{{ number_format($d->kuantitas_bersih) }} {{ $d->barang->satuan }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td id='td_pengguna_{{ $d->id }}'>{{ $d->pengguna->nama }}</td>
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
                                <select class="form-control" name="no_surat_perintah_kerja" id="no_surat_perintah_kerja" required>
                                    <option value="">===Pilih Nomor SPK===</option>
                                    @foreach ($surat_perintah_kerja as $item)
                                        <option value="{{ $item->id }}">{{ $item->no_surat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="selected_barang" style="display: none;">
                                <div class="form-group">
                                    <label>Nama Bahan Baku</label>
                                    <select class="form-control" name="barang" id="barang" required>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label >Kuantitas Barang Reject <span id="kuantitas_reject"></span> :</label>
                                    <input type="number" min="0" max="99999999999" name="input_kn_reject" class="form-control" id='input_kn_reject'
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Kuantitas Barang Bersih <span id="kuantitas_bersih"></span> :</label>
                                    <input type="number" min="0" max="99999999999" name="input_kn_bersih" class="form-control"
                                        id='input_kn_bersih' required>
                                </div>
                                <div class="form-group">
                                    <label>Total Kuantitas <span id="kuantitas_total"></span> :</label>
                                    <input type="number" name="input_kn_total" class="form-control" id='input_kn_total'
                                        required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan:</label>
                                    <textarea type="text"  maxlength="150" class="form-control" name="keterangan" id='keterangan'></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ url('hasilproduksi') }}" class="btn btn-default"
                                    data-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        var table = $('#myTable').DataTable({
            order: [
                [0, 'desc']
            ]
        });
        $('.date_filter_min, .date_filter_max').on('change', function() {
            $.fn.dataTable.ext.search.pop();
            if ($('.date_filter_min').val() != '' && $('.date_filter_max').val() != '') {

                min = new Date($('.date_filter_min').val());
                max = new Date($('.date_filter_max').val());
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var date = new Date(data[2].split("/")[2] + "-" + data[2].split("/")[1] + "-" + data[2]
                            .split("/")[0]);
                        if ((min === null && max === null) || (min === null && date <= max) || (min <= date &&
                                max === null) || (min <= date && date <= max)) {
                            return true;
                        }
                        return false;
                    });
            }
            table.draw();
        });
        var spkbarang = [
            @foreach ($surat_perintah_kerja as $item)
                [
                    "{{ $item->id }}",
                    [
                        @foreach ($item->daftar_barang as $barangs)
                            [
                                "{{ $barangs->id }}",
                                "{{ $barangs->nama }}",
                                "{{ $barangs->pivot->kuantitas }}",
                                "{{ $barangs->satuan }}",

                            ],
                        @endforeach
                    ]
                ],
            @endforeach
        ];
        $("#input_kn_reject").on('change', function() {
            $("#input_kn_bersih").on('change', function() {
                var total = parseInt($("#input_kn_reject").val()) + parseInt($("#input_kn_bersih").val());
                $('#input_kn_total').val(total);
            })
        })
        $("#no_surat_perintah_kerja").on('change', function() {
            $("#selected_barang").show();
            $('#barang').html("");
            $('#barang').append( '<option>== Pilih Barang ==</option>');
            var id_spk = $(this).val();
            spkbarang.forEach(element => {
                if (id_spk == element[0]) {
                    // Show Supplier
                    for (let index = 0; index < element[1].length; index++) {
                        const elements = element[1][index];
                        var barang_id = elements[0];
                        var barang_name = elements[1];
                        var barang_satuan = elements[3];

                        var barang_pesanan = '<option satuan="'+barang_satuan+'" value="' + barang_id + '" >' + barang_name +
                            '</option>';
                        $('#barang').append(barang_pesanan);

                    }
                }

            });

        });
        $("#barang").on('change', function() {
            var satuan = '( '+$(this).find(':selected').attr('satuan')+' )';
            $('#kuantitas_reject').html(satuan);
            $('#kuantitas_total').html(satuan);
            $('#kuantitas_bersih').html(satuan);



        });
    </script>
@endsection
