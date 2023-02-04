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
    <h2>Bill of Material</h2>
    <div class="table">
        <div>
            <a href="{{url('bom/create')}}" data-toggle='modal' class="btn btn-info" type="button">Tambah Data</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang Jadi</th>
                    <th>Kuantitas</th>
                    <th>Satuan</th>
                    <th></th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)

                @foreach($d->barang as $barang_bom)
                {{-- {{ $barang_bom->jenis }} --}}
                @if($barang_bom->jenis == "Barang Jadi")
                <tr id='tr_{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td id='td_nama_barang_jadi_{{$d->id}}'>{{$barang_bom->nama}}</td>
                    <td id='td_kuantitas_{{$d->id}}'>{{number_format($d->kuantitas_barang_jadi)}}</td>
                    <td id='td_barang_{{$d->id}}'>{{$barang_bom->satuan}}</td>
                    <td> <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a>
                        {{-- <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$barang_bom->nama}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <hr>
                                        @if($barang_bom->jenis == "Bahan Baku")
                                        {{$barang_bom->nama}}
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </td>
                    <td>
                        <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$d->id}})">EDIT</a>
                    </td>
                    <td>
                        <form method='POST' action="{{url('bom/'.$d->id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('Are you sure you wanna delete this data?')) return false;">
                        </form>
                        <a class='btn btn-danger btn-xs' onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{$d->id}})">Delete 2</a>
                    </td>
                </tr>
  
                @endif

                

                @endforeach
                <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                @foreach($d->barang as $barang_bom)
                                
                                @if($barang_bom->jenis == "Barang Jadi")
                                {{-- {{$barang_bom->nama}} --}}
                                {{-- aa --}}
                                <h4 class="modal-title">{{$barang_bom->nama}}</h4>
                                @endif
                                @endforeach

                            </div>
                            <div class="modal-body">
                                <label for="">Bahan Baku</label>
                                <br>
                                <br>
                                @foreach($d->barang as $barang_bom)
                                @if($barang_bom->jenis == "Bahan Baku")
                                Nama :
                                {{$barang_bom->nama}}
                                <br>
                                Kuantitas :
                                {{$barang_bom->pivot->kuantitas_bahan_baku}}
                                <br>
                                <br>
                                @endif
                                @endforeach

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                <h4 class="modal-title">Tambah Nota</h4>
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
    function getEditForm(id) {
        $.ajax({
                type: 'POST',
                url: '{{route("bom.getEditForm")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            },

        );
    }
</script>
@endsection