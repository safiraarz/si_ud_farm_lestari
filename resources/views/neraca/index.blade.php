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
                                @foreach ($data['aset'] as $item)
                                <tr>
                                    <td style="width:65%">
                                        {{ $item['nama_akun'] }}
                                    </td>
                                    <td style="width:35%">
                                        {{ number_format($item['saldo']) }}
                                    </td>
                                </tr>
                                @endforeach
                                
                               
                            </tbody>
                            {{-- <thead>
                                <tr>
                                    <th style="width:65%">
                                        NILAI BUKU PERALATAN
                                    </th>
                                    <th style="width:35%">Rp 15.000.000</th>
                                </tr>
                            </thead> --}}
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
                                        Rp {{ number_format($data['total_aset']) }}
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
                                @foreach ($data['kewajiban'] as $item)
                                <tr>
                                    <td style="width:65%">
                                        {{ $item['nama_akun'] }}
                                    </td>
                                    <td style="width:35%">
                                        {{ number_format($item['saldo']) }}
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL KEWAJIBAN
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['total_kewajiban']) }}
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
                                @foreach ($data['ekuitas'] as $item)
                                <tr>
                                    <td style="width:65%">
                                        {{ $item['nama_akun'] }}
                                    </td>
                                    <td style="width:35%">
                                        {{ number_format($item['saldo']) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL EKUITAS
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['total_ekuitas']) }}
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
                                        Rp {{ number_format($data['total_pasiva']) }}
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
