@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Daftar Surat Jalan
                </div>
                <div class="actions">
                    <a href="{{ url('suratjalan/create') }}" class="btn btn-info" type="button">Tambah Data</a>
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
                            <th>Nomor Surat</th>
                            <th>Tanggal Pengiriman Barang</th>
                            <th>Daftar Barang</th>
                            <th>Pembuat Surat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_no_surat_{{ $d->id }}'>{{ $d->no_surat }}</td>
                                <td id='td_tgl_pengiriman_barang_{{ $d->id }}'>
                                    {{ $d->tgl_pengiriman_barang->format('d/m/Y') }}</td>
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
                                                    <h4 class="modal-title">Nomor Surat : {{ $d->no_surat }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Keterangan:</b><p>{{$d->keterangan}}</p>
                                                    <br>
                                                    @foreach ($d->daftar_barang as $key => $item)
                                                        <b>
                                                            <span>=== Barang {{ $key + 1 }} ===</span>

                                                        </b>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Kuantitas</span> : <span>
                                                                {{ number_format($item->pivot->kuantitas) }} {{ $item->satuan }}</span>
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
                                <td class='editable' id='td_status_{{ $d->id }}'>
                                    <select class="form-control status_option" name="status_option"
                                        suratjalanid="{{ $d->id }}">
                                        @foreach (['dalam pengiriman' => 'Dalam Pengiriman', 'sudah diterima' => 'Sudah Diterima'] as $value => $Label)
                                            <option value="{{ $value }}"
                                                {{ $d->status == $value ? 'selected' : '' }}>{{ $Label }}</option>
                                        @endforeach
                                    </select>
                                </td>
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
                    <h4 class="modal-title">Tambah Nota</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('suratjalan') }}" class="form-horizontal" method='POST'>
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nomor Surat Jalan:</label>
                                <input type="text" name="no_surat" class="form-control" id='kuantitas' required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pengiriman Barang:</label>
                                <td>
                                    <div class="input-group input-group-sm date date-picker margin-bottom-5"
                                        data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter" readonly
                                            name="order_date_from" placeholder="Pilih tanggal">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i
                                                    class="fa fa-calendar"></i></button>
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
                                <select class="form-control" name="barang_jadi" id="barang_jadi">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                            </div>
                            <button type="tambah" class="btn btn-success">Tambah ke Tabel</button>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ url('suratjalan') }}" class="btn btn-default"
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
        $('.status_option').change(function() {
            var id_surat_jalan = $(this).attr('suratjalanid');
            var value_change = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('suratjalan.saveDataField') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id_surat_jalan,
                    'fnama': 'status',
                    'value': value_change

                },
                success: function(data) {
                    alert(data.msg)
                }
            });
        });
    </script>
@endsection

@section('initialscript')
    <script>
        var s_id = data.$el[0].id
        var fname = s_id.split('_')[1]
        var id = s_id.split('_')[2]
        $.ajax({
            type: 'POST',
            url: '{{ route('suratjalan.saveDataField') }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'fnama': fname,
                'value': data.content

            },
            success: function(data) {
                alert(data.msg)
            }
        });
    </script>
@endsection
