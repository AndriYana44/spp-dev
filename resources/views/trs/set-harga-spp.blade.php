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
        <form action="{{ url('') }}/transaksi/set-harga-spp/set" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Harga SPP : *</label>
                            <input type="number" name="spp" value="{{ $harga != 0 ? $harga : '' }}" placeholder="Rp.0,-">
                        </div>
                        <div class="col-sm-2">
                            <label for="">Potongan SPP : *</label>
                            <input type="number" class="price" name="price" value="{{ $diskon != 0 ? $diskon : '' }}" placeholder="0%">%
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-block">Set Harga</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
