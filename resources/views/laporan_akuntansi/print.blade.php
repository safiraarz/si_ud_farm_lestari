<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <style>
        table, th, td {
  border: 1px solid;
}
    </style>
    <title>Hello, world!</title>
</head>

<body>
    <h1>Periode {{ $nama_periode }}</h1>
    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Jurnal Umum</h2>
        <table class="table table-striped table-hover" id="jurnal_umum">
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
            @foreach ($jurnals as $jurnal)
            @if ($jurnal->jenis == "umum")
            <tbody>
                <tr>

                    <td rowspan="{{ count($jurnal->akun) + 1  }}">

                        {{ date('d/m/y', strtotime($jurnal->tanggal_transaksi)) }}
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

    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Jurnal Penutup</h2>
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
            @foreach ($jurnals as $jurnal)
            @if ($jurnal->jenis == "penutup")
            <tbody>
                <tr>

                    <td rowspan="{{ count($jurnal->akun) + 1  }}">

                        {{ date('d/m/y', strtotime($jurnal->tanggal_transaksi)) }}
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


    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Laba Rugi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        PENDAPATAN
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laba_rugi['pendapatan'] as $pendapatan)
                <tr>
                    <td style="width:65%">
                        {{ $pendapatan['nama_akun'] }}
                    </td>
                    <td style="width:35%">
                        Rp {{ number_format($pendapatan['saldo']) }}
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
                        Rp {{ number_format($laba_rugi['total_pendapatan']) }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Perubahan Ekuitas</h2>
        <table class="table">
            <thead>
                @foreach ($ekuitas['list'] as $item)
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
            <tfoot>
                <tr>
                    <th style="width:65%">
                        {{-- Ekuitas (Modal) pemilik per 01 Mar 2023 --}}
                    </th>
                    <th style="width:35%">
                        Rp {{ number_format($ekuitas['total']) }}
                    </th>
                </tr>
            </tfoot>
        </table>


    </div>


    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Neraca</h2>
        <table class="table" id="aktiva">
            <thead>
                <tr>
                    <th>
                        AKTIVA (ASET)
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($neraca['aset'] as $item)
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
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width:65%">
                        TOTAL AKTIVA (ASET)
                    </th>
                    <th style="width:35%">
                        Rp {{ number_format($neraca['total_aset']) }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        KEWAJIBAN
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($neraca['kewajiban'] as $item)
                <tr>
                    <td style="width:65%">
                        {{ $item['nama_akun'] }}
                    </td>
                    <td style="width:35%">
                        {{ number_format($neraca['saldo']) }}
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
                        Rp {{ number_format($neraca['total_kewajiban']) }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        EKUITAS
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($neraca['ekuitas'] as $item)
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
                        Rp {{ number_format($neraca['total_ekuitas']) }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <br>
        <table class="table">
            <tfoot>
                <tr>
                    <th style="width:65%">
                        TOTAL PASIVA (KEWAJIBAN+EKUITAS)
                    </th>
                    <th style="width:35%">
                        Rp {{ number_format($neraca['total_pasiva']) }}
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>

    <div style="display:block; clear:both; page-break-after:always;">
        <h2>Arus Kas</h2>

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
                        Rp {{ number_format($arus_kas['penerimaan_dari_pelanggan']) }}
                    </td>
                </tr>
                <tr>
                    <td style="width:65%">
                        Pembayaran ke Pemasok
                    </td>
                    <td style="width:35%">
                        Rp {{ number_format($arus_kas['pembayaran_ke_pemasok']) }}
                    </td>
                </tr>
                <tr>
                    <td style="width:65%">
                        Pembayaran Ke Biaya-Biaya
                    </td>
                    <td style="width:35%">
                        Rp {{ number_format($arus_kas['pembayaran_biaya_biaya']) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
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
                        Rp {{ number_format($arus_kas['pembelian_aset_tetap']) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
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
                        Rp {{ number_format($arus_kas['koreksi']) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table">
            <tfoot>
                <tr>
                    <th style="width:65%">
                        Saldo akhir kas :
                    </th>
                    <th style="width:35%">
                        Rp {{ number_format($arus_kas['saldo_akhir']) }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>