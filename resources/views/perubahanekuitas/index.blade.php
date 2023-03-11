@extends('layout.conquer')
@section('content')
    <div class="container">

        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Laporan Perubahan Ekuitas
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
                                @foreach ($data['list'] as $item)
                                    <tr>
                                        <th style="width:65%">
                                            {{-- Ekuitas (Modal) pemilik per 1 Des 2022 --}}
                                            {{ $item['nama_akun'] }}
                                        </th>
                                        <td style="width:35%">
                                            Rp {{ number_format($item['saldo']) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </thead>
                            {{-- <tbody>
                                <tr>
                                    <td style="width:65%">
                                        Laba/Rugi
                                    </td>
                                    <td style="width:35%">
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:65%">
                                        Prive
                                    </td>
                                    <td style="width:35%">
                                        Rp 2.000.000,00
                                    </td>
                                </tr>
                            </tbody> --}}
                            <tfoot>
                                <tr>
                                    <th style="width:65%">
                                        Ekuitas (Modal) pemilik per {{ $perid->tanggal_akhir->format('d F Y') }}
                                    </th>
                                    <th style="width:35%">
                                        Rp {{ number_format($data['total']) }}
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
