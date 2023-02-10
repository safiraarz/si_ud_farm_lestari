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
                                    <input type="text" id="keterangan"class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:45%">Nama Barang Jadi</th>
                                <th style="width:35%">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang_jadi" id="barang_jadi" class="form-control">
                                        <option id="" value="" class="barang custom-select">
                                            Silahkan Pilih Barang
                                        </option>
                                        @foreach($barang as $row )
                                        @if ($row->jenis == "Barang Jadi")
                                        <option id={{$row->id}} value="{{$row->nama}}" satuan="{{$row->satuan}}" ready="{{ $row->kuantitas_stok_ready }}" class="barang custom-select">
                                            {{$row->nama}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas_barang_jadi" min="0" value="0" class="form-control">
                                </td>
                                <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('suratjalan.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="keterangan_input" id="keterangan_input" >
                        
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Surat Jalan</h4>
                            </div>
                            <div class="row">
                                <input type="hidden" name="no_surat" value="{{ $no_surat_generator }}">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>No. Surat</span> : <span id="no_surat_span">{{ $no_surat_generator }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="tgl_pencatatan" value="{{ $date_now }}">
                                <div class="col-xs-6 col-sm-6 col-md-6 ">
                                    <span>Tgl Pencatatan</span> : <span id="no_nota_span">{{ $date_now }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <table id="receipt_bill" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang Jadi</th>
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

@endsection


@section('javascript')

<script>
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
        var count = 1;
        $('#tambah').on('click', function() {
            $("#pakan_ayam").disable = true;
            $("#keterangan_input").val( $("#keterangan").val())
            var nama_barang_jadi = $('#barang_jadi').val();
            var kuantitas_barang_jadi = $('#kuantitas_barang_jadi').val();
            var satuan_barang_jadi = $('#barang_jadi').find(':selected').attr('satuan');
            var id_barang_jadi = $('#barang_jadi').find(':selected').attr('id');

            if (kuantitas_barang_jadi <= 0) {
                var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                $("#receipt_bill").each(function() {

                    var table = '<tr>'+
                        '<td>' + count + '</td>'+
                        '<td>' + nama_barang_jadi + '<input type="hidden" name="barang_jadi[' + count +'][' + "id_barang_jadi" + ']" value=' + id_barang_jadi + '></td>'+
                        '<td>' + thousands_separators(kuantitas_barang_jadi) +'<input type="hidden" name="barang_jadi[' + count + '][' + "kuantitas" + ']" value=' + kuantitas_barang_jadi +'></td>'+
                        '<td>' + satuan_barang_jadi + '</td>'+
                        '</tr>';
                    $('#new').append(table);
                });
                count++;
            }
        });
        
</script>

@endsection