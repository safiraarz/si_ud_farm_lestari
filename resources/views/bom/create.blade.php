@extends('layout.conquer')

@section('content')
    <section class="mt-3"style="display: none;">
        <div class="">
            {{-- <h4 class="text-center" style="color:green"> UD Farm Lestari </h4> --}}
            <div class="row">
                <div class="col-md-5 mt-4 ">
                    <table class="table" style="background-color:#e0e0e0;">
                        <thead>
                            <tr>
                                <th style="width:45%">Nama Pakan Ayam</th>
                                <th style="width:35%">Kuantitas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select id="nama_pakan_jadi" class="form-control">
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
                                    <input type="number" id="kuantitas_pakan_jadi" min="0" value="0"
                                        class="form-control">
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
                                    <select name="nama_bahan_baku" id="nama_bahan_baku" class="form-control">
                                        @foreach ($barang as $row)
                                            @if ($row->jenis == 'Bahan Baku')
                                                <option id={{ $row->id }} value="{{ $row->nama }}"
                                                    satuan="{{ $row->satuan }}" class="barang custom-select">
                                                    {{ $row->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="kuantitas_bahan_baku" min="0" value="0"
                                        class="form-control">
                                </td>
                                <td><button id="tambah" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
                    <form action="{{ route('bom.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <div class="p-4">
                            <div class="text-center">
                                <h4>Bill of Material</h4>
                            </div>
                            <div class="row">
                                <input type="hidden" name="nama_pakan_input" id="nama_pakan_input">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>Nama Pakan Ayam</span> : <span id="nama_pakan_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="kuantitas_pakan_input" id="kuantitas_pakan_input">
                                <div class="col-xs col-sm col-md text-right">
                                    <span>Kuantitas Pakan Ayam</span> : <span id="kuantitas_pakan_span"></span>
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
@endsection

<script>
    $(document).ready(function() {
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
        var count = 1;
        // if (count != 1) {

        // };
        $('#tambah').on('click', function() {
            // $("#pakan_ayam").disable = true;
            var nama_pakan = $('#nama_pakan_jadi').val();
            var id_nama_pakan = $("#nama_pakan_jadi").find(':selected').attr('id');
            var kuantitas_pakan = $('#kuantitas_pakan_jadi').val();
            $("#nama_pakan_span").html(nama_pakan);
            $("#kuantitas_pakan_span").html(thousands_separators(kuantitas_pakan));
            $("#nama_pakan_input").val(id_nama_pakan);
            $("#kuantitas_pakan_input").val(kuantitas_pakan);


            //Get Bahan Baku 
            var nama_bahan_baku = $('#nama_bahan_baku').val();
            var kuantitas_bahan_baku = $('#kuantitas_bahan_baku').val();
            var satuan = $("#nama_bahan_baku").find(':selected').attr('satuan');
            var id_bahan_baku = $("#nama_bahan_baku").find(':selected').attr('id');


            if (kuantitas_bahan_baku == 0) {
                var erroMsg =
                    '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
                $('#errorMsg').html(erroMsg).fadeOut(9000);
            } else {
                billFunction(); // Below Function passing here 
            }

            function billFunction() {
                $("#receipt_bill").each(function() {
                    var table =
                        '<tr>' +
                        '<td>' + count + '</td>' +
                        '<td>' + nama_bahan_baku + '<input type="hidden" name="bahan_baku[' +
                        count + '][' + "id_bahan_baku" + ']" value=' + id_bahan_baku +
                        '></td>' +
                        '<td>' + thousands_separators(kuantitas_bahan_baku) +
                        '<input type="hidden" name="bahan_baku[' + count + '][' + "kuantitas" +
                        ']" value=' + kuantitas_bahan_baku + '></td>' +
                        '<td>' + satuan + '</td>' +
                        '</tr>';
                    // alert(table);
                    $('#new').append(table);
                });
                count++;
            }
        });
    });
</script>
