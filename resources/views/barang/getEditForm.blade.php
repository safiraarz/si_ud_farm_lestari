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
                <label>Harga per-Satuan</label>
                <input id="eHarga" type="text" name="harga" class="form-control" value='{{$data->harga}}'>
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