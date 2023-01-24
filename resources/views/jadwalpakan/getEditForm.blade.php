<form action="{{ route('jadwalpakan.update', $data->created_at) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Jadwal Pakan</h4>
    </div>
    <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Jenis Pakan</label>
                    <select class="form-control" name="jenis_pakan" id="eJenisTelur">
                        @foreach ($barang as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $data->barang_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Asal Flok</label>
                    <select class="form-control" name="asal_flok" id="eFlok">
                        @foreach ($flok as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $data->flok_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Total Kuantitas</label>
                    <input type="text" name="kuantitas" class="form-control" id='kuantitas' value='{{$data->kuantitas}}' required>
                    </input>
                </div>
              
                <div class="form-group">
                    <label>Tanggal Pemberian</label>
           
                    <div>
                        <input type="date" value="{{ $data->tgl_pemberian }}" name="tgl_pemberian" class="form-control input-sm"required />
                    </div>
                </div>
            </div>
    
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>