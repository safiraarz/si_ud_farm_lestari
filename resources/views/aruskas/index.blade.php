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
                        <p>
                            {{ $perid->tanggal_awal->format('d F Y') }} hingga
                            {{ $perid->tanggal_akhir->format('d F Y') }}
                        </p>
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
                                        Penerimaan Dari Pelanggan
                                    </td>
                                    <td style="width:35%">
                                        Rp {{  number_format($data['penerimaan_dari_pelanggan']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Pembayaran ke Pemasok
                                    </td>
                                    <td style="width:35%">
                                        Rp {{  number_format($data['pembayaran_ke_pemasok']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Pembayaran Ke Biaya-Biaya
                                    </td>
                                    <td style="width:35%">
                                        Rp {{  number_format($data['pembayaran_biaya_biaya']) }}
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
                                        Rp {{  number_format($data['pembelian_aset_tetap']) }}
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
                                        Rp {{  number_format($data['koreksi']) }}
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
                                        Saldo akhir kas  :
                                    </th>
                                    <th style="width:35%">
                                        Rp {{  number_format($data['saldo_akhir']) }}
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
