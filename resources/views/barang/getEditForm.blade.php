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
                <label>Kuantitas On Order Produksi</label>
                <input type="number" min="0" max="999999999" id="edit_produksi" name="kuantitas_stok_onorder_produksi"
                    class="form-control" value='{{ $data->kuantitas_stok_onorder_produksi }}' required readonly>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Kuantitas On Order Supplier</label>
                <input type="number" min="0" max="999999999" id="edit_supplier" name="kuantitas_stok_onorder_supplier"
                    class="form-control" value='{{ $data->kuantitas_stok_onorder_supplier }}' required readonly>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Kuantitas Pengaman</label>
                <input type="number" min="0" max="999999999" id="edit_pengaman" name="kuantitas_stok_pengaman"
                    class="form-control" value='{{ $data->kuantitas_stok_pengaman }}' 
                    placeholder="Masukkan kuantitas pengaman" required>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Kuantitas Ready</label>
                <input type="number" min="0" max="999999999" id="edit_ready" class="form-control" name="kuantitas_stok_ready"
                value='{{ $data->kuantitas_stok_ready }}'
                    placeholder="Masukkan kuantitas ready" required>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Total Kuantitas</label>
                <input type="number" min="0" max="999999999" id="edit_total" class="form-control" name="total_kuantitas_stok"
                value='{{ $data->total_kuantitas_stok }}' required readonly>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Lead Time</label>
                <input id="eLeadTime" type="number" min="0" max="100" name="leadtime" class="form-control"
                    value='{{ $data->lead_time }}' placeholder="Masukkan lead time" required>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label>Harga per-Satuan</label>
                <input id="eHarga" type="number" min="0" max="99999999999" name="harga"
                    class="form-control" value='{{ $data->harga }}' placeholder="Masukkan harga per satuan" required>
            </div>
        </div>
        <input type="hidden" name="jenis" value="{{ $data->jenis }}">
        <input type="hidden" name="satuan" value="{{ $data->satuan }}">

        <div class="modal-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <a href="{{ url('barang') }}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
        </div>
    </div>
</form>


<script>
    $("#edit_pengaman").on('change', function() {
        var produksi = $("#edit_produksi").val();
        var supplier = $("#edit_supplier").val();
        var pengaman = $("#edit_pengaman").val();
        var ready = $("#edit_ready").val();
        var total = parseInt(produksi) + parseInt(supplier) + parseInt(pengaman) + parseInt(ready);
        $('#edit_total').val(total);
    });
    $("#edit_ready").on('change', function() {
        var produksi = $("#edit_produksi").val();
        var supplier = $("#edit_supplier").val();
        var pengaman = $("#edit_pengaman").val();
        var ready = $("#edit_ready").val();
        var total = parseInt(produksi) + parseInt(supplier) + parseInt(pengaman) + parseInt(ready);
        $('#edit_total').val(total);
    });
</script>
