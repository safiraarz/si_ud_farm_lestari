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
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i>Daftar Nota Penjualan
            </div>
        </div>
        <div class="portlet-body">
            <table id='myTable' class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nomor Nota</th>
                        <th>Tanggal Pembuatan Nota</th>
                        <th>Nama Customer</th>
                        <th>Total Harga</th>
                        <th>Daftar Barang</th>
                        <th>Pembuat Nota</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr id='tr_{{$d->id}}'>
                        <td>{{$d->id}}</td>
                        <td id='td_no_nota_{{$d->id}}'>{{$d->no_nota}}</td>
                        <td id='td_tgl_pembuatan_nota{{$d->id}}'>{{$d->tgl_pembuatan_nota}}</td>
                        <td id='td_customer_{{$d->id}}'>{{$d->customer->nama}}</td>
                        <td id='td_total_harga_{{$d->id}}'>Rp{{number_format($d->total_harga,2)}}</td>
                        <td>
                            {{-- <a class="btn btn-default" data-toggle="modal" href="#detail_{{$d->id}}">Detail</a> --}}
                            <a class="btn btn-default edittable" data-toggle="modal" href="#detail_{{$d->id}}">
                                Detail
                            </a>
                            <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Nomor Nota : {{$d->no_nota}}</h4>
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
                                                <span>Harga</span> : <span> Rp{{number_format($item->harga,2)}}</span>
                                            </p>
                                            <p>
                                                <span>Kuantitas</span> : <span> {{ number_format($item->pivot->kuantitas) }}</span>
                                            </p>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td id='td_pengguna_{{$d->id}}'>{{$d->pengguna->nama}}</td>
                        <td id='td_status_{{$d->id}}'>{{$d->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    <div class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id='modalContent'>
            </div>
        </div>
    </div>
    @section('javascript')
    <script>
        $('#myTable').DataTable();
    </script>
    @endsection