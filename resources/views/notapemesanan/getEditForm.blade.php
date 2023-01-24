<form action="{{ route('notapemesanan.update',$data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Nota Pemesanan</h4>
</div>
@csrf
@method('PUT')
<div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label>Nomor Nota</label>
                <input id="eNonota" type="text" name="no_nota" class="form-control" value='{{$data->no_nota}}' readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Pembuatan Nota</label>
                {{-- <td>
                    <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                        <input id="eTglPembuatanNota" type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </td> --}}
                <div>
                    <input type="date" value="{{ $data->tgl_pembuatan_nota }}" name="tanggal_pembuatan_nota" class="form-control input-sm"required  readonly/>
                </div>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select class="form-control" name="supplier" id="eSupplier">
                    @foreach ($supplier as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data->supplier_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            @foreach ($data->barang as $key =>$item)
            <div class="form-group barang_{{ $key+1  }}">
                <label>Bahan {{ $key+1 }}</label>
                <button type="button"  idx="{{ $key+1 }}"  class="btn btn-success hapus">Hapus</button>
            </div>
            <div class="form-group barang_{{ $key+1  }}">
                <label>Nama Bahan Baku </label>
                <select class="form-control" name="barang[{{$key+1}}][barang_id]" id="bahan_baku_{{ $key+1  }}">
                    <!-- seharusnya dikasih where jenis==barang jadi -->
                    @foreach ($barang as $barangs)
                    <option value="{{ $barangs->id }}" harga="{{$barangs->harga}}"  {{ $barangs->id == $item->id ? 'selected' : '' }} >{{ $barangs->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group barang_{{ $key+1  }}">
                <label>Harga per-satuan</label>
                <input type="text" name="barang[{{$key+1}}][harga]" class="form-control" id='harga_{{ $key+1 }}' value="{{$item->pivot->harga}}" readonly required>
            </div>

            <div class="form-group barang_{{ $key+1  }}">
                <label>Kuantitas</label>
                <input type="text" name="barang[{{$key+1}}][kuantitas]" class="form-control" id='kuantitas' value="{{$item->pivot->kuantitas}}" required>
    
            </div>
            @endforeach
            <div id="new">

            </div>

            <button type="button" id="tambah" class="btn btn-success">Tambah Barang</button>
        </div>
        
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</form>

{{-- @section('javascript') --}}
<script>
    var locations = [
              @foreach ($data->barang as $key => $item)
              [ "{{ $item->id }}"], 
              @endforeach
    ];
        //   alert(locations);
    
    var barang_now = locations.length;
    // alert(barang_now);
    function update(){
        for (let index = 1; index <= barang_now; index++) {
        // const element =  locations[index];
        // alert(index+1);
        var id = '#bahan_baku_'+index;
        $(id).change(function() {
            var ids = $(this).find(':selected').attr('harga');
                //   alert(ids);
            var id_har = '#harga_'+index;
            $(id_har).val(ids);
        });
        // Detelte
        var id_delte= "#hapus_"+index;
       
    }
    };
    $(".hapus").on('click', function() {
        var ids = $(this).attr('idx');
        // alert(ids);
        var class_ = '.barang_'+ids;
        $(class_).remove();
        // barang_now--;
            update();
    });
    update();
    $('#tambah').on('click', function() {
        barang_now++;
        var inputbarang =  '<div class="form-group bahan_'+ barang_now +'"><label>Bahan '+barang_now+'</label></div> ' +   
        '<div class="form-group '+ barang_now +'"><select class="form-control" name="barang['+barang_now+'][barang_id]" id="bahan_baku_'+barang_now+'"> @foreach ($barang as $barangs) <option value="{{ $barangs->id }}" harga="{{$barangs->harga}}" >{{ $barangs->nama}}</option> @endforeach  </select></div>'+
        '<div class="form-group '+ barang_now +'"><label>Harga per-satuan</label> <input type="text" name="barang['+barang_now+'][harga]" id="harga_'+barang_now+'" class="form-control" readonly required></div>' +
        '<div class="form-group '+ barang_now +'"><label>Kuantitas</label> <input type="text" name="barang['+barang_now+'][kuantitas]" class="form-control" id="harga_'+barang_now+'" required></div>'  ;
        $('#new').append(inputbarang);
        update();
    });
    

   
   
</script>
{{-- @endsection --}}