@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Laporan Laba Rugi
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
                
                {{-- @foreach ($data as $item) --}}
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        PENDAPATAN 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['pendapatan'] as $pendapatan)
                                <tr>
                                    <td style="width:65%">
                                        {{  $pendapatan['nama_akun'] }}
                                    </td>
                                    <td style="width:35%">
                                        Rp  {{  number_format($pendapatan['saldo']) }}
                                    </td>
                                </tr>
                    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL PENDAPATAN
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['total_pendapatan']) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                {{-- @endforeach --}}
                

                <div class="row">
                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        BIAYA
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['biaya'] as $pendapatan)
                                <tr>
                                    <td style="width:65%">
                                        {{  $pendapatan['nama_akun'] }}
                                    </td>
                                    <td style="width:35%">
                                        Rp  {{  number_format($pendapatan['saldo']) }}
                                    </td>
                                </tr>
                    
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        TOTAL BIAYA
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['total_biaya']) }}
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
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        LABA/RUGI
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['laba_rugi']) }}
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
