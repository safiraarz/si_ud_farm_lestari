@extends('layout.conquer')

@section('content')
    <div class="form-group margin-right-10">
        <label>Pilih Nota</label>
        <select class="form-control" name="pilih_nota" id="pilih_nota">
            <option value="nota_pemesanan">Nota Pemesanan</option>
            <option value="nota_pembelian">Nota Pembelian</option>
            <option value="nota_penjualan">Nota Penjualan</option>

        </select>
    </div>

    {{-- Pemesanan --}}
    <section class="mt-3 margin-right-10" id="nota_pemesanan_section" style="display: none;">
        <div class="">
            {{-- <h4 class="text-center" style="color:green"> UD Farm Lestari </h4> --}}
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
                                <th style="width:25%">Kuantitas</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang" class="form-control barang">
                                        @foreach ($barang as $row)
                                            @if ($row->jenis == 'Bahan Baku')
                                                <option id={{ $row->id }} value="{{ $row->nama }}"
                                                    harga="{{ $row->harga }}" satuan="{{ $row->satuan }}"
                                                    class="barang custom-select">
                                                    {{ $row->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas" min="0" value="0"
                                        class="form-control kuantitas">
                                </td>
                                <td>
                                    <input type="number" id="harga" min="0" value="0"
                                        class="form-control harga">
                                </td>
                                <td><button id="tambah_pemesanan" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div role="alert" id="errorMsg" class="mt-5">
                        <!-- Error msg  -->
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
                                            <th>Nama Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Action</th>
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
                                        <td class="text-center text-dark">
                                            <input type="hidden" name="total_harga" id="total_harga">
                                            <h5> <strong><span id="subTotal"></strong></h5>
                                        </td>
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
    <section class=" mt-3 margin-right-10" id="nota_pembelian_section" >
        {{-- <div class="">
            <form action="{{ route('notapembelian.store') }}" method="post" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf
                <input type="hidden" name="jenis_nota" value="nota_pembelian">
                <div class="form-body">
                    <div class="form-group">
                        <label>Nomor Nota Pembelian</label>
                        <input type="text" name="no_nota" class="form-control" value="{{ $no_nota_pembelian }}"
                            id='kuantitas' readonly required>
                    </div>
                    <div class="form-group ">
                        <label>Tanggal Pembuatan Nota</label>
                        <div>
                            <input type="date" value="{{ $date_now }}" name="tanggal_pembuatan_nota"
                                class="form-control input-sm" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No Nota Pemesanan</label>
                        <select class="form-control" name="no_pesanan_pembelian" id="no_pesanan_pembelian">
                            <option value="">Silahkan Pilih Nomor Pesanan</option>
                            @foreach ($notapemesanan as $item)
                                <option value="{{ $item->id }}">{{ $item->no_nota }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="bahan_pesanan">
                        <div id="bahan_pesanan_row" class="row">

                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div> --}}
        <div class="">
            {{-- <h4 class="text-center" style="color:green"> UD Farm Lestari </h4> --}}
            <div class="row">
                <div class="col-md-5  mt-4 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        @csrf
                        <thead>
                            <tr>
                                <th>No. Nota Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="no_pesanan_pembelian" id="no_pesanan_pembelian">
                                        <option value="">Silahkan Pilih Nomor Pesanan</option>
                                        @foreach ($notapemesanan as $item)
                                            <option value="{{ $item->id }}">{{ $item->no_nota }}</option>
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
                                <th style="width:25%">Kuantitas</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang" class="form-control barang">
                                        @foreach ($barang as $row)
                                            @if ($row->jenis == 'Bahan Baku')
                                                <option id={{ $row->id }} value="{{ $row->nama }}"
                                                    harga="{{ $row->harga }}" satuan="{{ $row->satuan }}"
                                                    class="barang custom-select">
                                                    {{ $row->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas" min="0" value="0"
                                        class="form-control kuantitas">
                                </td>
                                <td>
                                    <input type="number" id="harga" min="0" value="0"
                                        class="form-control harga">
                                </td>
                                <td><button id="tambah_pembelian" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div role="alert" id="errorMsg" class="mt-5">
                        <!-- Error msg  -->
                    </div>
                </div>

                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('notapembelian.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Nota Pembelian</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Nota</span> : <span id="no_nota_span">{{ $no_nota_pembelian }}</span>
                                    <input type="hidden" name="no_nota" class="form-control" value="{{ $no_nota_pembelian }}">
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
                                            <th>Nama Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Harga</th>
                                            <th>Action</th>
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
                                        <td class="text-center text-dark">
                                            <input type="hidden" name="total_harga" id="total_harga">
                                            <h5> <strong><span id="subTotal"></strong></h5>
                                        </td>
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
            {{-- <h4 class="text-center" style="color:green"> UD Farm Lestari </h4> --}}
            <div class="row">
                <div class="col-md-5  mt-4 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="customer" id="customer" class="form-control">
                                        @foreach ($customer as $row)
                                            <option id={{ $row->id }} value="{{ $row->nama }}""
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
                                <th style="width:25%">Kuantitas</th>
                                <th>Harga</th>
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
                                                    class="barang custom-select">
                                                    {{ $row->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas_penjualan" min="0" value="0"
                                        class="form-control kuantitas">
                                </td>
                                <td>
                                    <input type="number" id="harga_penjualan" min="0" value="0"
                                        class="form-control harga">
                                </td>
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
             
                                            <th>Nama Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Action</th>
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
                                        <td class="text-center text-dark">
                                            <input type="hidden" name="total_harga_penjualan"
                                                id="total_harga_penjualan">
                                            <h5> <strong><span id="subTotal_penjualan"></strong></h5>
                                        </td>
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
@endsection

@section('javascript')
    <script>
     
       
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
        function deleteDataPemesanan(id)
        {
            $('#row_'+id).html("");
            harga = $('#row_'+id).attr("harga");
            sub_new = parseInt(subTotal_pesanan) - parseInt(harga);
            subTotal_pesanan = sub_new;
            var totalPayment = parseFloat(subTotal_pesanan);
            $('#subTotal').text(thousands_separators(totalPayment));
            $('#total_harga').val(totalPayment); 
            // alert(sub_new);
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
            if (kuantitas == 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
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

                $("#receipt_bill").each(function() {
                    var total_pesanan = harga * kuantitas;

                    subTotal_pesanan += parseInt(total_pesanan);
                    var satuan = $('#barang').find(':selected').attr('satuan');
                    var id_barang = $('#barang').find(':selected').attr('id');


                    var table = '<tr class="list" id="row_'+ count+'" harga="'+harga+'"><td>' + name +
                        '<input type="hidden" name="barang[' + count + '][' + "id_barang" + ']" value=' +
                        id_barang + '></td><td>' + thousands_separators(kuantitas) +
                        '<input type="hidden" name="barang[' +
                        count + '][' + "kuantitas" + ']" value=' + thousands_separators(kuantitas) +
                        '></td><td>' + satuan +
                        '</td><td>' + thousands_separators(harga) + '<input type="hidden" name="barang[' +
                        count + '][' +
                        "harga_barang" + ']" value=' + harga +
                        '></td><td><strong><input type="hidden" id="total" value="' + total_pesanan + '">' +
                        thousands_separators(total_pesanan) +
                        '</strong></td>'+
                        '<td>'+
                        '<a class="btn btn-danger barang_delete" onclick="deleteDataPemesanan('+count+')">Hapus</a><td>'+
                        '</tr>';
                    $('#new').append(table);

                    // Code for Sub Total of Vegitables 
                    // var total = 0;
                    // $('tbody tr td:last-child').each(function() {
                    //     var value = parseInt($('#total', this).val());
                    //     if (!isNaN(value)) {
                    //         total += value;
                    //     }
                    // });



                    // var Subtotal = $('#subTotal').text();

                    var totalPayment = parseFloat(subTotal_pesanan);
                    $('#subTotal').text(thousands_separators(totalPayment));
                    // alert(t);
                    $('#total_harga').val(totalPayment); // Showing using ID 

                });
                count++;
            }
        });




        function deleteDataPembelian(id)
        {
            $('#row_'+id).html("");
            // harga = $('#row_'+id).attr("harga");
            // sub_new = parseInt(subTotal_pesanan) - parseInt(harga);
            // subTotal_pesanan = sub_new;
            // var totalPayment = parseFloat(subTotal_pesanan);
            // $('#subTotal').text(thousands_separators(totalPayment));
            // $('#total_harga').val(totalPayment); 
            // alert(sub_new);
        };
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
                    $('#new__').append('<input type="hidden" name="no_pesanan_pembelian" id="no_pesanan_pembelian" value="' + element[0]+'">');

                    $('#new__').append('<input type="hidden" name="supplier_id" class="form-control" id="supplier" value="' + element[1][0] +'">');
                    // $('#bahan_pesanan').append(
                    //     '<div id="bahan_pesanan_row" class="row justify-content-around"></div>');
                    for (let index = 0; index < element[2].length; index++) {
                        const elements = element[2][index];
                        var barang_id = elements[0];
                        var barang_name = elements[1];
                        var harga = elements[2];
                        var kuantitas = elements[3];
                        // var barang_pesanan =
                        //     // '<div class="row">'+
                        //     '<div class="col-md-3">' +
                        //     '<div class="col-md-12">' +
                        //     '<div class="form-group bahan_' + index + '">' +
                        //     '<label>Bahan ' + parseInt(index + 1) + '</label>' +
                        //     '</div> ' +
                        //     '<div class="form-group">' +
                        //     '<label>Nama Bahan Baku : ' + barang_name + '</label> ' +
                        //     '<input type="hidden" name="barang[' + index + '][' + "barang_id" +
                        //     ']" class="form-control" id="harga" value="' + barang_id +
                        //     '" required  readonly>' +
                        //     '</div>' +
                        //     '<div class="form-group"><label>Harga per-satuan : ' + harga +
                        //     '</label>' +
                        //     '<input type="hidden" name="barang[' + index + '][' + "harga" +
                        //     ']" class="form-control" id="harga" value="' + harga + '" required  readonly>' +
                        //     '</div>' +
                        //     '<div class="form-group"><label>Kuantitas</label><input type="number" name="barang[' +
                        //     index + '][' + "kuantitas" + ']" class="form-control" id="kuantitas" value="' +
                        //     kuantitas + '" required></div>' +
                        //     '</div>' +
                        //     '</div>';
                        // alert(barang_pesanan);

                        var table = '<tr class="list" id="row_'+index+'">'+
                            '<td>' + barang_name +
                        '<input type="hidden" name="barang[' + index + '][' + "barang_id" + ']" value=' +barang_id + '>'+
                        '</td>'+

                        '<td>'+
                        '<input type="number" name="barang[' +index + '][' + "kuantitas" + ']" value=' + thousands_separators(kuantitas) +'>'+
                        '</td>'+

                        '<td>'+
                        '<input type="number" name="barang[' +index + '][' + "harga" + ']" value="' + harga +'"">'+
                        '</td>'+
                        '<td>'+
                        '<a class="btn btn-danger barang_delete" onclick="deleteDataPembelian('+index+')">Hapus</a>'+
                        '</td>'+
                        
                        '</tr>';
                        alert(table);
                        $('#new__').append(table);
                        // $('#bahan_pesanan_row').append(table);


                    }



                }

            });

        });

        var count_penjualan = 1;
        var subTotal_penjualan = 0;
        function deleteDataPenjualan(id)
        {
            $('#row_'+id).html("");
            harga = $('#row_'+id).attr("harga");
            sub_new = parseInt(subTotal_penjualan) - parseInt(harga);
            subTotal_penjualan = sub_new;
            var totalPayment = parseFloat(subTotal_penjualan);
            $('#subTotal').text(thousands_separators(totalPayment));
            $('#total_harga').val(totalPayment); 
            // alert(sub_new);
        };
        $('#tambah_penjualan').on('click', function() {
            $("#customer").disable = true;
            var name = $('#barang_penjualan').val();
            var kuantitas = $('#kuantitas_penjualan').val();
            var harga = $('#harga_penjualan').val();
            // alert(harga);
            var no_nota = $('#no_nota_penjualan_span').text();
            var tgl_transaksi = $('#tgl_transaksi_penjualan_span').text();
            var customer = $('#customer').val();
            if (kuantitas == 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
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


                    var table = '<tr id="row_'+ count_penjualan+'" harga="'+harga+'" ><td>' + name +
                        '<input type="hidden" name="barang_penjualan[' + count_penjualan + '][' +
                        "id_barang" + ']" value=' + id_barang + '></td><td>' + kuantitas +
                        '<input type="hidden" name="barang_penjualan[' + count_penjualan + '][' +
                        "kuantitas" + ']" value=' + kuantitas + '></td><td>' + satuan + '</td><td>' +
                        thousands_separators(harga) + '<input type="hidden" name="barang_penjualan[' +
                        count_penjualan + '][' +
                        "harga_barang" + ']" value=' + harga +
                        '></td><td><strong><input type="hidden" id="total" name="barang_penjualan[' +
                        count_penjualan + '][' + "total_harga_barang" + ']" value="' + total + '">' +
                        thousands_separators(total) + '</strong></td>'+
                        '<td><a class="btn btn-danger barang_delete" onclick="deleteDataPemesanan('+count_penjualan+')">Hapus</a></td>'+
                        '</tr>';
                    $('#new_penjualan').append(table);

                    // Code for Sub Total of Vegitables 
                    // var total = 0;
                    // $('#receipt_bill_penjualan tbody tr td:last-child').each(function() {
                    //     var value = parseInt($('#total', this).val());
                    //     if (!isNaN(value)) {
                    //         total += value;
                    //     }
                    // });
                    $('#subTotal_penjualan').text(thousands_separators(subTotal_penjualan));


                    // var Subtotal = $('#subTotal_penjualan').text();

                    var totalPayment = parseFloat(subTotal_penjualan);
                    $('#total_harga_penjualan').val(totalPayment); // Showing using ID 

                });
                count_penjualan++;
            }
        });

        // $("#no_pesanan_pembelian").on('change', function() {
        //     // alert("aa");
        //     $('#bahan_pesanan').html("");
        //     var notapemesanan = [
        //         @foreach ($notapemesanan as $item)
        //             [
        //                 "{{ $item->id }}",
        //                 [
        //                     @foreach ($supplier as $sup)
        //                         @if ($item->supplier_id == $sup->id)
        //                             "{{ $item->supplier_id }}",
        //                             "{{ $sup->nama }}",
        //                         @endif
        //                     @endforeach
        //                 ],
        //                 [
        //                     @foreach ($item->barang as $barangs)
        //                         [
        //                             "{{ $barangs->id }}",
        //                             "{{ $barangs->nama }}",
        //                             "{{ $barangs->pivot->harga }}",
        //                             "{{ $barangs->pivot->kuantitas }}",
        //                         ],
        //                     @endforeach
        //                 ]
        //             ],
        //         @endforeach
        //     ];
        //     var id_nota_pesanan = $(this).val();
        //     notapemesanan.forEach(element => {
        //         if (id_nota_pesanan == element[0]) {
        //             // Show Supplier

        //             // lama
        //             var supplier_html =
        //                 '<div class="form-group p-3"><label>Nama Supplier</label><select class="form-control" name="supplier_id" id="supplier"  readonly><option value="' +
        //                 element[1][0] + '" >' + element[1][1] + '</option></select></div>';

        //             $('#bahan_pesanan').append(supplier_html);
        //             $('#bahan_pesanan').append(
        //                 '<div id="bahan_pesanan_row" class="row justify-content-around"></div>');
        //             for (let index = 0; index < element[2].length; index++) {
        //                 const elements = element[2][index];
        //                 var barang_id = elements[0];
        //                 var barang_name = elements[1];
        //                 var harga = elements[2];
        //                 var kuantitas = elements[3];
        //                 var barang_pesanan =
        //                     // '<div class="row">'+
        //                     '<div class="col-md-4">' +
        //                     '<div class="col-md-12">' +
        //                     '<div class="form-group bahan_' + index + '">' +
        //                     '<label>Bahan ' + parseInt(index + 1) + '</label>' +
        //                     '</div> ' +
        //                     '<div class="form-group">' +
        //                     '<label>Nama Bahan Baku : ' + barang_name + '</label> ' +
        //                     '<input type="hidden" name="barang[' + index + '][' + "barang_id" +
        //                     ']" class="form-control" id="harga" value="' + barang_id +
        //                     '" required  readonly>' +
        //                     '</div>' +
        //                     '<div class="form-group"><label>Harga per-satuan : </label>' +
        //                     '<input type="number" name="barang[' + index + '][' + "harga" +
        //                     ']" class="form-control" id="harga" value="' + harga + '" required >' +
        //                     '</div>' +
        //                     '<div class="form-group"><label>Kuantitas</label><input type="number" name="barang[' +
        //                     index + '][' + "kuantitas" + ']" class="form-control" id="kuantitas" value="' +
        //                     kuantitas + '" required></div>' +
        //                     '</div>' +
        //                     '</div>';
        //                 // alert(barang_pesanan);
        //                 // lama

        //                 $('#bahan_pesanan_row').append(barang_pesanan);
        //             }
        //         }
        //     });
        // });
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
