<div class="form-group row margin-top-20 mb-0">
    <p class="col-sm-2 control-label bold">Nama Pakan Ayam</p>
    <label class="col-sm2 control-label ">: {{ $nama_bahan }}</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label bold">Jumlah Produksi</label>
    <label class="col-sm2 control-label ">: {{ $total_produksi }}</label>
</div>

@foreach ($lfl as $bahanbaku)
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            @php
            $total_hari_produksi = count($bahanbaku['range_produksi']);
            $total_kolom = $total_hari_produksi + 2;
            if ($total_kolom % 3 == 0) {
            $colnama = $total_kolom / 3;
            $colkebutuhan = $total_kolom / 3;
            $collead = $total_kolom / 3;
            }else{
            if ($total_kolom % 3 == 1) {
            $colnama = (int)$total_kolom / 3;
            $colkebutuhan = (int)($total_kolom / 3) + 1;
            }elseif ($total_kolom % 3 == 2) {
            $colnama = (int)($total_kolom / 3) + 1;
            $colkebutuhan = (int)($total_kolom / 3) + 1;
            }
            $collead = (int)$total_kolom / 3;
            }
            @endphp
            <tr>
                <td colspan="{{ $colnama }}">
                    <span class="bold">Nama Bahan Baku :</span> {{ $bahanbaku['nama bahan baku'] }}
                </td>
                <td colspan="{{ $colkebutuhan }}">
                    <span class="bold">Kebutuhan Bahan Baku per Produksi :</span>
                    {{ $bahanbaku['kebutuhan bahan baku per produksi'] }}
                </td>
                <td colspan="{{ $collead }}">
                    <span class="bold">Lead Time :</span> {{ $bahanbaku['leadtime'] }}
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold" style="width: 5%">Tanggal</td>
                @foreach ($bahanbaku['range_produksi'] as $period)
                <td style="width: 10%">{{ date('d/m/y',strtotime($period))  }}</td>
                @endforeach
                <td style="width: 10%">Total</td>
            </tr>
            <tr>
                <td style="width: 5%">GR</td>
                @php
                $total_gr = 0;
                @endphp
                @foreach ($bahanbaku['perhitungan']['GR'] as $gr)
                <td style="width: 10%">{{ $gr }}</td>
                <?php $total_gr = $total_gr + $gr; ?>
                @endforeach
                <td>{{ $total_gr }}</td>
            </tr>
            <tr>
                <td style="width: 5%">SR</td>
                @foreach ($bahanbaku['perhitungan']['SR'] as $sr)
                <td style="width: 10%">{{ $sr }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 5%">OHI</td>
                @foreach ($bahanbaku['perhitungan']['OHI'] as $ohi)
                <td style="width: 10%">{{ $ohi }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 5%">NR</td>
                @foreach ($bahanbaku['perhitungan']['NR'] as $nr)
                <td style="width: 10%">{{ $nr }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 5%">POR</td>
                @foreach ($bahanbaku['perhitungan']['POR'] as $por)
                <td style="width: 10%">{{ $por }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 5%">PORel</td>
                @foreach ($bahanbaku['perhitungan']['PORel'] as $porel)
                <td style="width: 10%">{{ $porel }}</td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endforeach
