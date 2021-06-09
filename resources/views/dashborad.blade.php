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
