<div class="form-group row margin-top-20 mb-0">
    <p class="col-sm-2 control-label bold">Nama Pakan Ayam</p>
    <label class="col-sm-2 control-label ">: {{ $nama_bahan }}</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label bold">Jumlah Produksi</label>
    <label class="col-sm-2 control-label ">: {{ $total_produksi }} {{ $satuan_bahan_jadi }}</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label bold">Maksimal Jumlah Produksi Per Hari</label>
    <label class="col-sm-2 control-label ">: 3200 Kg</label>
</div>
@php
$arr_penampung_gr =[];
@endphp
@foreach ($lfl as $bahanbaku)
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <?php
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
            ?>
            <tr>
                <td colspan="{{ $colnama }}">
                    <span class="bold">Nama Bahan Baku :</span> {{ $bahanbaku['nama bahan baku'] }}
                </td>
                <td colspan="{{ $colkebutuhan }}">
                    <span class="bold">Kebutuhan Bahan Baku per Produksi :</span>
                    {{ $bahanbaku['kebutuhan bahan baku per produksi'] }} {{ $bahanbaku['satuan'] }}
                </td>
                <td colspan="{{ $collead }}">
                    <span class="bold">Lead Time :</span> {{ $bahanbaku['leadtime'] }} hari
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold" style="width: 11%">Tanggal</td>
                @foreach ($bahanbaku['range_produksi'] as $period)
                <td style="width: 10%" class="text-right">{{ date('d/m/y',strtotime($period))  }}</td>
                @endforeach
                <td style="width: 10%" class="text-right">Total</td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="Gross Requirement (Kebutuhan Kotor)">GR ({{ $bahanbaku['satuan'] }})</td>
                @php
                $total_gr = 0;
                @endphp
                @foreach ($bahanbaku['perhitungan']['GR'] as $gr)
                <td style="width: 10%" class="text-right">{{ $gr }}</td>
                <?php $total_gr = $total_gr + $gr; ?>
                @endforeach
                <?php $arr_penampung_gr[] = $total_gr; ?>
                <td class="text-right">{{ $total_gr }}</td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="Schedule Receipt (Penerimaan yang Dijadwalkan)">SR ({{ $bahanbaku['satuan'] }})</td>
                @foreach ($bahanbaku['perhitungan']['SR'] as $sr)
                <td style="width: 10%" class="text-right">{{ $sr }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="On Hand Inventory (Persediaan)">
                    OHI ({{ $bahanbaku['satuan'] }})</td>
                @foreach ($bahanbaku['perhitungan']['OHI'] as $ohi)
                <td style="width: 10%" class="text-right">{{ $ohi }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="Net Requirement (Kebutuhan Bersih)">NR ({{ $bahanbaku['satuan'] }})</td>
                @foreach ($bahanbaku['perhitungan']['NR'] as $nr)
                <td style="width: 10%" class="text-right">{{ $nr }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="Plan Order Receipt (Penerimaan Pemesanan yang Direncanaakan)">POR
                    ({{ $bahanbaku['satuan'] }})</td>
                @foreach ($bahanbaku['perhitungan']['POR'] as $por)
                <td style="width: 10%" class="text-right">{{ $por }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td style="width: 11%" data-toggle="tooltip" data-placement="top"
                    title="Plan Order Release (Pelepasan Pemesanan yang Direncanaakan)">PORel
                    ({{ $bahanbaku['satuan'] }})
                </td>
                @foreach ($bahanbaku['perhitungan']['PORel'] as $porel)
                <td style=" width: 10%" class="text-right">{{ $porel }}</td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endforeach
<div>
    @php
    $counter = 0;
    $total = 0;
    @endphp
    @foreach ($lfl as $bahanbaku)
    <p>Gross Requirement (Kebutuhan Kotor) {{ $bahanbaku['nama bahan baku'] }} : {{ $arr_penampung_gr[$counter] }}</p>
    @php
    $total += $arr_penampung_gr[$counter];
    $counter++;
    @endphp
    @endforeach
    <p>Total Gross Requirement (Kebutuhan Kotor) : {{ $total }}</p>
</div>
