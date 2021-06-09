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
    <small>Dashboard / siswa</small>
</div>

<div class="card">
    <div class="card-body">
        @if ($message = Session::get('success_import'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="{{ url('') }}/siswa/upload" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Upload</label>
                <input type="file" name="upload_file" class="form-control">
            </div>
            <button class="btn btn-primary btn-sm">Upload</button>
        </form>
    </div>
</div>
@endsection
