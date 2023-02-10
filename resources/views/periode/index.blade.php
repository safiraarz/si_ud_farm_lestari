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
                </div>
                <div class="portlet-body util-btn-margin-bottom-5">
                    <div class="clearfix">
                        <a href="#modalTutup" data-toggle='modal' class="btn btn-info" type="button">Tutup Periode</a>
                        <a href="#modalUbah" data-toggle='modal' class="btn btn-info" type="button">Ubah Periode
                            Aktif</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="modalUbah" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ubah Periode</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('periode') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Durasi bulan pada periode berikutnya</label>
                            <input type="number" min="1" name="periode" class="form-control" id='nama' required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ url('periode') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTutup" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tutup Periode</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('periode') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>Durasi bulan pada periode berikutnya</label>
                            <input type="number" min="1" name="periode" class="form-control" id='nama' required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ url('periode') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
