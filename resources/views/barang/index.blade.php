@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Master Barang
                </div>
                <div class="actions">
                    <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Data</a>
                </div>
            </div>
            <div class="portlet-body">
                <table table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Harga per-Satuan</th>
                            <th>Lead Time</th>
                            <th>Total Kuantitas Stok</th>
                            <th>Satuan</th>
                            <th>Detail Kuantitas</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_nama_{{ $d->id }}'>{{ $d->nama }}</td>
                                <td id='td_jenis_{{ $d->id }}'>{{ $d->jenis }}</td>
                                <td id='td_harga_{{ $d->id }}'>Rp{{ number_format($d->harga, 2) }}</td>
                                <td id='td_lead_time_{{ $d->id }}'>{{ $d->lead_time }}</td>
                                <td id='td_total_kuantitas_stok_{{ $d->id }}'>
                                    {{ number_format($d->total_kuantitas_stok) }}</td>
                                <td id='td_satuan{{ $d->id }}'>{{ $d->satuan }}</td>
                                <td> <a class="btn btn-default" data-toggle="modal"
                                        href="#detail_{{ $d->id }}">Detail</a>
                                    <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ $d->nama }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Kuantitas Stok on Order Supplier:</b>
                                                    <p>{{ number_format($d->kuantitas_stok_onorder_supplier) }}
                                                        {{ $d->satuan }}</p>
                                                    <b>Kuantitas Stok on Order Produksi:</b>
                                                    <p>{{ number_format($d->kuantitas_stok_onorder_produksi) }}
                                                        {{ $d->satuan }}</p>
                                                    <b>Kuantitas Stok Pengaman:</b>
                                                    <p>{{ number_format($d->kuantitas_stok_pengaman) }}
                                                        {{ $d->satuan }}</p>
                                                    <b>Kuantitas Stok Ready:</b>
                                                    <p>{{ number_format($d->kuantitas_stok_ready) }} {{ $d->satuan }}
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
                                <td>
                                    <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs'
                                        onclick="getEditForm({{ $d->id }})">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs'
                                        onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{ $d->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- tambah barang -->

    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Tambah Barang</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" maxlength="45" name="nama" class="form-control"
                                    placeholder="Masukkan nama barang" required>
                            </div>
                            <div class='form-group'>
                                <label>Jenis Barang</label>
                                <select class='form-control select2' name='jenis' required>
                                    <option value="" selected>
                                        ====Pilih jenis barang===
                                    </option>
                                    <option value="Barang Jadi">Barang Jadi</option>
                                    <option value="Bahan Baku">Bahan Baku</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas Stok on Order Supplier</label>
                                <input type="number" min="0" max="99999999999"
                                    name="kuantitas_stok_onorder_supplier" id="kuantitas_supplier" class="form-control"
                                    placeholder="Masukkan kuantitas stok yang sedang dipesan ke supplier" required>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas Stok on Order Produksi</label>
                                <input type="number" min="0" max="99999999999"
                                    name="kuantitas_stok_onorder_produksi" id="kuantitas_produksi" class="form-control"
                                    placeholder="Masukkan kuantitas stok yang sedang diproduksi" required>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas Stok Pengaman</label>
                                <input type="number" min="0" max="99999999999" name="kuantitas_stok_pengaman"
                                    id="kuantitas_pengaman" class="form-control"
                                    placeholder="Masukkan kuantitas stok pengaman" required>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas Stok Ready</label>
                                <input type="number" min="0" max="99999999999" name="kuantitas_stok_ready"
                                    id="kuantitas_ready" class="form-control"
                                    placeholder="Masukkan kuantitas stok yang ready di gudang" required>
                            </div>
                            <div class="form-group">
                                <label>Total Kuantitas Stok</label>
                                <input type="number" min="0" max="99999999999" name="total_kuantitas_stok"
                                    id="total_kuantitas" class="form-control" placeholder="Total kuantitas stok"
                                    readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Harga per-Satuan</label>
                                <input type="number" min="0" max="99999999999" name="harga"
                                    class="form-control" placeholder="Masukkan harga per satuan" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <select class='form-control select2' name='satuan' required>
                                    <option value="" selected>
                                        ====Pilih satuan barang===
                                    </option>
                                    <option value="kg">kg</option>
                                    <option value="gr">gr</option>
                                    <option value="sak">sak</option>
                                    <option value="pc">pc</option>
                                    <option value="ekor">ekor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lead Time</label>
                                <input type="number" min="0" max="100" name="lead_time"
                                    class="form-control" placeholder="Masukkan lead time" required>
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
                url: '{{ route('barang.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            }, );
        }

        $("#kuantitas_supplier").on('change', function() {
            $("#kuantitas_produksi").on('change', function() {
                $("#kuantitas_ready").on('change', function() {
                    var total = parseInt($("#kuantitas_supplier").val()) + parseInt($(
                            "#kuantitas_produksi").val()) +
                        parseInt($("#kuantitas_pengaman").val()) + parseInt($("#kuantitas_ready")
                            .val());
                    $('#total_kuantitas').val(total);
                })
            })
        });

        function saveDataUpdateTD(id) {
            var eNama = $('#eNama').val();
            var eHarga = $('#eHarga').val();
            var eLeadTime = $('#eLeadTime').val();
            var eKuantitas_stok_onorder_supplier = $('#eKuantitas_stok_onorder_supplier').val();
            var eKuantitas_stok_onorder_produksi = $('#eKuantitas_stok_onorder_produksi').val();
            var eKuantitas_stok_pengaman = $('#eKuantitas_stok_pengaman').val();
            var eKuantitas_stok_ready = $('#eKuantitas_stok_ready').val();
            var eTotal_kuantitas_stok = $('#eTotal_kuantitas_stok').val();
            var eJenis = $('#eJenis').val();
            var eSatuan = $('#eSatuan').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('barang.saveData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'nama': eNama,
                    'harga': eHarga,
                    'lead_time': eLeadTime,
                    'kuantitas_stok_onorder_supplier': eKuantitas_stok_onorder_supplier,
                    'kuantitas_stok_onorder_produksi': eKuantitas_stok_onorder_produksi,
                    'kuantitas_stok_pengaman': eKuantitas_stok_pengaman,
                    'kuantitas_stok_ready': eKuantitas_stok_ready,
                    'total_kuantitas_stok': eTotal_kuantitas_stok,
                    'jenis': eJenis,
                    'satuan': eSatuan,
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#td_nama_' + id).html(eNama);
                        $('#td_harga_' + id).html(eHarga);
                        $('#td_lead_time_' + id).html(eLead_time);
                        $('#td_kuantitas_stok_onorder_supplier_' + id).html(eKuantitas_stok_onorder_supplier);
                        $('#td_kuantitas_stok_onorder_produksi_' + id).html(eKuantitas_stok_onorder_produksi);
                        $('#td_kuantitas_stok_pengaman_' + id).html(eKuantitas_stok_pengaman);
                        $('#td_kuantitas_stok_ready_' + id).html(eKuantitas_stok_ready);
                        $('#td_total_kuantitas_stok_' + id).html(eTotal_kuantitas_stok);
                        $('#td_jenis_' + id).html(eJenis);
                        $('#td_satuan' + id).html(eSatuan);
                    }
                }
            });
        }

        function deleteDataRemoveTR(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('barang.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#tr_' + id).remove();
                    } else {
                        alert(data.msg)
                    }
                }
            });
        }
        $('#myTable').DataTable();
    </script>
@endsection
