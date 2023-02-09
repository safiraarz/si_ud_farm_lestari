@extends('layout.conquer')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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
                            <th>Tanggal Pemberian</th>
                            <th>Jenis Pakan</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Flok Tujuan</th>
                            <th>Keterangan</th>
                            <th>Pencatat Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td id='td_tgl_pemberian_'>{{ $d->tgl_pemberian->format('d/m/Y') }}</td>
                                <td id='td_jenis_telur_'>{{ $d->barang->nama }}</td>
                                <td id='td_kuantitas'>{{ number_format($d->kuantitas) }}</td>
                                <td id='td_satuan'>{{ $d->barang->satuan }}</td>
                                <td id='td_flok_tujuan_'>{{ $d->flok->nama }}</td>
                                <td id='td_keterangan_'>{{ $d->keterangan }}</td>
                                <td id='td_pengguna_{{ $d->id }}'>{{ $d->pengguna->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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
                                            @if ($item->jenis == 'Barang Jadi')
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
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
                                    <label>Kuantitas</label>
                                    <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id='keterangan' required>
                                    </input>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ url('mps') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
            function getEditForm(id) {
                $.ajax({
                        type: 'POST',
                        url: '{{ route('jadwalpakan.getEditForm') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'id': id
                        },
                        success: function(data) {
                            $('#modalContent').html(data.msg)
                        }
                    },

                );
            }

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
        </script>
    @endsection
