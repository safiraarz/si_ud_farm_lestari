@extends('layout.conquer')
@section('content')
<div class="container">
    <h2>Material Requirement Planning</h2>

    <div class="form-group row">
        <label for="mps" class="col-sm-1 control-label">ID MPS</label>
        <div class="col-sm-3">
            <select name="mps" id="mps" class="form-control">
                @foreach ($mps as $item)
                <option value="{{ $item->id }}" class="custom-select">{{ $item->id }} - {{ $item->barang->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <button id="btnhitung" class="btn btn-secondary col-sm-2 margin-right-10">HITUNG</button>
        <button id="btnreset " class="btn btn-secondary col-sm-2 ">RESET</button>
    </div>
    <div id="perhitunganmrp">

    </div>

</div>
@endsection

@section('javascript')
<script>
    $('#btnhitung').click(function () {
        const idmps = $('#mps').val();

        $.ajax({
            type: 'POST',
            url: '{{route("mrp.getPerhitungMRP")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idmps': idmps
            },
            success: function (data) {
                $('#perhitunganmrp').html();
                $('#perhitunganmrp').html(data.msg);
            }
        });
    });

</script>
@endsection
