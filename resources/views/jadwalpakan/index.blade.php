@extends('layout.conquer')
@section('content')
    <div class="container">
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
                            <th>ID</th>
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
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_tgl_pemberian_'>{{ $d->tgl_pemberian->format('d/m/Y') }}</td>
                                <td id='td_jenis_pakan_'>{{ $d->barang->nama }}</td>
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
                                    <select class="form-control" name="jenis_pakan" id="jenis_pakan" required>
                                        <option value="">== Pilih Pakan Ternak ==</option>
                                        @foreach ($barang as $item)
                                            @if ($item->jenis == 'Barang Jadi')
                                                <option value="{{ $item->id }}"
                                                    ready="{{ $item->kuantitas_stok_ready }}" satuan="{{ $item->satuan }}">{{ $item->nama }} (Stok:
                                                    {{ number_format($item->kuantitas_stok_ready) }} {{ $item->satuan }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Asal Flok</label>
                                    <select class="form-control" name="asal_flok" id="asal_flok">
                                        <option value="">== Pilih Flok ==</option>
                                        @foreach ($flok as $item)
                                            <option value="{{ $item->id }}" populasi="{{ $item->populasi }}" kebutuhan_pakan="{{ $item->kebutuhan_pakan }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" id="satuan" class="satuan">Kuantitas ()</label>
                                    <input type="hidden" min="1" name="kuantitas_max" class="form-control"
                                        id='kuantitas_max' required>
                                    <input type="number" min="1" name="kuantitas" class="form-control"
                                        id='kuantitas' required>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea type="text" maxlength="150" name="keterangan" class="form-control" id='keterangan'></textarea>
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
            // $("#kuantitas").on('change', function() {
        //     var kuantitas_max = $(this).attr('max');

            //     var kuantitas = $(this).val();

            //     if (kuantitas <= 0) {
            //         $(this).val(kuantitas_max);
            //     } else if (kuantitas_max < kuantitas) {
            //         $(this).val(kuantitas_max);
            //     }

            // });
            $('#asal_flok').on('change', function() {
                var kebutuhan_pakan = $('#asal_flok').find(':selected').attr('kebutuhan_pakan');
                var populasi = $('#asal_flok').find(':selected').attr('populasi');
                var rekomendasi = Math.ceil( ( parseFloat(populasi) * parseFloat(kebutuhan_pakan) ) /1000  );
                $("#kuantitas").val(rekomendasi);
                var kuantitas_bahan_baku_ready = $('#jenis_pakan').find(':selected').attr('ready');
                $("#kuantitas_max").val(kuantitas_bahan_baku_ready);
               
            });
            // $("#jenis_pakan").on('change', function() {
            //     var satuan = $(this).find(':selected').attr('satuan');
            //     $('.satuan').html("Kuantitas (" + satuan + ")");
            //     var kuantitas_bahan_baku_ready = $(this).find(':selected').attr('ready');
            //     // $("#kuantitas").attr("max", kuantitas_bahan_baku_ready);
            //     $("#kuantitas").val(kuantitas_bahan_baku_ready);
            //     $("#kuantitas_max").val(kuantitas_bahan_baku_ready);

            //     // alert(kuantitas_bahan_baku_ready);

            // });
            // $("#kuantitas").on('change', function() {
            //     var max_value = $("#kuantitas_max").val();
            //     var kuantitas = $(this).val();
            //     if(kuantitas > max_value) {
            //         $('#kuantitas').val(max_value);
            //     }

            // });

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
                            var date = new Date(data[1].split("/")[2] + "-" + data[1].split("/")[1] + "-" + data[1]
                                .split("/")[1]);
                          
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
