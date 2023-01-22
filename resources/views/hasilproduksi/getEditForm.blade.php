<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Nota Pembelian</h4>
</div>
<div class="modal-body">
    <form action="{{ route('hasilproduksi.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <form action="{{ url('hasilproduksi') }}" class="form-horizontal" method='POST'>
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label>Nomor Surat Perintah Kerja:</label>
                        <select class="form-control" name="no_spk" id="no_spk">
                            @foreach ($spk as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $data->surat_perintah_kerja_id ? 'selected' : '' }}>{{ $item->no_surat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pencatatan:</label>
                        <td>
                            <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </td>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang Jadi:</label>
                        <select class="form-control" name="barang_jadi" id="barang_jadi">
                            @foreach ($barang as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $data->barang_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kuantitas Barang Reject:</label>
                        <input type="text" name="kuantitas" class="form-control" id='kuantitas' value='{{number_format($data->kuantitas_reject)}}' required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>Kuantitas Barang Bersih:</label>
                        <input type="text" name="kuantitas" class="form-control" id='kuantitas' value='{{number_format($data->kuantitas_bersih)}}' required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>Total Kuantitas:</label>
                        <input type="text" name="kuantitas" class="form-control" id='kuantitas' value='{{number_format($data->total_kuantitas)}}' required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>Keterangan:</label>
                        <textarea type="text" class="form-control" name="keterangan" id='keterangan' value='{{$data->keterangan}}'></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </form>
</div>