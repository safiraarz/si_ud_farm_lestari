<form role="form" action="{{ route('flok.update', $data->id)}}" method='POST'>
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
                <input type="text" name="keterangan" class="form-control" id='eKeterangan' value='{{$data->keterangan}}' required>
            </div>
            <div class="form-group">
                <label>Cage</label>
                <input type="text" name="cage" class="form-control" id='eCage' value='{{$data->cage}}' required>
            </div>
            <div class="form-group">
                <label>Strain</label>
                <input type="text" name="strain" class="form-control" id='eStrain' value='{{$data->strain}}' required>
            </div>
            <div class="form-group">
                <label>Usia</label>
                <input type="text" min="0" name="usia" class="form-control" id='eUsia' value='{{$data->usia}}' required>
            </div>
            <div class="form-group">
                <label>Kebutuhan Pakan</label>
                <input type="text" min="0" name="kebutuhan_pakan" class="form-control" id='eKebutuhanPakan' value='{{$data->kebutuhan_pakan}}' required>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <select class='form-control select2' name='satuan' value='{{$data->satuan}}'>
                    <option value="kg" selected="">kg</option>
                    <option value="sak" selected="">sak</option>
                    <option value="pc" selected="">pc</option>
                    <option value="pc" selected="">gr</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
                <a href="{{url('flok')}}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
            </div>
        </div>
    </div>
</form>