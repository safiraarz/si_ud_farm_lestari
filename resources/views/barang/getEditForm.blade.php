<form action="{{ route('barang.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Barang</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label>Nama Barang</label>
                <input id="nama" type="text" name="nama" class="form-control" placeholder="Generic Name" value='{{$data->nama}}'>
            </div>
            <div class="form-group">
                <!-- masi salah -->
                <label>Jenis</label>
                <select class="form-control" name="jenis" id="jenis">
                    <option value="Bahan Baku">Bahan Baku</option>
                    <option value="Bahan Jadi">Barang Jadi</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kuantitas Stok on Order Supplier</label>
                <input id="eKuantitas_stok_onorder_supplier" type="text" name="kuantitas_supplier" class="form-control" value='{{$data->kuantitas_stok_onorder_supplier}}'>
            </div>
            <div class="form-group">
                <label>Kuantitas Stok on Order Produksi</label>
                <input id="eKuantitas_stok_onorder_produksi" type="text" name="kuantitas_produksi" class="form-control" value='{{$data->kuantitas_stok_onorder_produksi}}'>
            </div>
            <div class="form-group">
                <label>Kuantitas Stok Pengaman</label>
                <input id="eKuantitas_stok_pengaman" type="text" name="kuantitas_pengaman" class="form-control" value='{{$data->kuantitas_stok_pengaman}}'>
            </div>
            <div class="form-group">
                <label>Kuantitas Stok Ready</label>
                <input id="eKuantitas_stok_ready" type="text" name="kuantitas_ready" class="form-control" value='{{$data->kuantitas_stok_ready}}'>
            </div>
            <div class="form-group">
                <label>Total Kuantitas Stok</label>
                <input id="eTotal_kuantitas_stok" type="text" id="total_kuantitas" name="total_kuantitas" class="form-control" value='{{$data->total_kuantitas_stok}}'>
            </div>
            <div class="form-group">
                <label>Harga per-Satuan</label>
                <input id="eHarga" type="text" name="harga" class="form-control" value='{{$data->harga}}'>
            </div>
            <!-- masi salah -->
            <div class="form-group">
                <label>Satuan</label>
                <select class="form-control" name="satuan" id="satuan">
                    <option value="kg">kg</option>
                    <option value="sak">sak</option>
                    <option value="pc">pc</option>
                </select>
            </div>
            <div class="form-group">
                <label>Lead Time</label>
                <input id="eLeadTime" type="text" name="lead_time" class="form-control" value='{{$data->lead_time}}'>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>


<script>
    $("#kuantitas_supplier").on('change', function() {
        $("#kuantitas_produksi").on('change', function() {
            $("#kuantitas_ready").on('change', function() {
                var total = parseInt($("#kuantitas_supplier").val()) + parseInt($("#kuantitas_produksi").val()) 
                + parseInt($("#kuantitas_pengaman").val())+ parseInt($("#kuantitas_ready").val());
                $('#total_kuantitas').val(total);
            })
        })
    });
</script>