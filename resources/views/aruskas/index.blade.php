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
                    <i class="fa fa-reorder"></i>Laporan Arus Kas
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Periode aktif saat ini:</h4>
                        @foreach ($periode as $pd)
                            <p>
                                {{ $pd->tanggal_awal->format('d F Y') }} hingga
                                {{ $pd->tanggal_akhir->format('d F Y') }}
                            </p>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Arus kas dari aktivitas operasional :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Pembayaran ke Supplier
                                    </td>
                                    <td>
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pembayaran ke Biaya
                                    </td>
                                    <td>
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pengembalian Pribadi Pemilik
                                    </td>
                                    <td>
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Akumulasi Penyusutan Peralatan
                                    </td>
                                    <td>
                                        Rp 5.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Arus Kas dari Aktivitas Investasi :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Pembelian Aset Tetap
                                    </td>
                                    <td>
                                        Rp 2.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Arus kas dari aktivitas lainnya :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Koreksi
                                    </td>
                                    <td>
                                        Rp 1.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <tfoot>
                                <tr>
                                    <th>
                                        Saldo akhir kas per 31 Maret 2023 :
                                    </th>
                                    <th>
                                        Rp 30.000.000
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
    </div>
    @section('javascript')
        <script>
            $('#myTable').DataTable();
        </script>
    @endsection
