@extends('layout.conquer')

@section('content')
    <div class="form-group margin-right-10">
        <label>Pilih Jenis Nota</label>
        <select class="form-control" name="pilih_nota" id="pilih_nota">
            <option value="nota_pemesanan">Nota Pemesanan</option>
            <option value="nota_pembelian">Nota Pembelian</option>
            <option value="nota_penjualan">Nota Penjualan</option>
        </select>
    </div>

    {{-- Pemesanan --}}
    <section class="mt-3 margin-right-10" id="nota_pemesanan_section">
        <div class="">
            <div class="row">
                <div class="col-md-5  mt-4 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>
                                    <select name="supplier" id="supplier" class="form-control">
                                        @foreach ($supplier as $row)
                                            <option id={{ $row->id }} value="{{ $row->nama }}"
                                                class=" barang custom-select">
                                                {{ $row->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:35%">Nama Barang</th>
                                <th style="width:30%">Kuantitas <label for="" id="satuan_pesan"
                                        class="satuan_pesan">()</label></th>
                                <th style="width:35%">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang" class="form-control barang">
                                        @foreach ($barang as $row)
                                            <option id={{ $row->id }} value="{{ $row->nama }}"
                                                harga="{{ $row->harga }}" satuan="{{ $row->satuan }}"
                                                class="barang custom-select">
                                                {{ $row->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                {{-- pengecekkan max value --}}
                                <td>
                                    <input type="number" id="kuantitas" min="0" max="99999999999" value="0"
                                        class="form-control kuantitas" required>
                                </td>
                                <td>
                                    <input type="number" id="harga" min="0" max="99999999999" value="0"
                                        class="form-control harga" required>
                                </td>
                            </tr>
                            <tr>
                                <td><button id="tambah_pemesanan" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div role="alert" id="errorMsg" class="mt-5">
                    </div>
                </div>

                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('notapemesanan.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <input type="hidden" name="jenis_nota" value="nota_pemesanan">
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Nota Pemesanan</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Nota</span> : <span id="no_nota_span">{{ $no_nota_pemesanan }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>Tanggal Transaksi</span> : <span
                                        id="tgl_transaksi_span">{{ $date_now }}</span>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <span>Nama Supplier</span> : <span id="supplier_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Nama Barang</th>
                                            <th style="width: 20%">Kuantitas</th>
                                            <th style="width: 7%">Satuan</th>
                                            <th style="width: 20%">Harga</th>
                                            <th style="width: 25%">Total</th>
                                            <th style="width: 7%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new">
                                    </tbody>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td class="text-right text-dark">
                                            <h5><strong>Sub Total: Rp </strong></h5>
                                        </td>
                                        <td class="text-left text-dark">
                                            <input type="hidden" name="total_harga" id="total_harga">
                                            <h5> <strong><span id="subTotal"></strong></h5>
                                        </td>
                                        <td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <td><button id="proses" class="btn btn-success">Proses</button></td>
                                {{-- <button type="button" class="btn btn-succes delete_barang">Proses</button> --}}
                            </div>
                        </div>
                    </form>
                </div>

            </div>
    </section>

    {{-- Pembelian --}}
    <section class=" mt-3 margin-right-10" id="nota_pembelian_section" style="display: none;">
        <div class="">
            <div class="row">
                <div class="col-md-5 mt-5 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        @csrf
                        <thead>
                            <tr>
                                <th style="width:100%">No. Nota Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="no_pesanan_pembelian" id="no_pesanan_pembelian">
                                        <option value="">==Pilih No. Pemesanan==</option>
                                        @foreach ($notapemesanan as $item)
                                            @if ($item->status == 'dalam proses')
                                                <option value="{{ $item->id }}">{{ $item->no_nota }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        @csrf
                        <thead>
                            <tr>
                                <th style="width:40%">Cara Bayar</th>
                                <th style="width:60%">Kategori Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class='form-control select2' id='cara_bayar' name='cara_bayar'>
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="daftar_akun" id="daftar_akun">
                                        @foreach ($akun as $item)
                                            @if ($item->jenis_akun == 'aset' && $item->no_akun != 000 && $item->no_akun != 101 && $item->no_akun != 102)
                                                <option value="{{ $item->no_akun }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <tbody>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea type="text" maxlength="150" id="keterangan_pembelian" class="form-control"></textarea>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div role="alert" id="errorMsg" class="mt-5">
                    </div>
                </div>

                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form id="form_pembelian" action="{{ route('notapembelian.store') }}" method="post"
                        enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" id="cara_bayar_form" name="cara_bayar">
                        <input type="hidden" id="ketegori_nota_form" name="ketegori_nota">
                        <input type="hidden" id="keterangan_pembelian_form" name="keterangan_pembelian">

                        <div class="p-4">
                            <div class="text-center">
                                <h4>Nota Pembelian</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Nota</span> : <span id="no_nota_span">{{ $no_nota_pembelian }}</span>
                                    <input type="hidden" name="no_nota" class="form-control"
                                        value="{{ $no_nota_pembelian }}">
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" value="{{ $date_now }}" name="tanggal_pembuatan_nota"
                                    class="form-control input-sm" required />
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>Tanggal Transaksi</span> : <span
                                        id="tgl_transaksi_span">{{ $date_now }}</span>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <span>Nama Supplier</span> : <span id="supplier_span_pem"></span>
                                </div>
                            </div>
                            <div class="row" id="bahan_pesanan">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Nama Barang</th>
                                            <th style="width: 20%">Kuantitas</th>
                                            <th style="width: 7%">Satuan</th>
                                            <th style="width: 20%">Harga</th>
                                            <th style="width: 25%">Total</th>
                                            <th style="width: 7%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new__">
                                    </tbody>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td class="text-right text-dark">
                                            <h5><strong>Sub Total: Rp </strong></h5>
                                        </td>
                                        <td class="text-left text-dark">
                                            <input type="hidden" name="total_harga" id="total_harga_Pembelian">
                                            <h5> <strong><span id="subTotal_Pembelian"></strong></h5>
                                        </td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <td><button id="proses" class="btn btn-success">Proses</button></td>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
    </section>

    {{-- Penjualan --}}
    <section class="mt-3 margin-right-10" id="nota_penjualan_section" style="display: none;">
        <div class="">
            <div class="row">
                <div class="col-md-5 mt-5 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:35%">Customer</th>
                                <th style="width:30%">Cara Bayar</th>
                                <th style="width:35%">Kategori Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="customer" id="customer" class="form-control">
                                        @foreach ($customer as $row)
                                            <option id={{ $row->id }} value="{{ $row->nama }}"
                                                class=" barang custom-select">
                                                {{ $row->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class='form-control select2' id='cara_bayar_penjualan'>
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="daftar_akun" id="daftar_akun_penjualan">
                                        @foreach ($akun as $item)
                                            @if ($item->jenis_akun == 'pendapatan')
                                                <option value="{{ $item->no_akun }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <tbody>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea type="text" maxlength="150" id="keterangan_penjualan" class="form-control"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:35%">Nama Barang</th>
                                <th style="width:30%">Kuantitas <label for="" id="satuan_jual"
                                        class="satuan_jual">()</label></th>
                                <th style="width:35%">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang_penjualan" class="form-control barang">
                                        @foreach ($barang as $row)
                                            @if ($row->jenis == 'Barang Jadi')
                                                <option id={{ $row->id }} value="{{ $row->nama }}"
                                                    harga="{{ $row->harga }}" satuan="{{ $row->satuan }}"
                                                    class="barang custom-select"
                                                    ready="{{ $row->kuantitas_stok_ready }}">
                                                    {{ $row->nama }} (Stok:
                                                    {{ number_format($row->kuantitas_stok_ready) }} {{ $row->satuan }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas_penjualan" min="0" value="0"
                                        max="9999999999" class="form-control kuantitas">
                                </td>
                                <td>
                                    <input type="number" id="harga_penjualan" min="0" max="99999999999"
                                        value="0" class="form-control harga">
                                </td>
                            </tr>
                            <tr>
                                <td><button id="tambah_penjualan" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div role="alert" id="errorMsg" class="mt-5">
                        <!-- Error msg  -->
                    </div>
                </div>

                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('notapenjualan.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <input type="hidden" id="cara_bayar_form_penjualan" name="cara_bayar">
                        <input type="hidden" id="ketegori_nota_form_penjualan" name="ketegori_nota">
                        <input type="hidden" id="keterangan_penjualan_form" name="keterangan_penjualan">
                        {{-- <input type="hidden" name="no_nota_penjualan" value="{{ $no_nota_penjualan }}">
                    <input type="hidden" name="tanggal_penjualan" value="{{ $date_now }}"> --}}
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Nota Penjualan</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Nota</span> : <span
                                        id="no_nota_penjualan_span">{{ $no_nota_penjualan }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>Tanggal Transaksi</span> : <span
                                        id="tgl_transaksi_penjualan_span">{{ $date_now }}</span>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <span>Customer</span> : <span id="customer_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill_penjualan" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:20%">Nama Barang</th>
                                            <th style="width:20%">Kuantitas</th>
                                            <th style="width:7%">Satuan</th>
                                            <th style="width:20%">Harga</th>
                                            <th style="width:25%">Total</th>
                                            <th style="width:7%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new_penjualan">
                                    </tbody>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td class="text-right text-dark">
                                            <h5><strong>Sub Total: Rp </strong></h5>
                                        </td>
                                        <td class="text-left text-dark">
                                            <input type="hidden" name="total_harga_penjualan"
                                                id="total_harga_penjualan">
                                            <h5> <strong><span id="subTotal_penjualan"></strong></h5>
                                        </td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <td><button id="proses" class="btn btn-success">Proses</button></td>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <div role="alert" id="errorMsg" class="mt-5 errorMsg">
        <!-- Error msg  -->
    </div>
@endsection

@section('javascript')
    <script>
        //cek satuan
        $('#barang_penjualan').on('change', function() {
            var satuan_jual = $(this).find(':selected').attr('satuan');
            $('.satuan_jual').html("(" + satuan_jual + ")");
        });

        //cek satuan beli
        $('#barang').on('change', function() {
            var satuan_pesan = $(this).find(':selected').attr('satuan');
            $('.satuan_pesan').html("(" + satuan_pesan + ")");
        });

        $("#pilih_nota").on('change', function() {
            var pilihan = $(this).val();
            if (pilihan == "nota_pembelian") {
                $("#nota_pembelian_section").css("display", "");
                $("#nota_pemesanan_section").css("display", "none");
                $("#nota_penjualan_section").css("display", "none");
            } else if (pilihan == "nota_pemesanan") {
                $("#nota_pemesanan_section").css("display", "");

                $("#nota_pembelian_section").css("display", "none");
                $("#nota_penjualan_section").css("display", "none");

            } else {
                $("#nota_pembelian_section").css("display", "none");
                $("#nota_pemesanan_section").css("display", "none");
                $("#nota_penjualan_section").css("display", "");
            }
        });
        $('.barang').change(function() {
            var ids = $(this).find(':selected').attr('harga');
            $('.harga').val(ids);
        });

        // Pemesanan

        var count = 1;
        var total_pesanan = 0;
        var subTotal_pesanan = 0;

        function isEmpty(el) {
            return !$.trim(el.html())
        }

        function deleteDataPemesanan(id) {
            $('#row_' + id).html("");
            harga = $('#row_' + id).attr("harga");
            sub_new = parseInt(subTotal_pesanan) - parseInt(harga);
            // alert(sub_new);
            subTotal_pesanan = sub_new;
            var totalPayment = parseFloat(subTotal_pesanan);
            $('#subTotal').text(thousands_separators(totalPayment));
            $('#total_harga').val(totalPayment);
        };
        $('#tambah_pemesanan').on('click', function() {
            $("#supplier").disable = true;
            var name = $('#barang').val();
            var kuantitas = $('#kuantitas').val();
            var harga = $('#harga').val();
            var satuan = $('#satuan').val();
            var no_nota = $('#no_nota_span').text();
            var tgl_transaksi = $('#tgl_transaksi_span').text();
            var supplier = $('#supplier').val();
            if (parseInt(kuantitas) <= 0 || kuantitas == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);

            } else if (parseInt(harga) <= 0 || harga == '' || harga.length > 11) {
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else if (parseInt(kuantitas) <= 0 || kuantitas == '' || kuantitas.length > 11) {
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {

                // $('#no_nota_span').html(no_nota);
                // $('#tgl_transaksi_span').html(tgl_transaksi);
                $('#supplier_span').html(supplier);
                var id_supplier = $('#supplier').find(':selected').attr('id');

                var notainput = '<input type="hidden" name="no_nota" value=' + no_nota + '> ' +
                    '<input type="hidden" name="tgl_transaksi" value=' + tgl_transaksi + '> ' +
                    '<input type="hidden" name="supplier_id" value=' + id_supplier + '> ';
                $('#new').append(notainput);
                var total_pesanan = harga * kuantitas;

                subTotal_pesanan += parseInt(total_pesanan);
                var satuan = $('#barang').find(':selected').attr('satuan');
                var id_barang = $('#barang').find(':selected').attr('id');
                $("#receipt_bill").each(function() {
                    var table = '<tr class="list" id="row_' + id_barang + '" harga="' + total_pesanan +
                        '"><td>' +
                        name +
                        '<input type="hidden" name="barang[' + count + '][' + "id_barang" + ']" value=' +
                        id_barang + '></td><td>' +
                        '<p id="label_kuantitas_' + id_barang + '">' + thousands_separators(kuantitas) +
                        '</p>' +
                        '<input id="form_kuantitas_' + id_barang + '" type="hidden" name="barang[' +
                        count + '][' + "kuantitas" + ']" value=' + kuantitas +
                        '></td><td>' + satuan +
                        '</td><td>' + thousands_separators(harga) + '<input type="hidden" name="barang[' +
                        count + '][' +
                        "harga_barang" + ']" value=' + harga +
                        '></td><td ><strong id="label_total_' + id_barang + '"><input id="form_total_' +
                        id_barang + '" type="hidden" id="total" value="' + total_pesanan + '">' +
                        thousands_separators(total_pesanan) +
                        '</strong></td>' +
                        '<td>' +
                        '<a class="btn btn-danger barang_delete" onclick="deleteDataPemesanan(' +
                        id_barang +
                        ')"><i class="fa fa-trash-o"></i></a><td>' +
                        '</tr>';

                    var id_row = '#row_' + id_barang;
                    if (isEmpty($(id_row))) {
                        $('#new').append(table);
                    } else {
                        // var  = '#label_kuantitas_'+id_barang;
                        var kuantitas_lama = $('#form_kuantitas_' + id_barang).val();
                        var kuantias_baru = parseInt(kuantitas_lama) + parseInt(kuantitas);
                        $('#label_kuantitas_' + id_barang).text(kuantias_baru);
                        $('#form_kuantitas_' + id_barang).val(kuantias_baru);
                        var total = harga * kuantias_baru;
                        $('#label_total_' + id_barang).html(thousands_separators(total));
                        $('#form_total_' + id_barang).val(total);
                    }
                    var totalPayment = parseFloat(subTotal_pesanan);
                    $('#subTotal').text(thousands_separators(totalPayment));
                    // alert(t);
                    $('#total_harga').val(totalPayment); // Showing using ID 

                });
                count++;
            }
        });

        function maxminvalue(jenis, idx, value_) {
            var id = jenis + "_" + idx;
            var valueset = $("#" + id).val();
            if (valueset.length > 9 || valueset <= 0) {
                $("#" + id).val(value_);
            }
        }

        function deleteDataPembelian(id) {
            $('#row_' + id).html("");
            harga = $('#row_' + id).attr("harga");
            sub_new = parseInt(subTotal_pesanan) - parseInt(harga);
            subTotal_pesanan = sub_new;
            var totalPayment = parseFloat(subTotal_pesanan);
            $('#subTotal').text(thousands_separators(totalPayment));
            $('#total_harga').val(totalPayment);
        };
        $("#form_pembelian").on('submit', function() {
            alert("test");
            // var name = $.trim($('#log').val());
            $('.harga_pembelian').each(function() {
                var harga = Number($(this).val()) || 0;
                alert(harga);
                if (harga.length > 9) {

                    return false;
                }
            });
        });


        function findTotalPembelian() {
            var harga = 0;
            var kuantitas = 0;
            var total_item = 0;
            var total = 0;
            var i = 0;
            $('.harga_pembelian').each(function() {
                // harga = Number($(this).val()) || 0;
                // $('.kuantitas_pembelian').each(function() {
                //     kuantitas = Number($(this).val()) || 0;

                // });

                // total_item = harga * kuantitas;

                // total += (harga * kuantitas);

                i++; //
            });
            // alert($('.harga_pembelian').length);
            for (y = 0; y < $('.harga_pembelian').length; y++) {
                var kuan = $('#kuantitas_pembelian_' + y).val();
                var har = $('#harga_pembelian_' + y).val();


                var tot = parseInt(kuan) * parseInt(har);
                total += tot;
                $('.total_item_pembelian_' + y).html(tot);

            };
            // for
            //     $('.total_item_pembelian').each(function() {
            //         // kuantitas = Number($(this).val()) || 0;
            //         $(this).html(total_item);
            //     });

            $('#total_harga_Pembelian').val(total);
            $('#subTotal_Pembelian').html(total);
        };
        // Generete Subtotal
        $("#no_pesanan_pembelian").on('change', function() {
            // alert("aa");
            $('#new__').html("");


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
                                    "{{ $barangs->satuan }}",
                                ],
                            @endforeach
                        ]
                    ],
                @endforeach
            ];
            var id_nota_pesanan = $(this).val();

            notapemesanan.forEach(element => {
                if (id_nota_pesanan == element[0]) {

                    $('#supplier_span_pem').html(element[1][1]);
                    // Show Supplier
                    // var supplier_html =
                    //     '<div class="form-group p-3"><label>Nama Supplier</label><select class="form-control" name="supplier_id" id="supplier"  readonly><option value="' +
                    //     element[1][0] + '" >' + element[1][1] + '</option></select></div>';
                    $('#new__').append(
                        '<input type="hidden" name="no_pesanan_pembelian" id="no_pesanan_pembelian" value="' +
                        element[0] + '">');

                    $('#new__').append(
                        '<input type="hidden" name="supplier_id" class="form-control" id="supplier" value="' +
                        element[1][0] + '">');
                    // $('#bahan_pesanan').append(
                    //     '<div id="bahan_pesanan_row" class="row justify-content-around"></div>');
                    for (let index = 0; index < element[2].length; index++) {
                        const elements = element[2][index];
                        var barang_id = elements[0];
                        var barang_name = elements[1];
                        var harga = elements[2];
                        var kuantitas = elements[3];
                        var total_item = parseInt(harga) * parseInt(kuantitas);

                        var table = '<tr class="list" id="row_' + index + '">' +
                            '<td>' + barang_name +
                            '<input type="hidden" name="barang[' + index + '][' + "barang_id" +
                            ']" value=' + barang_id + '>' +
                            '</td>' +

                            '<td>' +
                            '<input width="20%" class="kuantitas_pembelian" id="kuantitas_pembelian_' +
                            index +
                            '" type="number" onchange="maxminvalue(' +
                            "'kuantitas_pembelian'" + "," + index + "," + kuantitas +
                            '),findTotalPembelian()" min="1" max="' + 999999999 +
                            '" name="barang[' + index + '][' + "kuantitas" + ']" value=' +
                            thousands_separators(kuantitas) + '>' +
                            '</td>' +
                            '<td class="satuan_pembelian">' +
                            elements[4] +
                            '</td>' +
                            '<td>' +
                            '<input width="20%" class="harga_pembelian" id="harga_pembelian_' + index +
                            '" type="number" onchange="maxminvalue(' +
                            "'harga_pembelian'" + "," + index + "," + harga +
                            '),findTotalPembelian()"  min="1" max="' + 999999999 +
                            '" name="barang[' + index + '][' + "harga" + ']" value="' + harga + '"">' +
                            '</td>' +



                            '<td class="total_item_pembelian_' + index + '">' +
                            // total_item
                            '</td>' +

                            '<td>' +
                            '<a class="btn btn-danger barang_delete" onclick="deleteDataPembelian(' +
                            index + ')"><i class="fa fa-trash-o"></i></a></a>' +
                            '</td>' +

                            '</tr>';
                        // alert(table);
                        $('#new__').append(table);

                        // $('#bahan_pesanan_row').append(table);
                        findTotalPembelian();
                    }
                }
            });
        });

        var count_penjualan = 1;
        var subTotal_penjualan = 0;

        function deleteDataPenjualan(id) {
            $('#row_' + id).html("");
            harga = $('#row_' + id).attr("harga");
            sub_new = parseInt(subTotal_penjualan) - parseInt(harga);
            subTotal_penjualan = sub_new;
            var totalPayment = parseFloat(subTotal_penjualan);
            $('#subTotal_penjualan').text(thousands_separators(totalPayment));
            $('#total_harga_penjualan').val(totalPayment);
            // alert(sub_new);
        };
        $('#tambah_penjualan').on('click', function() {
            $("#customer").disable = true;
            var name = $('#barang_penjualan').val();
            var kuantitas = $('#kuantitas_penjualan').val();
            var kuantitas_bahan_baku_ready = $('#barang_penjualan').find(':selected').attr('ready');
            var harga = $('#harga_penjualan').val();
            // alert(harga);
            var no_nota = $('#no_nota_penjualan_span').text();
            var tgl_transaksi = $('#tgl_transaksi_penjualan_span').text();
            var customer = $('#customer').val();

            if (parseInt(kuantitas) <= 0 || kuantitas == '') {
                // alert('dada');
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else if (parseInt(harga) <= 0 || harga == '' || harga.length > 9) {
                var erroMsg =
                '<span class="alert alert-danger ml-5">Pastikan input angka benar dengan benar</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else if (parseInt(kuantitas_bahan_baku_ready) < parseInt(kuantitas) || kuantitas_bahan_baku_ready ==
                '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Kuantitas stok ready kurang</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                var total = 0;
                $('#customer_span').html(customer);
                var id_customer = $('#customer').find(':selected').attr('id');
                var notainput = '<input type="hidden" name="no_nota_penjualan" value=' + no_nota + '> ' +
                    '<input type="hidden" name="tgl_transaksi" value=' + tgl_transaksi + '> ' +
                    '<input type="hidden" name="customer_id" value=' + id_customer + '> ';
                $('#new_penjualan').append(notainput);

                $("#receipt_bill_penjualan").each(function() {
                    var total = harga * kuantitas;

                    subTotal_penjualan += parseInt(total);
                    var satuan = $('#barang_penjualan').find(':selected').attr('satuan');
                    var id_barang = $('#barang_penjualan').find(':selected').attr('id');


                    var table = '<tr id="row_' + id_barang + '" harga="' + total + '" ><td>' + name +
                        '<input type="hidden" name="barang_penjualan[' + count_penjualan + '][' +
                        "id_barang" + ']" value=' + id_barang + '></td>' +
                        '<td>' +
                        '<p id="label_penjualan_kuantitas_' + id_barang + '">' + kuantitas + '</p>' +
                        '<input id="form_penjualan_kuantitas_' + id_barang +
                        '" type="hidden" name="barang_penjualan[' + count_penjualan + '][' +
                        "kuantitas" + ']" value=' + kuantitas + '></td><td>' + satuan + '</td><td>' +
                        thousands_separators(harga) + '<input type="hidden" name="barang_penjualan[' +
                        count_penjualan + '][' +
                        "harga_barang" + ']" value=' + harga +
                        '></td>' +
                        '<td><strong id="label_penjualan_total_' + id_barang +
                        '"><input id="form_penjualan_total_' + id_barang +
                        '" type="hidden" id="total" name="barang_penjualan[' +
                        count_penjualan + '][' + "total_harga_barang" + ']" value="' + total + '">' +
                        thousands_separators(total) + '</strong></td>' +
                        '<td><a class="btn btn-danger barang_delete" onclick="deleteDataPenjualan(' +
                        id_barang + ')"><i class="fa fa-trash-o"></i></a></a></td>' +
                        '</tr>';

                    var id_row = '#row_' + id_barang;
                    if (isEmpty($(id_row))) {
                        $('#new_penjualan').append(table);
                    } else {
                        // var  = '#label_kuantitas_'+id_barang;
                        var kuantitas_lama = $('#form_penjualan_kuantitas_' + id_barang).val();
                        var kuantias_baru = parseInt(kuantitas_lama) + parseInt(kuantitas);
                        // alert(kuantias_baru);
                        $('#label_penjualan_kuantitas_' + id_barang).html(kuantias_baru);
                        $('#form_penjualan_kuantitas_' + id_barang).val(kuantias_baru);
                        var total = harga * kuantias_baru;
                        $('#label_penjualan_total_' + id_barang).text(thousands_separators(total));
                        $('#form_penjualan_total_' + id_barang).val(total);
                    }


                    // Code for Sub Total of Vegitables 
                    // var total = 0;

                    $('#subTotal_penjualan').text(thousands_separators(subTotal_penjualan));


                    // var Subtotal = $('#subTotal_penjualan').text();

                    var totalPayment = parseFloat(subTotal_penjualan);
                    $('#total_harga_penjualan').val(totalPayment); // Showing using ID 

                });
                count_penjualan++;
            }
        });

        $("#cara_bayar").on('change', function() {
            var cara_bayar = $("#cara_bayar").val();
            $('#cara_bayar_form').val(cara_bayar);
            // alert(cara_bayar);

        });
        $("#daftar_akun").on('change', function() {
            var daftar_akun = $("#daftar_akun").val();
            $('#ketegori_nota_form').val(daftar_akun);
        });
        $("#cara_bayar_penjualan").on('change', function() {
            var cara_bayar = $("#cara_bayar_penjualan").val();
            $('#cara_bayar_form_penjualan').val(cara_bayar);
            // alert(cara_bayar);

        });
        $("#daftar_akun_penjualan").on('change', function() {
            var daftar_akun = $("#daftar_akun_penjualan").val();
            // alert(daftar_akun);
            $('#ketegori_nota_form_penjualan').val(daftar_akun);
        });
        $("#keterangan_pembelian").on('change', function() {
            var daftar_akun = $("#keterangan_pembelian").val();
            // alert(daftar_akun);
            $('#keterangan_pembelian_form').val(daftar_akun);
        });
        $("#keterangan_penjualan").on('change', function() {
            var daftar_akun = $("#keterangan_penjualan").val();
            // alert(daftar_akun);
            $('#keterangan_penjualan_form').val(daftar_akun);
        });
    </script>
@endsection

{{-- seperator ribuan --}}
@section('initialscript')
    <script>
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
    </script>
@endsection
