<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Nota Pemesanan</title>
    <style>
        .result {
            color: red;
        }

        td {
            text-align: center;
        }
    </style>
</head>
<form action="{{ route('notapemesanan.create') }}" method="post" enctype="multipart/form-data" class="form-horizontal">

    <body>
        <section class="mt-3">
            <div class="container-fluid">
                <h4 class="text-center" style="color:green"> UD Farm Lestari </h4>
                <div class="row">
                    <div class="col-md-5  mt-4 ">
                        <table class="table" style="background-color:#e0e0e0;">
                            <thead>
                                <tr>
                                    <th style="width:35%">Nomor Nota</th>
                                    <th style="width:25%">Tanggal Pembuatan Nota</th>
                                    <th>Nama Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" id="no_nota" class="form-control">
                                    </td>
                                    <td>
                                        <input type="date" id="tgl_transaksi" class="form-control input-sm" required />
                                    </td>
                                    <td>
                                        <select name="supplier" id="supplier" class="form-control">
                                            @foreach($supplier as $row )
                                            <option id={{$row->id}} value={{$row->nama}} class="barang custom-select">
                                                {{$row->nama}}
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
                                        <select name="barang" id="barang" class="form-control">
                                            @foreach($barang as $row )
                                            <option id={{$row->id}} value={{$row->nama}} class="barang custom-select">
                                                {{$row->nama}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" id="kuantitas" min="0" value="0" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" id="harga" min="0" value="0" class="form-control">
                                    </td>
                                    <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                                </tr>
                            </tbody>
                        </table>

                        <div role="alert" id="errorMsg" class="mt-5">
                            <!-- Error msg  -->
                        </div>
                    </div>
                    <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Nota Pemesanan</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Nota</span> : <span id="no_nota"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>Tanggal Transaksi</span> : <span id="tgl_transaksi"></span>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <span>Nama Supplier</span> : <span id="supplier"></span>
                                </div>
                            </div>
                            <div class="row">
                                </span>
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
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
                                            <h5> <strong><span id="subTotal"></strong></h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <td><button id="proses" class="btn btn-success">Proses</button></td>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </body>
</form>

</html>

<!-- INI MASIH COPAS INTERNET, KLO DIGANTI GPP -->
<script>
    $(document).ready(function() {
        $('#barang').change(function() {
            var ids = $(this).find(':selected')[0].id;
            $.ajax({
                type: 'GET',
                url: 'getPrice/{id}',
                data: {
                    id: ids
                },
                dataType: 'json',
                success: function(data) {

                    $.each(data, function(key, resp) {
                        $('#harga').text(resp.product_harga);
                    });
                }
            });
        });

        //tambah to cart 
        var count = 1;
        $('#tambah').on('click', function() {

            var name = $('#barang').val();
            var kuantitas = $('#kuantitas').val();
            var harga = $('#harga').text();
            var satuan = $('#satuan').text();
            var no_nota = $('#no_nota').text();
            var tgl_transaksi = $('#tgl_transaksi').text();
            var supplier = $('#supplier').text();

            if (kuantitas == 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                var total = 0;

                $("#receipt_bill").each(function() {
                    var total = harga * kuantitas;
                    var subTotal = 0;
                    subTotal += parseInt(total);

                    var table = '<tr><td>' + count + '</td><td>' + name + '</td><td>' + kuantitas + '</td><td>' + harga + '</td><td><strong><input type="hidden" id="total" value="' + total + '">' + total + '</strong></td></tr>';
                    $('#new').append(table)

                    // Code for Sub Total of Vegitables 
                    var total = 0;
                    $('tbody tr td:last-child').each(function() {
                        var value = parseInt($('#total', this).val());
                        if (!isNaN(value)) {
                            total += value;
                        }
                    });
                    $('#subTotal').text(total);


                    var Subtotal = $('#subTotal').text();

                    var totalPayment = parseFloat(Subtotal);
                    $('#totalPayment').text(totalPayment.toFixed(2)); // Showing using ID 

                });
                count++;
            }
        });
    });
</script>