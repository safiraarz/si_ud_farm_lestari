{{-- cek --}}
@extends('layout.conquer')
@section('content')
    <div class="container">

        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Daftar Nota Pembelian
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
                            <th>Nomor Nota</th>
                            <th>Tanggal Pembuatan Nota</th>
                            <th>Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Cara Bayar</th>
                            <th>Daftar Barang</th>
                            <th>Pembuat Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_no_nota_{{ $d->id }}'>{{ $d->no_nota }}</td>
                                <td id='td_tgl_pembuatan_nota_{{ $d->id }}'>
                                    {{ $d->tgl_pembuatan_nota->format('d/m/Y') }}</td>
                                <td id='td_supplier_{{ $d->id }}'>{{ $d->supplier->nama }}</td>
                                <td id='td_total_harga_{{ $d->id }}'>Rp{{ number_format($d->total_harga, 2) }}</td>
                                <td id='td_cara_bayar_{{ $d->id }}'>{{ $d->cara_bayar }}</td>
                                <td>
                                    <a class="btn btn-default" data-toggle="modal"
                                        href="#detail_{{ $d->id }}">Detail</a>
                                    <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">No Nota : {{ $d->no_nota }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Keterangan:</b>
                                                    <p>{{ $d->keterangan }}</p>
                                                    <br>
                                                    @foreach ($d->barang as $key => $item)
                                                        <b>
                                                            <span>=== Barang {{ $key + 1 }} ===</span>

                                                        </b>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Harga</span> : <span>
                                                                Rp{{ number_format($item->harga, 2) }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Kuantitas</span> : <span>
                                                                {{ number_format($item->pivot->kuantitas) }}
                                                                {{ $item->satuan }}</span>

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
        $("#no_pesanan").on('change', function() {
            $('#bahan_pesanan').html("");
            var notapemesanan = [
                @foreach ($notapemesanan as $item)
                    [
                        "{{ $item->id }}",
                        [
                            @foreach ($supplier as $sup)
                                @if ($item->supplier_id == $sup->id)
                                    "{{ $item->supplier_id }}",
                                    "{{ $sup->nama }}",
                                @endif
                            @endforeach
                        ],
                        [
                            @foreach ($item->barang as $barangs)
                                [
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
            var id_nota_pesanan = $(this).val();
            notapemesanan.forEach(element => {
                if (id_nota_pesanan == element[0]) {
                    // Show Supplier
                    var supplier_html =
                        '<div class="form-group"><label>Nama Supplier</label><select class="form-control" name="supplier_id" id="supplier"  readonly><option value="' +
                        element[1][0] + '" >' + element[1][1] + '</option></select></div>'
                    $('#bahan_pesanan').append(supplier_html);
                    for (let index = 0; index < element[2].length; index++) {
                        const elements = element[2][index];
                        var barang_id = elements[0];
                        var barang_name = elements[1];
                        var harga = elements[2];
                        var kuantitas = elements[3];
                        var barang_pesanan =
                            '<div class="form-group bahan_' + index + '"><label>Bahan ' + parseInt(index +
                                1) + '</label></div> ' +
                            '<div class="form-group"><label>Nama Bahan Baku</label><select class="form-control" name="barang[' +
                            index + '][' + "bahan_baku" + ']" id="bahan_baku"  readonly><option value="' +
                            barang_id + '" >' + barang_name + '</option></select></div></div>' +
                            // '<div class="form-group"><label>Nama Bahan Baku</label><select class="form-control" name="bahan_baku" id="bahan_baku" readonly>@foreach ($supplier as $item)<option value="{{ $item->id }}">{{ $item->nama }}</option>@endforeach</select></div>' +
                            '<div class="form-group"><label>Harga per-satuan</label><input type="text" name="barang[' +
                            index + '][' + "harga" + ']" class="form-control" id="harga" value="' + harga +
                            '" required  readonly></div>' +
                            '<div class="form-group"><label>Kuantitas</label><input type="text" name="barang[' +
                            index + '][' + "kuantitas" + ']" class="form-control" id="kuantitas" value="' +
                            kuantitas + '" required></div>';
                        // alert(barang_pesanan);
                        $('#bahan_pesanan').append(barang_pesanan);

                    }
                }

            });

        });

        document.cookie = "var1=22";

        function getEditForm(id) {
            $.ajax({
                    type: 'POST',
                    url: '{{ route('notapembelian.getEditForm') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': id
                    },
                    success: function(data) {
                        $('#modalContent').html(data.msg)
                    }
                },

            );
        };
    </script>
@endsection
@section('initialscript')
    <script>
        var s_id = data.$el[0].id
        var fname = s_id.split('_')[1]
        var id = s_id.split('_')[2]
        $.ajax({
            type: 'POST',
            url: '{{ route('notapembelian.saveDataField') }}',
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
