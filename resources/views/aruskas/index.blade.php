@extends('layout.conquer')
@section('content')
    <div class="container">
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
                                    <th style="width:65%">
                                        Arus kas dari aktivitas operasional :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Pembayaran ke Supplier
                                    </td>
                                    <td style="width:35%">
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Pembayaran ke Biaya
                                    </td>
                                    <td style="width:35%">
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Pengembalian Pribadi Pemilik
                                    </td>
                                    <td style="width:35%">
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Akumulasi Penyusutan Peralatan
                                    </td>
                                    <td style="width:35%">
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
                                    <th style="width:65%">
                                        Arus Kas dari Aktivitas Investasi :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Pembelian Aset Tetap
                                    </td>
                                    <td style="width:35%">
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
                                    <th style="width:65%">
                                        Arus kas dari aktivitas lainnya :
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Koreksi
                                    </td>
                                    <td style="width:35%">
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
                                    <th style="width:65%">
                                        Saldo akhir kas per 31 Maret 2023 :
                                    </th>
                                    <th style="width:35%">
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
