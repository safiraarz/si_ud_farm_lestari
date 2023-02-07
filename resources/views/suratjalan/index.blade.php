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
                    <i class="fa fa-reorder"></i>Daftar Surat Jalan
                </div>
                <div class="actions">
                    <a href="{{ url('suratjalan/create') }}" class="btn btn-info" type="button">Tambah Data</a>
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Pengiriman Barang</th>
                            <th>Keterangan</th>
                            <th>Daftar Barang</th>
                            <th>Pembuat Surat</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_no_surat_{{ $d->id }}'>{{ $d->no_surat }}</td>
                                <td id='td_tgl_pengiriman_barang_{{ $d->id }}'>{{ $d->tgl_pengiriman_barang }}</td>
                                <td id='td_keterangan_{{ $d->id }}'>{{ $d->keterangan }}</td>
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

                                                    @foreach ($d->daftar_barang as $key => $item)
                                                        <p>
                                                            <span>- Barang {{ $key + 1 }}</span>

                                                        </p>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>

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
                                <!-- <td>
                            <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{ $d->id }})">EDIT</a>
                        </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                <div class="modal-body">
                    <form action="{{ url('suratjalan') }}" class="form-horizontal" method='POST'>
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nomor Surat Jalan:</label>
                                <input type="text" name="no_surat" class="form-control" id='kuantitas' required>
                                </input>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pengiriman Barang:</label>
                                <td>
                                    <div class="input-group input-group-sm date date-picker margin-bottom-5"
                                        data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter" readonly
                                            name="order_date_from" placeholder="Pilih tanggal">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i
                                                    class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </td>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" id='keterangan'></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang Jadi</label>
                                <select class="form-control" name="barang_jadi" id="barang_jadi">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <input type="text" name="kuantitas" class="form-control" id='kuantitas' required>
                                </input>
                            </div>
                            <button type="tambah" class="btn btn-success">Tambah ke Tabel</button>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ url('suratjalan') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
        $('#myTable').DataTable({
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
