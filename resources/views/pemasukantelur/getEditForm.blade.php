<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Daftar Pemasukan Telur</h4>
</div>
<div class="modal-body">
    <form action="{{ route('pemasukantelur.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-group">
                <label>Jenis Telur</label>
                <select class="form-control" name="jenis_telur" id="eJenisTelur">
                    @foreach ($barang as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data->barang_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Asal Flok</label>
                <select class="form-control" name="jenis_telur" id="eFlok">
                    @foreach ($flok as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data->flok_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kuantitas Reject</label>
                <input type="text" name="kuantitas" class="form-control" id='eKuantitasReject' value='{{$data->kuantitas_reject}}' required>
                </input>
            </div>
            <div class="form-group">
                <label>Kuantitas Bersih</label>
                <input type="text" name="kuantitas" class="form-control" id='eKuantitasBersih' value='{{$data->kuantitas_bersih}}' required>
                </input>
            </div>
            <div class="form-group">
                <label>Total Kuantitas</label>
                <input type="text" name="kuantitas" class="form-control" id='eTotalKuantitas' value='{{$data->total_kuantitas}}' required>
                </input>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea id="eKeterangan" type="text" class="form-control" name="keterangan" required value='{{$data->keterangan}}'></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal Pencatatan</label>
                <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglPembuatanNota" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td>
            </div>
        </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>