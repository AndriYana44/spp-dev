@extends('layouts.main_layout')
@section('content')
<style>
    .card {
        margin-top: 3.5rem;
        padding: 20px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, .1);
    }
</style>

<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</div>
@endsection
