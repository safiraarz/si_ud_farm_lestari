@extends('layout.conquer')

@section('content')
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
                                    <textarea type="text" rows=3 maxlength="150" id="keterangan" class="form-control"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:45%">Nama Bahan Baku</th>
                                <th style="width:35%">Kuantitas 
                                    <label for="" id="satuan" class="satuan">()</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="bahan_baku" id="bahan_baku" class="form-control">
                                        @foreach($barang as $row )
                                        @if ($row->jenis == "Bahan Baku")
                                        <option id={{$row->id}} value="{{$row->nama}}" satuan="{{$row->satuan}}" ready="{{$row->kuantitas_stok_ready}}" class="barang custom-select">
                                            {{$row->nama}} (Stok: {{ number_format($row->kuantitas_stok_ready) }} {{$row->satuan}})
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
                    <div role="alert" id="errorMsg" class="mt-5 errorMsg">
                        <!-- Error msg  -->
                    </div>
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
                                            <th style="width: 40%">Nama Bahan Baku</th>
                                            <th style="width: 40%">Kuantitas</th>
                                            <th style="width: 10%">Satuan</th>
                                            <th style="width: 10%">Action</th>
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

@endsection

@section('javascript')
<script>
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
        var count = 1;
        
        function deleteData(id)
        {
            $('#row_'+id).html("");
        };
        $('#bahan_baku').on('change', function() {
            var satuan = $(this).find(':selected').attr('satuan');
            $('.satuan').html("("+ satuan +")");
        });
        function isEmpty( el ){
            return !$.trim(el.html())
        };
        $('#tambah').on('click', function() {
            $("#pakan_ayam").disable = true;
            // Ketergangan
            $('#keterangan_input').val($('#keterangan').val());
            var id_bahan_baku = $('#bahan_baku').find(':selected').attr('id');
            var satuan_bahan_baku = $('#bahan_baku').find(':selected').attr('satuan');
            var nama_bahan_baku = $('#bahan_baku').val();
            var kuantitas_bahan_baku = $('#kuantitas_bahan_baku').val();
            var kuantitas_bahan_baku_ready = $('#bahan_baku').find(':selected').attr('ready');
            // alert(kuantitas_bahan_baku_ready)
         
            if ( parseInt(kuantitas_bahan_baku) <=0 || kuantitas_bahan_baku == '' ){
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar/stok kurang</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            }
            else if( parseInt(kuantitas_bahan_baku_ready) < parseInt(kuantitas_bahan_baku) || kuantitas_bahan_baku_ready == '' ){
                var erroMsg = '<span class="alert alert-danger ml-5">Pastikan input angka benar/stok kurang</span>';
                $('.errorMsg').show();
                $('.errorMsg').html(erroMsg).fadeOut(9000);
            }
            else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {

                $("#receipt_bill").each(function() {

                    var table = '<tr id="row_'+ id_bahan_baku +'" >'+
                        '<td>' + nama_bahan_baku + '<input type="hidden" name="bahan_baku[' + count +'][' + "id_bahan_baku" + ']" value=' + id_bahan_baku + '></td>'+
                        '<td>' + '<p id="label_kuantitas_' + id_bahan_baku + '">' + thousands_separators(kuantitas_bahan_baku) + '</p>'+
                        '<input id="form_kuantitas_' + id_bahan_baku + '" type="hidden" name="bahan_baku[' + count + '][' + "kuantitas" + ']" value=' + kuantitas_bahan_baku +'>'+
                        '</td>'+
                        '<td>' + satuan_bahan_baku + '</td>'+
                        '<td>' + '<a class="btn btn-danger barang_delete" onclick="deleteData('+id_bahan_baku+')"><i class="fa fa-trash-o"></i></a><td>' +
                        '</tr>';
                    
                    var id_row = '#row_'+id_bahan_baku;
                    if(isEmpty($(id_row))){
                        $('#new').append(table);
                    }
                    else{
                        var kuantitas_lama = $('#form_kuantitas_'+id_bahan_baku).val();

                        var kuantias_baru = parseInt(kuantitas_lama) + parseInt(kuantitas_bahan_baku);

                        $('#label_kuantitas_'+id_bahan_baku).html(kuantias_baru );
                        $('#form_kuantitas_'+id_bahan_baku).val(kuantias_baru );
               
                  
                    }
    
                });
                count++;
            }
        });
</script>

@endsection