<div class="form-group row margin-top-20 mb-0">
    <p class="col-sm-2 control-label bold">Nama Pakan Ayam</p>
    <label class="col-sm-2 control-label ">: {{ $mrp->mps->barang->nama }}</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label bold">Jumlah Produksi</label>
    <label class="col-sm-2 control-label ">: {{ $mrp->mps->kuantitas_barang_jadi }}
        {{ $mrp->mps->barang->satuan }}</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label bold">Rentang Tanggal</label>
    <label class="col-sm-2 control-label ">: {{ date('d/m/y', strtotime($mrp->mps->tgl_mulai_produksi)) }} -
        {{ date('d/m/y', strtotime($mrp->mps->tgl_selesai_produksi)) }}</label>
</div>

<div id="tabellaporan">
    <div class="row">
        @foreach ($mrp->dmrp->groupBy('barang_id') as $lfl)
        <div class="col-sm-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td colspan="4" class="text-center">
                            <span class="bold">Nama Bahan Baku :</span> {{ $lfl[0]->barang->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>Kuantitas Kebutuhan Produksi</td>
                        <td>Kuantitas Pemesanan ke Supplier</td>
                        <td>Satuan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lfl as $item)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($item->periode)) }}</td>
                        <td>{{ $item->NR }}</td>
                        <td>{{ $item->PORel }}</td>
                        <td>{{ $item->barang->satuan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
