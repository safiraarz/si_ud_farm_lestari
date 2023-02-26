@extends('layout.conquer')
@section('content')
    <div class="page-container">
        <div class="col-md-12">
            @foreach ($data as $item)
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>{{ $item['nama_akun'] }}
                    </div>
                    <div class="tools">
                        <b>No Akun: {{ $item['no_akun'] }}</b>
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_5">

                        <tr>
                            <th rowspan="2">TANGGAL</th>
                            <th rowspan="2">KETERANGAN</th>
                            <th rowspan="2">NO.REF</th>
                            <th rowspan="2">DEBIT</th>
                            <th rowspan="2">KREDIT</th>
                            <th colspan="2">SALDO</th>
                            <th rowspan="2">NO.BUKTI</th>
                        </tr>
                        <tr>
                            <th>DEBIT</th>
                            <th>KREDIT</th>

                        </tr>
                        <tbody>
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    Saldo Awal
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    {{  number_format($item['saldo_awal_debet']) }}
                                </td>
                                <td>
                                    {{  number_format($item['saldo_awal_kredit']) }}
                                    
                                </td>
                                <td>
                                </td>
                            </tr>
                            @foreach ($item['list'] as $items)
                            {{-- <tr>
                               
                            </tr> --}}
                            <tr>
                                <td >
                                    {{  date('d/m/y', strtotime($items['tanggal'])) }}
                                </td>
                                <td >
                                    {{ $items['keterangan'] }}

                                </td>
                                <td>
                                    {{ $items['no_ref'] }}
                                </td>
                                <td>
                                    {{  number_format($items['debit']) }}
                                </td>
                                <td>
                                    {{  number_format($items['kredit']) }}
                                </td>
                                <td>
                                    {{  number_format($items['saldo_debit']) }}
                                </td>
                                <td>
                                    {{  number_format($items['saldo_kredit']) }}
                                    
                                </td>
                                <td>
                                    {{  $items['no_bukti'] }}
                                
                                </td>
                            </tr>
                           
                            @endforeach
                            <tr>
                                <td colspan="5" class=" text-right">
                                    Saldo Sebelum Closing
                                </td>
                              
                                <td colspan="3">
                                    {{  number_format($item['saldo_sebelum_closing']) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class=" text-right">
                                    Saldo Setelah Closing
                                </td>
                              
                                <td colspan="3">
                                    {{  number_format($item['saldo_setelah_closing']) }}
                                </td>
                            </tr>
                                

      
                           
                            
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
@endsection
@section('javascript')
@endsection
