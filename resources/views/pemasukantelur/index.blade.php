@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Daftar Pemasukan Telur
                </div>
                <div class="actions">
                    <a href="{{ url('pemasukantelur/create') }}" class="btn btn-info" type="button">Tambah Data</a>
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
                            <th>Tanggal Pencatatan</th>
                            <th>Karantina</th>
                            <th>Afkir</th>
                            <th>Kematian</th>
                            <th>Keterangan</th>
                            <th>Flok Asal</th>
                            <th>Daftar Barang</th>
                            <th>Pencatat Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_tgl_pencatatan_'>{{ $d->tgl_pencatatan->format('d/m/Y') }}</td>
                                <td id='td_karantina_'>{{ $d->karantina }} ekor</td>
                                <td id='td_afkir_'>{{ $d->afkir }} ekor</td>
                                <td id='td_kematian_'>{{ $d->kematian }} ekor</td>
                                <td id='td_keterangan_'>{{ $d->keterangan }}</td>
                                <td id='td_asal_flok_'>{{ $d->flok->nama }}</td>

                                <td>
                                    <a class="btn btn-default edittable" data-toggle="modal"
                                        href="#detail_{{ $d->id }}">
                                        Detail
                                    </a>
                                    <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ $d->tgl_pencatatan }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- {{ $d->barang() }} --}}

                                                    @foreach ($d->daftar_barang as $key => $item)
                                                        <p>
                                                            <span>- Barang {{ $key + 1 }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Kuantitas Bersih</span> : <span>
                                                                {{ $item->pivot->kuantitas_bersih }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Kuantitas Reject</span> : <span>
                                                                {{ $item->pivot->kuantitas_reject }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Total Kuantitas</span> : <span>
                                                                {{ $item->pivot->total_kuantitas }}</span>
                                                        </p>
                                                    @endforeach
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
                                            @if ($item->jenis == 'Barang Jadi')
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Asal Flok</label>
                                    <select class="form-control" name="flok_id" id="jenis_telur">
                                        @foreach ($flok as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kuantitas Bersih</label>
                                    <input type="text" id="kuantitas_bersih" name="kuantitas_bersih" class="form-control"
                                        required>
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label>Kuantitas Reject</label>
                                    <input type="text" id="kuantitas_reject" name="kuantitas_reject" class="form-control"
                                        required>
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label>Total Kuantitas</label>
                                    <input type="text" id="total_kuantitas" name="total_kuantitas" class="form-control"
                                        readonly="true">
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
                                            <input type="date" name="tanggal_pencatatan" class="form-control input-sm"
                                                required />
                                        </div>
                                    </td>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ url('pemasukantelur') }}" class="btn btn-default"
                                        data-dismiss="modal">Cancel</a>
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
            // alert("masuk");
            $.fn.dataTable.ext.search.pop();
            if ($('.date_filter_min').val() != '' && $('.date_filter_max').val() != '') {
                // alert("masuk2");

                min = new Date($('.date_filter_min').val());
                max = new Date($('.date_filter_max').val());
                // alert($('.date_filter_min').val());
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var date = new Date(data[1].split("/")[2] + "-" + data[1].split("/")[1] + "-" + data[1]
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
        // Generate Total 
        $("#kuantitas_bersih").on('change', function() {
            $("#kuantitas_reject").on('change', function() {
                var total = parseInt($("#kuantitas_reject").val()) + parseInt($("#kuantitas_bersih").val());
                $('#total_kuantitas').val(total);
            })
        })

        $(document).ready(function() {

            if ($("#kuantitas_bersih").val() != 0 && $("#kuantitas_reject").val() != 0) {

            }
        });
    </script>
@endsection
