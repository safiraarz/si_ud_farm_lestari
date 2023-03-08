<form role="form" action="{{ route('flok.update', $data->id) }}" method='POST'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit {{ $data->nama }}</h4>
    </div>
    <div class="modal-body">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-group">
                <label>Keterangan</label>
                <textarea type="text" maxlength="100" name="keterangan" class="form-control" id='eKeterangan'
                    placeholder="Masukkan keterangan" required>{{ $data->keterangan }}</textarea>
            </div>
            <div class="form-group">
                <label>Pakan</label>
                <select class='form-control select2' name='pakan'>
                    @foreach ($barang as $item)
                        @if ($item->jenis == 'Barang Jadi')
                            <option value="{{ $item->id }}" {{ $data->barang->id == $item->id ? ' selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Cage</label>
                <input type="text" maxlength="45" name="cage" class="form-control" id='eCage'
                    value='{{ $data->cage }}' placeholder="Masukkan nomor cage" required>
            </div>
            <div class="form-group">
                <label>Strain</label>
                <input type="text" maxlength="100" name="strain" class="form-control" id='eStrain'
                    value='{{ $data->strain }}' placeholder="Masukkan nama strain" required>
            </div>
            <div class="form-group">
                <label>Usia/Hari</label>
                <input type="text" maxlength="45" name="usia" class="form-control" id='eUsia'
                    value='{{ $data->usia }}' placeholder="Masukkan usia ayam" required>
            </div>
            <div class="form-group">
                <label>Kebutuhan Pakan Perhari</label>
                <input type="number" min="0" max="99999999999" name="kebutuhan_pakan" class="form-control"
                    id='eKebutuhanPakan' value='{{ $data->kebutuhan_pakan }}'
                    placeholder="Masukkan kebutuhan pakan 1 ekor ayam perhari dalam gram" required>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <select class='form-control select2' name='satuan' value='{{ $data->satuan }}'>
                    @foreach (['gr' => 'gr'] as $value => $Label)
                        <option value="{{ $value }}" {{ $data->satuan == $value ? 'selected' : '' }}>
                            {{ $Label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn btn-info">Submit</button>
                <a href="{{ url('flok') }}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
            </div>
        </div>
    </div>
</form>
