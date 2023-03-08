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
                        {{number_format($totalPopulasiAyam) }}
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
                        Rp {{ number_format($totalNotaPembelian) }}
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
                        Rp {{ number_format($totalNotaPenjualan) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</div>
@endsection


@section('javascript')
<script>
    const ctx = document.getElementById('myChart');
    
new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
        @foreach ($hasil_produksi as $key => $item)
        @foreach ($item as $key2 => $item2)
        '{{  date("d-m-Y", strtotime($key2)) }}',
        @endforeach
        @endforeach
    ],
    datasets: [{
      label: 'Total Produksi Perhari',
      data: [
        @foreach ($hasil_produksi as $key => $item)
        @foreach ($item as $key2 => $item2)
        @if($item2 != 0)
        '{{  $item2 }}',
        @endif
        @endforeach
        @endforeach
    ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
@endsection