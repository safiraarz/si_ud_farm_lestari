@extends('layout.conquer')
@section('content')
<div class="container">
    <h2>Material Requirement Planning</h2>

    <div class="form-group row">
        <label for="mps" class="col-sm-1 control-label">ID MPS</label>
        <div class="col-sm-3">
            <select name="mps" id="mps" class="form-control">
                @foreach ($mps as $item)
                <option value="{{ $item->id }}" class="custom-select">{{ $item->id }}</option>
                @endforeach
            </select>
        </div>
        <button id="btnhitung" class="btn btn-secondary col-sm-2 margin-right-10">HITUNG</button>
        <button id="btnreset " class="btn btn-secondary col-sm-2 ">RESET</button>
    </div>
    <div class="form-group row margin-top-20 mb-0">
        <p class="col-sm-2 control-label bold">Nama Pakan Ayam</p>
        <label class="col-sm2 control-label ">: TEST</label>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 control-label bold">Jumlah Produksi</label>
        <label class="col-sm2 control-label ">: TEST</label>
    </div>


</div>
@endsection
