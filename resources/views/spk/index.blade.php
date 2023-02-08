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
                    <i class="fa fa-reorder"></i>Daftar Surat Perintah Kerja
                </div>
                <div class="actions">
                    <a href="{{ url('spk/create') }}" class="btn btn-info" type="button">Tambah Data</a>
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor SPK</th>
                            <th>Tanggal Pembuatan SPK</th>
                            <th>Daftar Barang</th>
                            <th>Keterangan</th>
                            <th>Pembuat Surat</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->id }}</td>
                                <td id='td_no_spk_{{ $d->id }}'>{{ $d->no_surat }}</td>
                                <td id='td_tgl_pembuatan_spk_{{ $d->id }}'>{{ $d->tgl_pembuatan_surat->format('d/m/Y')}}</td>
                                <td>
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
                                                        <b>
                                                            <span>- Barang {{ $key + 1 }}</span>
                                                        </b>
                                                        <p>
                                                            <span>Nama Barang</span> : <span> {{ $item->nama }}</span>
                                                        </p>
                                                        {{-- formatkan tgl ->format('d/m/Y')  --}}
                                                        <p>
                                                            <span>Tanggal Mulai Produksi</span> : <span>
                                                                {{ $item->pivot->tgl_mulai_produksi}}</span>
                                                        </p>
                                                        <p>
                                                            <span>Tanggal Selesai Produksi</span> : <span>
                                                                {{ $item->pivot->tgl_selesai_produksi}}</span>
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
                                <td id='td_keterangan_{{ $d->id }}'>{{ $d->keterangan }}</td>
                                <td id='td_pengguna_{{ $d->id }}'>{{ $d->pengguna->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                    type: 'POST',
                    url: '{{ route('spk.getEditForm') }}',
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
        $('#myTable').DataTable({
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
