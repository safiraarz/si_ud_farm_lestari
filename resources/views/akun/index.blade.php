@extends('layout.conquer')
@section('content')
    <div class="container">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Master Daftar Akun
                </div>
            </div>
            <div class="portlet-body">
                <table id='myTable' class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Akun</th>
                            <th>Nama</th>
                            <th>Saldo Awal</th>
                            <th>Jenis Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr id='tr_{{ $d->id }}'>
                                <td>{{ $d->no_akun }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>Rp{{ number_format($d->saldo_awal, 2) }}</td>
                                <td>{{ $d->jenis_akun }}</td>
                                <!-- <td class='editable' id='td_no_akun_{{ $d->id }}'>{{ $d->no_akun }}</td> -->
                                <!-- <td>
                                <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{ $d->id }})">EDIT</a>
                                <form method='POST' action="{{ url('akun/' . $d->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('Are you sure you wanna delete this data?')) return false;">
                                </form>
                                <a class='btn btn-danger btn-xs' onclick="if(confirm('Are you sure you wanna delete this data?')) deleteDataRemoveTR({{ $d->id }})">Delete 2</a>
                            </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
@endsection
<!-- modal add new -->
{{-- <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Daftar Akun</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('akun') }}" class="form-horizontal" method='POST'>
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>No. Akun</label>
                            <input type="text" name="no_akun" class="form-control" id='no_akun' required>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" id='nama' required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Akun</label>
                            <select class='form-control select2' name='jenis_akun'>
                                <option value="aset" selected="">Aset</option>
                                <option value="kewajiban" selected="">Kewajiban</option>
                                <option value="ekuitas" selected="">Ekuitas</option>
                                <option value="pendapatan" selected="">Pendapatan</option>
                                <option value="biaya" selected="">Biaya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Saldo Awal</label>
                            <input type="number" name="saldo_awal" class="form-control" id='saldo_awal' min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ url('akun') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id='modalContent'>
        </div>
    </div>
</div>

@section('javascript')
    <script>
        function deleteDataRemoveTR(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('flok.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert(data.msg)
                        $('#tr_' + id).remove();
                    } else {
                        alert(data.msg)
                    }
                }
            });
        }

        $('#myTable').DataTable();
    </script>
@endsection
