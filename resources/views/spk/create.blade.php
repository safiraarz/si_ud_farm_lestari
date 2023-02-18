@extends('layout.conquer')

@section('content')
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
                                <th style="width:35">Nama Pakan Ayam</th>
                                <th style="width:35%">Flok Tujuan</th>
                                <th style="width:30%">Kuantitas (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang" id="barang" class="form-control">
                                        <option value="">PiliH Pakan</option>
                                        @foreach ($barang as $row)
                                            @if ($row->jenis == 'Barang Jadi')
                                                <option id={{ $row->id }} value="{{ $row->nama }}"
                                                    satuan="{{ $row->satuan }}" class="barang custom-select">
                                                    {{ $row->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="flok" id="flok" class="form-control">
                                        <option value="">PiliH Flok</option>
                                        @foreach ($flok as $row)
                                            <option id="{{ $row->id }}" value="{{ $row->nama }}" populasi="{{ $row->populasi }}" kebutuhan_pakan="{{ $row->kebutuhan_pakan }}" satuan="{{ $row->satuan }}" class="flok custom-select">
                                                {{ $row->nama }}
                                            </option>
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
                    <div role="alert" id="errorMsg" class="mt-5 errorMsg">
                        <!-- Error msg  -->
                    </div>
                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('spk.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
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
                                            <th>Nama Pakan Ayam</th>
                                            <th>Tgl Mulai Produksi</th>
                                            <th>Tgl Selesai Produksi</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
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
@endsection


@section('javascript')
    <script>
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
        var count = 1;

        function deleteData(id) {
            $('#row_' + id).html("");
        };

        $('#flok').on('change', function() {
            var populasi = $('#flok').find(':selected').attr('populasi');
            var kebutuhan_pakan = $('#flok').find(':selected').attr('kebutuhan_pakan');
            var kuantias_flox = Math.ceil( ( parseFloat(populasi) * parseFloat(kebutuhan_pakan) ) /1000 );
            // alert(kuantias_flox);
            $('#kuantitas').val(kuantias_flox);

        });


        $('#tambah').on('click', function() {
            var date_start = $('#tgl_mulai_prod').val();
            var date_end = $('#tgl_selesai_prod').val();
            var kuantitas = $('#kuantitas').val();
            var totalDays = getDays(new Date(date_start), new Date(date_end))
            var checkMinimalHariProduksi = checkMinProductionPeriod(kuantitas, totalDays);
            if (checkMinimalHariProduksi != -1) {
                alert('Minimal pengerjaan barang jadi adalah ' + checkMinimalHariProduksi + ' hari')
                return false
            }

            $("#pakan_ayam").disable = true;
            // var keterangan = ('#keterangan').val();
            $('#keterangan_input').val($('#keterangan').val());
            var name = $('#barang').val();

            var satuan = $('#barang').find(':selected').attr('satuan');

            if (parseInt(kuantitas) <= 0 || kuantitas == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Kuantitas Kurang Dari 1 Atau Huruf</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else if (date_start == '' && date_end == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Tanggal Tidak Boleh Kosong</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                var spkinput = '<input type="hidden" name="barang_id" value=' + name + '> ';
                $('#new').append(spkinput);


                $("#receipt_bill").each(function() {
                    var satuan = $('#barang').find(':selected').attr('satuan');
                    var id_barang = $('#barang').find(':selected').attr('id');

                    var table = '<tr id="row_' + count + '" >' +
                        '<td>' + name + '<input type="hidden" name="barang[' + count + '][' + "id_barang" +
                        ']" value=' + id_barang + '></td>' +
                        '<td>' + date_start + '<input type="hidden" name="barang[' + count + '][' +
                        "tanggal_mulai" + ']" value=' + date_start + '></td>' +
                        '<td>' + date_end + '<input type="hidden" name="barang[' + count + '][' +
                        "tanggal_akhir" + ']" value=' + date_end + '></td>' +
                        '<td>' + thousands_separators(kuantitas) + '<input type="hidden" name="barang[' +
                        count + '][' + "kuantitas" + ']" value=' + kuantitas + '></td>' +
                        '<td>' + satuan + '</td><td>' +
                        '<a class="btn btn-danger barang_delete" onclick="deleteData(' + count +
                        ')"><i class="fa fa-trash-o"></i></a><td></tr>';
                    $('#new').append(table);
                });
                count++;
            }
        });

        function getDays(date1, date2) {
            let difference = date2.getTime() - date1.getTime();
            let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
            return TotalDays + 1;
        }


        function checkMinProductionPeriod(qty, totalDays) {
            let counter = 0
            while (qty > 0) {
                qty = qty - 3200
                counter++
            }
            if (totalDays >= counter) {
                return -1
            }
            return counter
        }
    </script>
@endsection
