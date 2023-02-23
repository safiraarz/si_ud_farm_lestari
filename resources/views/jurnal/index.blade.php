@extends('layout.conquer')
@section('content')
<div class="page-container">
    <div class="col-md-12">
        {{-- Umum --}}
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Jurnal Umum
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover" id="sample_5">
                    <thead>
                        <tr>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                                Nama Akun
                            </th>
                            <th class="hidden-xs">
                                No Ref
                            </th>
                            <th class="hidden-xs">
                                Debet
                            </th>
                            <th class="hidden-xs">
                                Kredit
                            </th>
                            <th class="hidden-xs">
                                No. Bukti
                            </th>
                        </tr>
                    </thead>
                    @foreach ($data as $jurnal)
                    @if ($jurnal->jenis == "umum")
                    <tbody>
                            <tr>

                                <td rowspan="{{ count($jurnal->akun) + 1  }}">

                                    {{ $jurnal->tanggal_transaksi }}
                                </td>
                                <td rowspan="{{ count($jurnal->akun) + 1  }}">
                                    {{ $jurnal->transaksi->keterangan }}
                                </td>
                            </tr>

                            @foreach ($jurnal->akun as $item)

                            <tr>

                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->no_akun }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_debit) }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_kredit) }}
                                </td>
                                <td>
                                    {{ $jurnal->no_bukti }}
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                    @endif

                    @endforeach

                </table>
            </div>
        </div>

        {{-- Penyesuaian --}}
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Jurnal Penyesuaian
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover" id="sample_5">
                    <thead>
                        <tr>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                                Nama Akun
                            </th>
                            <th class="hidden-xs">
                                No Ref
                            </th>
                            <th class="hidden-xs">
                                Debet
                            </th>
                            <th class="hidden-xs">
                                Kredit
                            </th>
                            <th class="hidden-xs">
                                No. Bukti
                            </th>
                        </tr>
                    </thead>
                    @foreach ($data as $jurnal)
                    @if ($jurnal->jenis == "penyesuaian")
                    <tbody>
                            <tr>

                                <td rowspan="{{ count($jurnal->akun) + 1  }}">

                                    {{ $jurnal->tanggal_transaksi }}
                                </td>
                                <td rowspan="{{ count($jurnal->akun) + 1  }}">
                                    {{ $jurnal->transaksi->keterangan }}
                                </td>
                            </tr>

                            @foreach ($jurnal->akun as $item)

                            <tr>

                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->no_akun }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_debit) }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_kredit) }}
                                </td>
                                <td>
                                    {{ $jurnal->no_bukti }}
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                    @endif

                    @endforeach
                </table>
            </div>
        </div>

        {{-- Penutupan --}}
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Jurnal Penutupan
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover" id="sample_5">
                    <thead>
                        <tr>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                                Nama Akun
                            </th>
                            <th class="hidden-xs">
                                No Ref
                            </th>
                            <th class="hidden-xs">
                                Debet
                            </th>
                            <th class="hidden-xs">
                                Kredit
                            </th>
                            <th class="hidden-xs">
                                No. Bukti
                            </th>
                        </tr>
                    </thead>
                    @foreach ($data as $jurnal)
                    @if ($jurnal->jenis == "penutup")
                    <tbody>
                            <tr>

                                <td rowspan="{{ count($jurnal->akun) + 1  }}">

                                    {{ $jurnal->tanggal_transaksi }}
                                </td>
                                <td rowspan="{{ count($jurnal->akun) + 1  }}">
                                    {{ $jurnal->transaksi->keterangan }}
                                </td>
                            </tr>

                            @foreach ($jurnal->akun as $item)

                            <tr>

                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->no_akun }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_debit) }}
                                </td>
                                <td>
                                    {{ number_format($item->pivot->nominal_kredit) }}
                                </td>
                                <td>
                                    {{ $jurnal->no_bukti }}
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                    @endif

                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
@endsection