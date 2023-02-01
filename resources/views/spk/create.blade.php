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
    <title>Surat Perintah Kerja</title>
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
                        <tbody>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <input type="text" id="keterangan" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:45%">Nama Pakan Ayam</th>
                                <th style="width:35%">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang" class="form-control">
                                        @foreach($barang as $row )
                                        @if ($row->jenis == "Barang Jadi")
                                        <option id={{$row->id}} value="{{$row->nama}}" satuan="{{$row->satuan}}" class="barang custom-select">
                                            {{$row->nama}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas" min="0" value="0" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Tanggal Mulai Produksi</th>
                                <th>Tanggal Selesai Produksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="date" id="tgl_mulai_prod" class="form-control">
                                </td>
                                <td>
                                    <input type="date" id="tgl_selesai_prod" class="form-control">
                                </td>
                                
                                <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('spk.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="keterangan_input" id="keterangan_input">

                        <div class="p-4">
                            <div class="text-center">
                                <h4>Surat Perintah Kerja</h4>
                            </div>
                            <div class="row">
                                <input type="hidden" name="no_surat" value="{{ $no_surat_generator }}">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>No. Surat</span> : <span id="no_nota_span">{{ $no_surat_generator }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="tgl_pembuatan_surat" value="{{ $date_now }}">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>Tgl Pembuatan Surat</span> : <span id="no_nota_span">{{ $date_now }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Mulai Produksi</th>
                                            <th>Tgl Selesai Produksi</th>
                                            <th>Nama Pakan Ayam</th>
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
            // var keterangan = ('#keterangan').val();
            $('#keterangan_input').val($('#keterangan').val());
            var name = $('#barang').val();
            var kuantitas = $('#kuantitas').val();
            var satuan = $('#barang').find(':selected').attr('satuan');
            var date_start = $('#tgl_mulai_prod').val();
            var date_end = $('#tgl_selesai_prod').val();
            if (kuantitas == 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                // $('#nama_pakan_span').html(supplier);
                // var id_pakan_ayam = $('#nama_pakan').find(':selected').attr('id');

                var spkinput = '<input type="hidden" name="barang_id" value=' + name + '> ';
                $('#new').append(spkinput);


                $("#receipt_bill").each(function() {
                    var satuan = $('#barang').find(':selected').attr('satuan');
                    var id_barang = $('#barang').find(':selected').attr('id');

                    var table = '<tr><td>' + count + '</td>'+
                        '<td>' + name +'<input type="hidden" name="barang[' + count + '][' + "id_barang" + ']" value=' +id_barang + '></td>'+
                        '<td>' + date_start +'<input type="hidden" name="barang[' + count + '][' + "tanggal_mulai" + ']" value=' +date_start + '></td>'+
                        '<td>' + date_end +'<input type="hidden" name="barang[' + count + '][' + "tanggal_akhir" + ']" value=' +date_end + '></td>'+

                        '<td>' + kuantitas + '<input type="hidden" name="barang[' + count +'][' + "kuantitas" + ']" value=' + kuantitas + '></td>'
                        +'<td>' + satuan + '</td></tr>';
                    $('#new').append(table);
                });
                count++;
            }
        });
    });
</script>