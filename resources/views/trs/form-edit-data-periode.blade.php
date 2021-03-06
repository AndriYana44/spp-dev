@extends('layouts.main_layout')
@section('content')
<div class="menu-position">
    <small>Dashboard / Transaksi / Set Harga Spp</small>
</div>
<style>
    .price {
        border: 0;
        width: 100px;
        border-radius: 0;
        border-bottom: 1px solid #999;
    }
    .price:focus {
        border: 0;
        border-bottom: 1px solid rgb(0, 195, 255);
    }
</style>
<div class="card">
    <div class="card-header">
        <h4>Set Harga SPP</h4>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('failed'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="{{ url('') }}/transaksi/edit-harga-spp/set/{{ $data->id }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Harga SPP : *</label>
                            <input type="number" name="spp" value="{{ $data->harga_spp }}">
                        </div>
                        <div class="col-sm-2">
                            <label for="">Potongan SPP : *</label>
                            <input type="number" class="price" name="price" value="{{ $data->diskon }}">%
                        </div>
                        <div class="col-sm-3">
                            <label for="">Bulan : *</label>
                            <select name="bulan" id="bulan">
                                @foreach ($bulan as $item)
                                    <option value="{{ $item->id }}" {{$item->id == $data->bulan->id ? "selected" : ""}}>{{ $item->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary d-inline">Set Harga</button>
                        <button onclick="return window.history.back()" class="btn btn-default d-inline">Cancel</button>   
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
