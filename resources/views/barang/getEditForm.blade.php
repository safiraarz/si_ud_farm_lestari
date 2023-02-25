<form action="{{ route('barang.update', $data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit {{ $data->nama }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label>Lead Time</label>
                <input id="eLeadTime" type="number" min="0" max="100" name="leadtime" class="form-control" value='{{ $data->lead_time }}' placeholder="Masukkan lead time" required>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Harga per-Satuan</label>
                <input id="eHarga" type="number" min="0" max="99999999999" name="harga" class="form-control" value='{{ $data->harga }}' placeholder="Masukkan harga per satuan" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <a href="{{ url('barang') }}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
        </div>
    </div>
</form>


<script>
    $("#kuantitas_supplier").on('change', function() {
        $("#kuantitas_produksi").on('change', function() {
            $("#kuantitas_ready").on('change', function() {
                var total = parseInt($("#kuantitas_supplier").val()) + parseInt($(
                        "#kuantitas_produksi").val()) +
                    parseInt($("#kuantitas_pengaman").val()) + parseInt($("#kuantitas_ready")
                        .val());
                $('#total_kuantitas').val(total);
            })
        })
    });
</script>
