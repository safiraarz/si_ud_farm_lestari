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
                                <th>Karantina</th>
                                <th>Afkir</th>
                                <th>Kematian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" name="karantina" id="karantina" min="0" value="0"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="number" name="afkir" id="afkir" min="0" value="0"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="number" name="kematian" id="kematian" min="0" value="0"
                                        class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <tbody>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <input type="text" id="keterangan" class="form-control">
                                </td>

                            </tr>
                            <tr>
                                <th>Flok</th>
                                <td>
                                    <select id="flok" class="form-control">
                                        @foreach ($flok as $row)
                                            <option id={{ $row->id }} value="{{ $row->id }}"
                                                class="barang custom-select">
                                                {{ $row->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <tbody>
                            <tr>
                                <th>Nama Telur</th>
                                <td>
                                    <select name="nama_telur" id="nama_telur" class="form-control">
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

                            </tr>
                            <tr>
                                <th>Kuantitas Bersih</th>
                                <td>
                                    <input type="number" name="kuantitas_bersih" id="kuantitas_bersih" min="0"
                                        value="0" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Kuantitas Reject</th>
                                <td>
                                    <input type="number" name="kuantitas_reject" id="kuantitas_reject" min="0"
                                        value="0" class="form-control">
                                </td>
                            </tr>
                            <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                        </tbody>
                    </table>
                    <div role="alert" id="errorMsg" class="mt-5 errorMsg">
                        <!-- Error msg  -->
                    </div>
                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('pemasukantelur.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <input type="hidden" name="karantina" id="karangtina_input">
                        <input type="hidden" name="afkir" id="afkir_input">
                        <input type="hidden" name="kematian" id="kematian_input">
                        <input type="hidden" name="keterangan" id="keterangan_input">
                        <input type="hidden" name="flok" id="flok_input">
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Pemasukan Telur</h4>
                            </div>
                            <div class="row">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>Tanggal Pencatatan</span> : <span
                                        id="tgl_pencatatan">{{ $date_now }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Telur</th>
                                            <th>Kuantitas Bersih</th>
                                            <th>Kuantitas Reject</th>
                                            <th>Kuantitas Total</th>
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
@endsection

@section('javascript')
<script>
        function thousands_separators(num) {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }
        // $('#barang').change(function() {
        //     var ids = $(this).find(':selected').attr('harga');
        //     $('#harga').val(ids);
        // });
        // var count = 1;
        // if (count != 1) {

        // };
        function deleteData(id)
        {
            $('#row_'+id).html("");
        };
        function isEmpty( el ){
      return !$.trim(el.html())
  };
        var count = 1;
        $('#tambah').on('click', function() {

            $("#karangtina_input").val($("#karantina").val())
            $("#afkir_input").val($("#afkir").val());
            $("#kematian_input").val($("#kematian").val());
            $("#keterangan_input").val($("#keterangan").val());
            var flok = $('#flok').find(':selected').val();
            $("#flok_input").val(flok);

            $("#karantina").disable = true;
            $("#afkir").disable = true;
            $("#kematian").disable = true;

            var nama_telur = $('#nama_telur').val();
            var kuantitas_bersih = $('#kuantitas_bersih').val();
            var kuantitas_reject = $('#kuantitas_reject').val();
            var kuantitas_total = parseInt(kuantitas_bersih) + parseInt(kuantitas_reject);
            var satuan = $('#nama_telur').find(':selected').attr('satuan');
            // alert(nama_telur + kuantitas_total + satuan);

            var tgl_pencatatan = $('#tgl_pencatatan').val();
            var keterangan = $('#keterangan').val();

            if (parseInt(kuantitas_total) <= 0 || kuantitas_total == '' || parseInt(kuantitas_bersih) <= 0 || kuantitas_bersih == '' || parseInt(kuantitas_reject) <= 0 || kuantitas_reject  == '') {
                var erroMsg =
                    '<span class="alert alert-danger ml-5">Kuantitas Kurang Dari 0 Atau Huruf</span>';
                    $('.errorMsg').show();
                    $('.errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                // alert("masuk")
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                $("#receipt_bill").each(function() {
                    var id_telur = $('#nama_telur').find(':selected').attr('id');
                    // alert(satuan+id_telur);
                    // masi error
                    var table = '<tr id="row_'+ id_telur+'">' +
                        
                        '<td>' + nama_telur + '<input type="hidden" name="telur[' + count +
                        '][' + "id_telur" + ']" value=' + id_telur + '></td>' +
                        '<td>' + '<p id="label_kuantitas_bersih_' + id_telur + '">' + thousands_separators(kuantitas_bersih) + '</p>'+
                        '<input id="form_kuantitas_bersih_' + id_telur + '" type="hidden" name="telur[' + count + '][' +"kuantitas_bersih" + ']" value=' + kuantitas_bersih + '>'+
                        '</td>' +
                        '<td>' + '<p id="label_kuantitas_reject_' + id_telur + '">' + thousands_separators(kuantitas_reject) + '</p>'+
                        '<input id="form_kuantitas_reject_' + id_telur + '" type="hidden" name="telur[' + count + '][' +"kuantitas_reject" + ']" value=' + kuantitas_reject + '>'+
                        '</td>' +
                        '<td>'  + '<p id="label_kuantitas_total_' + id_telur + '">' + thousands_separators(kuantitas_total) + '</p>'+
                        '<input id="form_kuantitas_total_' + id_telur + '" type="hidden" name="telur[' + count + '][' + "kuantitas_total" +']" value=' + kuantitas_total + '>'+
                        '</td>' +
                        '<td>' + satuan + '<input type="hidden" name="telur[' + count + '][' +
                        "satuan" + ']" value=' + satuan + '></td>' +
                        '<td><a class="btn btn-danger barang_delete" onclick="deleteData('+id_telur+')"><i class="fa fa-trash-o"></i></a></a></td>'+
                        '</tr>';
                    // alert(table);
                    var id_row = '#row_'+id_telur;
                    if(isEmpty($(id_row))){
                        $('#new').append(table);
                    }
                    else{
                        var kuantitas_bersih_lama = $('#form_kuantitas_bersih_'+id_telur).val();
                        var kuantitas_reject_lama = $('#form_kuantitas_reject_'+id_telur).val();

                        var kuantias_bersih_baru = parseInt(kuantitas_bersih_lama) + parseInt(kuantitas_bersih);
                        var kuantias_reject_baru = parseInt(kuantitas_reject_lama) + parseInt(kuantitas_reject);
                        var kuantias_total_baru = parseInt(kuantias_bersih_baru) + parseInt(kuantias_reject_baru);

                        $('#label_kuantitas_bersih_'+id_telur).html(kuantias_bersih_baru);
                        $('#form_kuantitas_bersih_'+id_telur).val(kuantias_bersih_baru);
                        $('#label_kuantitas_reject_'+id_telur).html(kuantias_reject_baru);
                        $('#form_kuantitas_reject_'+id_telur).val(kuantias_reject_baru);
                        $('#label_kuantitas_total_'+id_telur).html(kuantias_total_baru);
                        $('#form_kuantitas_total_'+id_telur).val(kuantias_total_baru);
                  
                    }
                    
                });
                count++;
            }
        });
</script>
@endsection
