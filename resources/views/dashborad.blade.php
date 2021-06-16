@extends('layouts.main_layout')
@section('content')
<style>
    .menu-position {
        margin-top: 2rem;
        position: absolute;
        left: 0;
        height: 40px;
        width: 100%;
        background-color: rgb(225, 225, 225);
        display: flex;
        align-items: center;
        padding-left: 200px;
        color: #777;
    }
    .card {
        margin-top: 5.5rem;
        padding: 20px;
        width: 100%;
        height: max-content;
    }
</style>
<div class="menu-position">
    <small>Dashboard</small>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 40px">Hallo, {{ auth()->user()->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
        <p class="card-text">Selamat datang di sistem pembayaran spp</p>
        @if (auth()->user()->id > 1)
            <a href="#" class="btn btn-primary btn-sm card-link">Lihat Tagihan</a>
        @endif
    </div>
</div>
@endsection
@section('scripts')
    <script>
        if($('.app-aside').css('width') != '180px') {
            $('.menu-position').hide()
            $('.card').css('margin-top', '3.5rem')
        }
    </script>
@endsection
