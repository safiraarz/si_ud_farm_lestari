@extends('layout.conquer')
@section('content')
<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <h2>Daftar Nota Pembelian</h2>

    <div class="table">
        <div>
            <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Tambah Nota</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor Nota</th>
                    <th>Tanggal Pembuatan Nota</th>
                    <th>Nama Supplier</th>
                    <th>Total Harga</th>
                    {{-- <th></th> --}}
                    <th>Pembuat Nota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_no_nota_{{$d->id}}'>{{$d->no_nota}}</td>
                    <td id='td_tgl_pembuatan_nota_{{$d->id}}'>{{$d->tgl_pembuatan_nota}}</td>
                    <td id='td_supplier_{{$d->id}}'>{{$d->supplier->nama}}</td>
                    <td id='td_total_harga_{{$d->id}}'>Rp{{number_format($d->total_harga,2)}}</td>
                    {{-- <td> 
                        
                    </td> --}}
                    <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
                    <td>
                        <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a>
                        <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">No Nota : {{$d->no_nota}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($d->barang as $key =>$item)
                                        <p>
                                            <span>- Barang {{ $key+1 }}</span>

                                        </p>
                                        <p>
                                            <span>Nama Barang</span> : <span> {{$item->nama}}</span>

                                        </p>
                                        <p>
                                            <span>Harga</span> : <span> {{$item->harga}}</span>

                                        </p>
                                        <p>
                                            <span>Kuantitas</span> : <span> {{ $item->pivot->kuantitas }}</span>

                                        </p>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Edit --}}
                        {{-- <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- add new data -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Nota Pembelian</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('notapembelian.store') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                           
                        <div class="form-group">
                            <label>Nomor Nota Pembelian</label>
                            <input type="text" name="no_nota" class="form-control" value="{{  $no_nota_generator }}" id='kuantitas' readonly required>
                            </input>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembuatan Nota</label>
                            {{-- <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter" readonly name="order_date_from" placeholder="Pilih tanggal">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td> --}}
                            <div>
                                <input type="date" name="tanggal_pembuatan_nota" class="form-control input-sm" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Nota Pemesanan</label>
                            <select class="form-control" name="no_pesanan" id="no_pesanan">
                                <option value="">Silahkan Pilih Nomor Pesanan</option>
                                @foreach ($notapemesanan as $item)
                                <option value="{{ $item->id }}">{{ $item->no_nota}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label>Nama Supplier</label>
                            <select class="form-control" name="supplier" id="supplier" readonly>
                                @foreach ($supplier as $item)
                                <option value="{{ $item->id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div id="bahan_pesanan">

                        </div>
                        {{-- <div class="form-group">
                            <label>Nama Bahan Baku</label>
                            <select class="form-control" name="bahan_baku" id="bahan_baku">
                                <!-- seharusnya dikasih where jenis==bahan baku -->
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
                        </div> --}}
                        {{-- <button type="tambah" class="btn btn-success">Tambah ke Nota</button> --}}
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url('notapembelian')}}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id='modalContent'>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script>
   
    $("#no_pesanan").on('change', function () {
        $('#bahan_pesanan').html("");
        var notapemesanan = [
        @foreach ($notapemesanan as $item)
            [ 
                "{{ $item->id }}",
                [
                    @foreach ($supplier as $sup)
                        @if ($item->supplier_id == $sup->id)
                        "{{ $item->supplier_id  }}",
                        "{{ $sup->nama  }}",
                        @endif
                    @endforeach
                ],
                [
                @foreach ($item->barang as $barangs)
                [
                    "{{ $barangs->id }}",
                    "{{ $barangs->nama }}",
                    "{{ $barangs->pivot->harga }}",
                    "{{ $barangs->pivot->kuantitas }}",
                ],
                @endforeach
                ]
            ], 
        @endforeach
        ];
        var id_nota_pesanan = $(this).val();
        notapemesanan.forEach(element => {
            if(id_nota_pesanan == element[0]){
                // Show Supplier
                var supplier_html = '<div class="form-group"><label>Nama Supplier</label><select class="form-control" name="supplier_id" id="supplier"  readonly><option value="'+ element[1][0]+'" >'+ element[1][1] +'</option></select></div>'
                $('#bahan_pesanan').append(supplier_html);
                for (let index = 0; index < element[2].length; index++) {
                    const elements =  element[2][index];
                    var barang_id = elements[0];
                    var barang_name = elements[1];
                    var harga = elements[2];
                    var kuantitas = elements[3];
                    var barang_pesanan = 
                    '<div class="form-group bahan_'+ index +'"><label>Bahan '+parseInt(index+1)+'</label></div> ' +
                    '<div class="form-group"><label>Nama Bahan Baku</label><select class="form-control" name="barang['+ index +']['+ "bahan_baku" +']" id="bahan_baku"  readonly><option value="'+ barang_id +'" >'+ barang_name +'</option></select></div></div>' +
                    // '<div class="form-group"><label>Nama Bahan Baku</label><select class="form-control" name="bahan_baku" id="bahan_baku" readonly>@foreach ($supplier as $item)<option value="{{ $item->id }}">{{ $item->nama}}</option>@endforeach</select></div>' +
                    '<div class="form-group"><label>Harga per-satuan</label><input type="text" name="barang['+ index +']['+ "harga" +']" class="form-control" id="harga" value="'+ harga+'" required  readonly></div>' +
                    '<div class="form-group"><label>Kuantitas</label><input type="text" name="barang['+ index +']['+ "kuantitas" +']" class="form-control" id="kuantitas" value="'+kuantitas+'" required></div>';
                    // alert(barang_pesanan);
                    $('#bahan_pesanan').append(barang_pesanan);
                    
                }
            }
            
        });
        
    })
    // document.cookie = "var1=22";
    function getEditForm(id) {
        $.ajax({
                type: 'POST',
                url: '{{route("notapembelian.getEditForm")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            },

        );
    };
</script>
@endsection