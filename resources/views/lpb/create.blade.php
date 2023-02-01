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
    <title>Laporan Pengeluaran Barang</title>
    <style>
        .result {
            color: red;
        }

        td {
            text-align: center;
        }
    </style>
</head>


<body>
    <section class="mt-3">
        <div class="container-fluid">
            <h4 class="text-center" style="color:green"> UD Farm Lestari </h4>
            <div class="row">
                <div class="col-md-5 mt-4 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" id="keterangan" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:45%">Nama Bahan Baku</th>
                                <th style="width:35%">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="bahan_baku" id="bahan_baku" class="form-control">
                                        @foreach($barang as $row )
                                        @if ($row->jenis == "Bahan Baku")
                                        <option id={{$row->id}} value="{{$row->nama}}" satuan="{{$row->satuan}}" class="barang custom-select">
                                            {{$row->nama}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas_bahan_baku" min="0" value="0" class="form-control">
                                </td>
                                <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('lpb.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="keterangan_input" id="keterangan_input">
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Laporan Pengeluaran Barang</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <input type="hidden" name="no_surat" value="{{ $no_surat_generator }}">
                                    <span>No. Surat</span> : <span id="no_surat_span">{{ $no_surat_generator }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <input type="hidden" name="tgl_pencatatan" value="{{ $date_now }}">
                                    <span>Tgl Pencatatan</span> : <span id="no_nota_span">{{ $date_now }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan Baku</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new">
                                    </tbody>
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
</body>

</html>

<script>
    $(document).ready(function() {
        // $('#barang').change(function() {
        //     var ids = $(this).find(':selected').attr('harga');
        //     $('#harga').val(ids);
        // });
        var count = 1;
        // if (count != 1) {

        // };
        $('#tambah').on('click', function() {
            $("#pakan_ayam").disable = true;
            // Ketergangan
            $('#keterangan_input').val($('#keterangan').val());
            var id_bahan_baku = $('#bahan_baku').find(':selected').attr('id');
            var satuan_bahan_baku = $('#bahan_baku').find(':selected').attr('satuan');
            var nama_bahan_baku = $('#bahan_baku').val();
            var kuantitas_bahan_baku = $('#kuantitas_bahan_baku').val();
         
            if (kuantitas_bahan_baku == 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                // $('#nama_pakan_span').html(supplier);
                // var id_pakan_ayam = $('#nama_pakan').find(':selected').attr('id');

                // var bominput = '<input type="hidden" name="barang_id" value=' + id_pakan_ayam + '> ';
                // $('#new').append(bominput);


                $("#receipt_bill").each(function() {

                    var table = '<tr>'+
                        '<td>' + count + '</td>'+
                        '<td>' + nama_bahan_baku + '<input type="hidden" name="bahan_baku[' + count +'][' + "id_bahan_baku" + ']" value=' + id_bahan_baku + '></td>'+
                        '<td>' + kuantitas_bahan_baku +'<input type="hidden" name="bahan_baku[' + count + '][' + "kuantitas" + ']" value=' + kuantitas_bahan_baku +'></td>'+
                        '<td>' + satuan_bahan_baku + '</td>'+
                        '</tr>';
                    $('#new').append(table);
                });
                count++;
            }
        });
    });
</script>