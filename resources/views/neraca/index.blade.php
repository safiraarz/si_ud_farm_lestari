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
                                    <td>
                                        Kas di Tangan
                                    </td>
                                    <td>
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Kas di Bank
                                    </td>
                                    <td>
                                        Rp 20.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Peralatan
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
                            <thead>
                                <tr>
                                    <th>
                                        NILAI BUKU PERALATAN
                                    </th>
                                    <th>Rp 15.000.000</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>
                                        TOTAL AKTIVA (ASET)
                                    </th>
                                    <th>
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
                                    <td>
                                        Hutang Bahan Baku
                                    </td>
                                    <td>
                                        Rp 2.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Hutang DOC
                                    </td>
                                    <td>
                                        Rp 3.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        TOTAL BIAYA
                                    </th>
                                    <th>
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
                                    <td>
                                        Modal UD Farm Lestari
                                    </td>
                                    <td>
                                        Rp 25.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        TOTAL EKUITAS
                                    </th>
                                    <th>
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
                                    <th>
                                        TOTAL PASIVA (KEWAJIBAN+EKUITAS)
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
