<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Surat Perintah Kerja</h4>
</div>
<div class="modal-body">
    <form action="{{ route('spk.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-group">
                <label>Nomor Surat Perintah Kerja</label>
                <input id="eNoNota" type="text" name="no_surat" class="form-control" value='{{$data->no_surat}}'>
            </div>
            <div class="form-group">
                <label>Tanggal Pembuatan SPK</label>
                <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglPembuatanSPK" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td>
            </div>
            <div class="form-group">
                <label>Tanggal Mulai Produksi</label>
                <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglMulaiProduksi" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td>
            </div>
            <div class="form-group">
                <label>Tanggal Selesai Produksi</label>
                <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglSelesaiProduksi" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea type="text" class="form-control" name="keterangan" id='eKeterangan' value='{{$data->keterangan}}'></textarea>
            </div>

            <div class="form-group">
                <label>Nama Barang Jadi</label>
                <select class="form-control" name="bahan_baku" id="bahan_baku">
                    <!-- seharusnya dikasih where jenis==barang jadi -->
                    @foreach ($barang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kuantitas</label>
                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                </input>
            </div>
            <button type="tambah" class="btn btn-success">Tambah ke Tabel</button>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>