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
                                    <textarea type="text" rows=4 maxlength="150" id="keterangan" class="form-control"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                
                                <th style="width:35%">Tanggal Pencatatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>
                                    <input type="date" id="tgl_pencatatan" class="form-control" required>
                                </td>
                               
                            </tr>
                        </tbody>
                        
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:35">No Urut</th>
                                <th style="width:35%">Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" id="no_urut" value="0" class="form-control" required>
                                </td>
                                <td>
                                    <select name="akun" id="akun" class="form-control">
                                        <option value="" selected>==Pilih akun==</option>
                                        @foreach ($akun as $item)
                                        <option no_akun="{{ $item->no_akun }}" value="{{ $item->nama }}" class="barang custom-select">
                                            {{ $item->nama }}
                                        </option>
                                            
                                        @endforeach
                                          
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Nominal Debit</th>
                                <th>Nominal Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" value="0" id="nominal_debit" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" value="0" id="nominal_kredit" class="form-control" required>
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
                    <form action="{{ route('jurnal_akuntansi.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <input type="hidden" name="keterangan_input" id="keterangan_input">
                        <input type="hidden" name="jenis_jurnal" id="jenis_jurnal_form" value="umum">
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Jurnal <span id="jenis_jurnal_span">Umum</span></h4>
                            </div>
                            <div class="row">
                                <input type="hidden" name="no_bukti" id="no_bukti_form" value="{{ $no_bukti_generator }}">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>No. Bukti</span> : <span id="no_bukti_span">{{ $no_bukti_generator }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="tgl_pencatatan" id="tgl_pencatatan_form" value="">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>Tanggal Pencatatan</span> : <span id="tgl_pencatatan_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>No Urut</th>
                                            <th>Nama Akun</th>
                                            <th>Nominal Debit</th>
                                            <th>Nominal Kredit</th>
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

        // $('#flok').on('change', function() {
        //     var populasi = $('#flok').find(':selected').attr('populasi');
        //     var kebutuhan_pakan = $('#flok').find(':selected').attr('kebutuhan_pakan');
        //     var kuantias_flox = Math.ceil( ( parseFloat(populasi) * parseFloat(kebutuhan_pakan) ) /1000 * 10 );
        //     // alert(kuantias_flox);
        //     $('#kuantitas').val(kuantias_flox);

        // });
        function isEmpty( el ){
            return !$.trim(el.html())
        };


        $('#tambah').on('click', function() {
            var nominal_debit = $('#nominal_debit').val();
            var nominal_kredit = $('#nominal_kredit').val();
            var no_urut = $('#no_urut').val();
            var keterangan = $('#keterangan').val();
            $('#keterangan_input').val(keterangan);
            var tgl_pencatatan = $('#tgl_pencatatan').val();
            
            $('#tgl_pencatatan_span').html(tgl_pencatatan);
            $('#tgl_pencatatan_form').val(tgl_pencatatan);
            var nama_akun = $('#akun').find(':selected').val();
            var no_akun = $('#akun').find(':selected').attr('no_akun');


            if ( nominal_debit == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Nominal Debit Salah</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else if ( nominal_kredit == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Nominal Kredit Salah</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } 
            else if (no_akun == '') {
                var erroMsg = '<span class="alert alert-danger ml-5">Pilih Akun </span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            } 
            else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                // var spkinput = '<input type="hidden" name="barang_id" value=' + name + '> ';
                // $('#new').append(spkinput);


                $("#receipt_bill").each(function() {

                    var table = '<tr id="row_' + no_akun + '" >' +
                        '<td>' + no_urut + '<input type="hidden" name="jurnal[' + count + '][' + "no_urut" +
                        ']" value=' + no_urut + '></td>' +
                        '<td>' + nama_akun + '<input type="hidden" name="jurnal[' + count + '][' + "no_akun" +
                        ']" value=' + no_akun + '></td>' +
                        '<td>' + nominal_debit + '<input type="hidden" name="jurnal[' + count + '][' +
                        "nominal_debit" + ']" value=' + nominal_debit + '></td>' +
                        '<td>' + nominal_kredit+ '<input type="hidden" name="jurnal[' + count + '][' +
                        "nominal_kredit" + ']" value=' + nominal_kredit + '>'+
                        '</td>' +
                        '<td>' +
                        '<a class="btn btn-danger barang_delete" onclick="deleteData(' + no_akun +
                        ')"><i class="fa fa-trash-o"></i></a><td></tr>';
                    
                    
                    var id_row = '#row_'+no_akun;
                    $('#new').append(table);
                    // if(isEmpty($(id_row))){
                    // }
                    // else{
                    //     var kuantitas_lama = $('#form_kuantitas_'+id_barang).val();

                    //     var kuantias_baru = parseInt(kuantitas_lama) + parseInt(kuantitas);

                    //     $('#label_kuantitas_'+id_barang).html(kuantias_baru );
                    //     $('#form_kuantitas_'+id_barang).val(kuantias_baru );
               
                  
                    // }
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
