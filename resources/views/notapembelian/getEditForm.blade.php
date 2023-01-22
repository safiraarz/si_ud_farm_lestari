<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Nota Pembelian</h4>
</div>
<div class="modal-body">
    <form action="{{ route('notapembelian.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-group">
                <label>No Nota Pemesanan</label>
                <select class="form-control" name="nota_pemesanan" id="eNotaPemesanan">
                    @foreach ($notapemesanan as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data->nota_pemesanan_id ? 'selected' : '' }}>{{ $item->no_nota }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nomor Nota</label>
                <input id="eNoNota" type="text" name="no_nota" class="form-control" value='{{$data->no_nota}}'>
            </div>
            <div class="form-group">
                <label>Tanggal Pembuatan Nota</label>
                <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglPembuatanNota" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select class="form-control" name="supplier" id="eSupplier">
                    @foreach ($supplier as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data->supplier_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nama Bahan Baku</label>
                <select class="form-control" name="bahan_baku" id="bahan_baku">
                    <!-- seharusnya dikasih where jenis==barang jadi -->
                    @foreach ($barang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Harga per-satuan</label>
                <input type="text" name="harga" class="form-control" id='harga' required>
                </input>
            </div>

            <div class="form-group">
                <label>Kuantitas</label>
                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                </input>
            </div>
            <button type="tambah" class="btn btn-success">Tambah ke Nota</button>
        </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>