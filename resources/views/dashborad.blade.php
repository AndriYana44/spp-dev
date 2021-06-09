@extends('layouts.main_layout')
@section('content')
<style>
    .menu-position {
        margin-top: 2.5rem;
        position: absolute;
        left: 0;
        height: 60px;
        width: 100%;
        background-color: #FFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-right: 30px;
        padding-left: 200px;
    }
    .card {
        margin-top: 7rem;
        padding: 20px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, .1);
        width: 100%;
    }
</style>
<div class="menu-position shadow">
    <h5 class="d-inline">Dashboard</h5>
    <small class="text-dark">Dashboard</small>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
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
