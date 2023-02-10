@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Laporan Neraca
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
                                        AKTIVA (ASET)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Kas di Tangan
                                    </td>
                                    <td style="width:35%">
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Kas di Bank
                                    </td>
                                    <td style="width:35%">
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Peralatan
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
                            <thead>
                                <tr>
                                    <th style="width:65%">
                                        NILAI BUKU PERALATAN
                                    </th>
                                    <th style="width:35%">Rp 15.000.000</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL AKTIVA (ASET)
                                    </th>
                                    <th style="width:35%">
                                        Rp 30.000.000
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        KEWAJIBAN
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Hutang Bahan Baku
                                    </td>
                                    <td style="width:35%">
                                        Rp 2.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Hutang DOC
                                    </td>
                                    <td style="width:35%">
                                        Rp 3.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL BIAYA
                                    </th>
                                    <th style="width:35%">
                                        Rp 5.000.000
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        EKUITAS
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Modal UD Farm Lestari
                                    </td>
                                    <td style="width:35%">
                                        Rp 25.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL EKUITAS
                                    </th>
                                    <th style="width:35%">
                                        Rp 25.000.000
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL PASIVA (KEWAJIBAN+EKUITAS)
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
