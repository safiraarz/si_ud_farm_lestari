@extends('layout.conquer')
@section('content')
    <div class="container">
        <label for="">Periode : </label>
        <select name="" id="periode">   
            <option value="">== Pilih Periode ==</option>
            @foreach ($periode as $item)
            <option value="{{ $item->id }}">{{ date('d/m/Y', strtotime($item->tanggal_awal)) }} - {{ date('d/m/Y', strtotime($item->tanggal_akhir))  }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <div id="laporan">

        </div>
    </div>
@endsection
@section('javascript')
    <script>
       
         $('#periode').on('change', function() {
            var id_periode = $(this).find(':selected').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('laporan.getData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id_periode': id_periode,
                },
                success: function(data) {
                    $('#laporan').html(data.msg);
                }
            });

        });
    //     var doc = new jsPDF();
    //     var specialElementHandlers = {
    //         '#editor': function (element, renderer) {
    //             return true;
    //     }
    // };
 
    // $('#unduh_pdf').click(function () {
    //     // doc.fromHTML($('#content').html(), 15, 15, {
    //     //     'width': 170,
    //     //         'elementHandlers': specialElementHandlers
    //     // });
    //     // doc.save('sample-file.pdf');
    // });
    </script>
@endsection
