@extends('layout.conquer')
@section('content')
<div class="container">
    @foreach ($periodeAkuntansi as $periode)
    <div class="alert alert-danger">
        Jangan lupa untuk tutup periode sebelum tanggal {{ $periode->tanggal_akhir->format('d M Y') }} !!
    </div>
    @endforeach
    <div class="row stats-overview-cont">
        <div class="col-md-4 col-sm-6">
            <div class="stats-overview stat-block">
                <div class="details">
                    <div class="title bold text-center">
                        Total Populasi Ayam
                    </div>
                    <div class="numbers text-center bold" style="margin-top:2rem; padding:1.25rem 0">
                        {{ $totalPopulasiAyam }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="stats-overview stat-block">
                <div class="details">
                    <div class="title bold text-center">
                        Total Transaksi Pembelian Bulan Ini
                    </div>
                    <div class="numbers text-center bold" style="margin-top:2rem; padding:1.25rem 0">
                        {{ $totalNotaPembelian }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="stats-overview stat-block">
                <div class="details">
                    <div class="title bold text-center">
                        Total Transaksi Penjualan Bulan Ini
                    </div>
                    <div class="numbers text-center bold" style="margin-top:2rem; padding:1.25rem 0">
                        {{ $totalNotaPenjualan }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
