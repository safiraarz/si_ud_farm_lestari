@extends('layout.conquer')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Daftar Nota Pemesanan
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor Nota</th>
                            <th>Tanggal Pembuatan Nota</th>
                            <th>Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Daftar Barang</th>
                            <th>Pembuat Nota</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_no_nota_{{ $d->id }}'>{{ $d->no_nota }}</td>
                                <td id='td_tanggal_pembuatan_nota_{{ $d->id }}'>{{ $d->tgl_pembuatan_nota }}</td>
                                <td id='td_supplier_{{ $d->id }}'>{{ $d->supplier->nama }}</td>
                                <td id='td_total_harga_{{ $d->id }}'>Rp{{ number_format($d->total_harga, 2) }}</td>
                                <td>
                                    {{-- <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a> --}}
                                    <a class="btn btn-default edittable" data-toggle="modal"
                                        href="#detail_{{ $d->id }}">
                                        Detail
                                    </a>
                                    <div class="modal fade" id="detail_{{ $d->id }}" tabindex="-1" role="basic"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Nomor Nota : {{ $d->no_nota }}</h4>
                                                </div>
                                                <div class="modal-body">

                                                    @foreach ($d->barang as $key => $item)
                                                        <p>
                                                            <span>- Barang {{ $key + 1 }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Harga</span> :
                                                            <span>Rp{{ number_format($item->harga, 2) }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Kuantitas</span> : <span>
                                                                {{ number_format($item->pivot->kuantitas) }}</span>

                                                        </p>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td id='td_pengguna_{{ $d->id }}'>{{ $d->pengguna->nama }}</td>
                                <td class='editable' id='td_status_{{ $d->id }}'>
                                    <select class="form-control status_option" name="status_option"
                                        notaid="{{ $d->id }}">
                                        @foreach (['dalam proses' => 'Dalam Proses', 'beli' => 'Beli', 'batal' => 'Batal'] as $value => $Label)
                                            <option value="{{ $value }}"
                                                {{ $d->status == $value ? 'selected' : '' }}>{{ $Label }}</option>
                                        @endforeach
                                    </select>
                                    {{-- {{$d->status}} --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id='modalContent'>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#myTable').DataTable();
        $('.status_option').change(function() {
            var id_nota = $(this).attr('notaid');
            var value_change = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('notapemesanan.saveDataField') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id_nota,
                    'fnama': 'status',
                    'value': value_change

                },
                success: function(data) {
                    alert(data.msg)
                }
            });
            // $('#harga').val(ids);
            // alert(ids);
        });
    </script>
@endsection

@section('initialscript')
    <script>
        var s_id = data.$el[0].id
        var fname = s_id.split('_')[1]
        var id = s_id.split('_')[2]
        $.ajax({
            type: 'POST',
            url: '{{ route('notapemesanan.saveDataField') }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'fnama': fname,
                'value': data.content

            },
            success: function(data) {
                alert(data.msg)
            }
        });
    </script>
@endsection
