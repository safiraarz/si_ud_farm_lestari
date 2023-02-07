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
            <tr>
                <td colspan="2">
                    <span class="bold">Nama Bahan Baku :</span> {{ $bahanbaku['nama bahan baku'] }}
                </td>
                <td colspan="2">
                    <span class="bold">Kebutuhan Bahan Baku per Produksi :</span>
                    {{ $bahanbaku['kebutuhan bahan baku per produksi'] }}
                </td>
                <td colspan="2">
                    <span class="bold">Lead Time :</span> {{ $bahanbaku['leadtime'] }}
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold" style="width: 5%">Tanggal</td>
                @foreach ($periods as $period)
                <td style="width: 10%">{{ $period }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">GR</td>
                @foreach ($bahanbaku['perhitungan']['GR'] as $gr)
                <td style="width: 10%">{{ $gr }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">SR</td>
                @foreach ($bahanbaku['perhitungan']['SR'] as $sr)
                <td style="width: 10%">{{ $sr }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">OHI</td>
                @foreach ($bahanbaku['perhitungan']['OHI'] as $ohi)
                <td style="width: 10%">{{ $ohi }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">NR</td>
                @foreach ($bahanbaku['perhitungan']['NR'] as $nr)
                <td style="width: 10%">{{ $nr }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">POR</td>
                @foreach ($bahanbaku['perhitungan']['POR'] as $por)
                <td style="width: 10%">{{ $por }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="width: 5%">PORel</td>
                @foreach ($bahanbaku['perhitungan']['PORel'] as $porel)
                <td style="width: 10%">{{ $porel }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endforeach
