<div class="portlet">
    <div class="portlet-title " >
        <div class="caption justify-content-around">
            <i class="fa fa-reorder"></i>Periode {{ $nama_periode }}
        </div>
        <div class="actions">
            <a href="/export/pdf/{{ $id }}">UNDUH PDF</a>
            {{-- <button type="button" id="unduh_pdf" filename="{{ $nama_periode }}" onClick="getPDF()" class="btn btn-info unduh_pdf">UNDUH PDF</button> --}}
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-xs-6">
                <h1>Jurnal Umum</h1>
             
            </div>
            <div class="col-xs-6">
                <h1>Jurnal Penutupan</h1>
             
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-6">
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

                                    {{  date('d/m/y', strtotime($jurnal->tanggal_transaksi)) }}
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
            <div class="col-xs-6">
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

                                    {{  date('d/m/y', strtotime($jurnal->tanggal_transaksi)) }}
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
        <br>
        
        {{--    --}}
        <div class="row">
            <div class="col-xs-6">
                <h1>Laba Rugi</h1>
             
            </div>
            <div class="col-xs-6">
                <h1>Perubahan Ekuitas</h1>
             
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-6">
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
                                {{  $pendapatan['nama_akun'] }}
                            </td>
                            <td style="width:35%">
                                Rp  {{  number_format($pendapatan['saldo']) }}
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                BIAYA
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laba_rugi['biaya'] as $pendapatan)
                 
                        <tr>
                            <td style="width:65%">
                                {{  $pendapatan['nama_akun'] }}
                            </td>
                            <td style="width:35%">
                                Rp  {{  number_format($pendapatan['saldo']) }}
                            </td>
                        </tr>
            
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width:65%">
                                TOTAL BIAYA
                            </th>
                            <th style="width:35%">
                                Rp {{ number_format($laba_rugi['total_biaya']) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <table class="table">
                    <tfoot>
                        <tr>
                            <th style="width:65%">
                                LABA/RUGI
                            </th>
                            <th style="width:35%">
                                Rp {{ number_format($laba_rugi['laba_rugi']) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-xs-6">
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
                                Rp {{  number_format($ekuitas['total']) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <br>
         {{--  Neraca dan Arus Kas   --}}
         <div class="row">
            <div class="col-xs-6">
                <h1>Neraca</h1>
             
            </div>
            <div class="col-xs-6">
                <h1>Arus Kas</h1>
             
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-6">
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
                                TOTAL BIAYA
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

            <div class="col-xs-6">
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
                                Rp {{  number_format($arus_kas['penerimaan_dari_pelanggan']) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:65%">
                                Pembayaran ke Pemasok
                            </td>
                            <td style="width:35%">
                                Rp {{  number_format($arus_kas['pembayaran_ke_pemasok']) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:65%">
                                Pembayaran Ke Biaya-Biaya
                            </td>
                            <td style="width:35%">
                                Rp {{  number_format($arus_kas['pembayaran_biaya_biaya']) }}
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
                                Rp {{  number_format($arus_kas['pembelian_aset_tetap']) }}
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
                                Rp {{  number_format($arus_kas['koreksi']) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <tfoot>
                        <tr>
                            <th style="width:65%">
                                Saldo akhir kas  :
                            </th>
                            <th style="width:35%">
                                Rp {{  number_format($arus_kas['saldo_akhir']) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <br>
    </div>
</div>

<script>
    function getPDF() {
        var doc = new jsPDF('p', 'pt', 'a4');
 
  // We'll make our own renderer to skip this editor
    var specialElementHandlers = {
        '#questionare': function(element, renderer){
        return true;
    },
    '#getPDF': function(element, renderer){
      return true;
    },
    '.controls': function(element, renderer){
      return true;
    }
  };

  // All units are in the set measurement for the document
  // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
  
//   doc.fromHTML($('#jurnal_umum').html(), 15, 15, {
//     // 'width': 170, 
//     // 'elementHandlers': specialElementHandlers
//   });

doc.autoTable(
    startY: false,
     theme: 'grid',
     tableWidth: 'auto',
     columnWidth: 'wrap',
     showHeader: 'everyPage',
     tableLineColor: 200,
     tableLineWidth: 0,
     headerStyles: {
         theme: 'grid'
     },
     styles: {
         overflow: 'linebreak',
         columnWidth: 'wrap',
         font: 'arial',
         fontSize: 10,
         cellPadding: 8,
         overflowColumns: 'linebreak'
     },
    { html: '#jurnal_umum' });
// // autoTable(doc, { html: '#aktiva' });
//   doc.text("Jurnal Umum",15,15);
//   doc.addPage();
  doc.fromHTML($('#jurnal_umum').html(), 15, 15, {
    'width': 300, 
    'elementHandlers': specialElementHandlers
  });
  doc.text("adasdsadad",15,15);
  doc.addPage();


  doc.save('{{ $nama_periode }}');
};
//     $('.unduh_pdf').on('click', function () {
//         doc.fromHTML($('.portlet').html(), 15, 15, {
//             'width': 170,
//                 'elementHandlers': specialElementHandlers
//         });
//         doc.save('sample-file.pdf');
// // alert($(this).attr('filename'));
// });
</script>