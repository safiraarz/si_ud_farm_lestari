@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Daftar Bill of Material
                </div>
                <div class="actions">
                    <a href="{{ url('bom/create') }}" class="btn btn-info" type="button">Tambah Data</a>
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang Jadi</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Daftar Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            @foreach ($d->barang as $barang_bom)
                                @if ($barang_bom->jenis == 'Barang Jadi')
                                    <tr id='tr_{{ $d->id }}'>
                                        <td>{{ $d->id }}</td>
                                        <td id='td_nama_barang_jadi_{{ $d->id }}'>{{ $barang_bom->nama }}</td>
                                        <td id='td_kuantitas_{{ $d->id }}'>
                                            {{ number_format($d->kuantitas_barang_jadi) }}
                                        </td>
                                        <td id='td_barang_{{ $d->id }}'>{{ $barang_bom->satuan }}</td>
                                        <td> <a class="btn btn-default" data-toggle="modal"
                                                href="#detail_{{ $d->id }}">Detail</a>
                                        </td>
                                        <td>
                                            <a class='btn btn-danger btn-xs'
                                                onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{ $d->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            @foreach ($d->barang as $barang_bom)
                                                @if ($barang_bom->jenis == 'Barang Jadi')
                                                    <h4 class="modal-title">{{ $barang_bom->nama }}</h4>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="modal-body">
                                            <label for="">Bahan Baku</label>
                                            <br>
                                            <br>
                                            @foreach ($d->barang as $barang_bom)
                                                @if ($barang_bom->jenis == 'Bahan Baku')
                                                    Nama :
                                                    {{ $barang_bom->nama }}
                                                    <br>
                                                    Kuantitas :
                                                    {{ $barang_bom->pivot->kuantitas_bahan_baku }} {{ $barang_bom->satuan }}
                                                    <br>
                                                    <br>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('#myTable').DataTable();

        function getEditForm(id) {
            $.ajax({
                    type: 'POST',
                    url: '{{ route('bom.getEditForm') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
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
