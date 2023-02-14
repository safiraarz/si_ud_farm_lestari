<form role="form" action="{{ route('supplier.update', $data->id)}}" method='POST'>
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Supplier {{$data->nama}}</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label>Alamat</label>
                <textarea type="text" rows="3" name="alamat" class="form-control" id='eAlamat' required>{{$data->alamat}}
                </textarea>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="nama" class="form-control" id='eNoTelp' value='{{$data->no_telepon}}' required>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
                <a href="{{url('supplier')}}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
            </div>
        </div>
    </div>
</form>