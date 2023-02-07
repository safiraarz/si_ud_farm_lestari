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
                    <i class="fa fa-reorder"></i>Laporan Perubahan Ekuitas
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
                                        Ekuitas (Modal) pemilik per 1 Des 2022
                                    </th>
                                    <td>
                                        Rp 15.000.000,00</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Laba/Rugi
                                    </td>
                                    <td>
                                        Rp 15.000.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Prive
                                    </td>
                                    <td>
                                        Rp 2.000.000,00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        Ekuitas (Modal) pemilik per 01 Mar 2023
                                    </th>
                                    <th>
                                        Rp 28.000.000
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
