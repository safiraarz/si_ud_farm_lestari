@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Penutupan Periode
                </div>
            </div>
            <div class="portlet-body">
                <h3></h3>
                <blockquote>
                    <p>
                        Periode Aktif yang Sedang Berlangsung:
                    </p>
                    @foreach ($data as $d)
                        <small>{{ $d->tanggal_awal->format('d F Y') }} hingga
                            {{ $d->tanggal_akhir->format('d F Y') }}</small>
                    @endforeach
                </blockquote>
                <div>
                    <p>Apakah ingin menutup periode?</p>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Periode</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ubah Periode Aktif</button>
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
</div>
@section('javascript')
    <script>
        $('#myTable').DataTable({
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
