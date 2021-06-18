@extends('layouts.main_layout')
@section('content')
<div class="menu-position">
    <small>Dashboard / configurasi / set-tahun</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Set periode tahun</h4>
        <button class="btn btn-success btn-sm add-tahun">
            <i class="fa fa-plus"></i> Tambah Periode</button>
    </div>
    <br><br>
    <div class="row set-tahun-periode">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('success_set'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="{{ url('set-tahun-periode') }}" method="POST">
            @csrf
            <div class="col-sm-4">
                @if ($tahun->where('is_set', 1)->first() == null)
                <span class="text-danger">
                    <h6>* Belum ada periode yang ditetapkan</h6>
                </span>
                @else
                <span class="text-primary">
                    <h6>* Periode saat ini: {{ $tahun->where('is_set', 1)->first()->tahun }}</h6>
                </span>
                @endif
                <br><br>
                <label for="tahun">Tahun : *</label>
                @if($tahun->first() == null)
                <br>
                <span class="text-danger">
                    Periode belum ada! <br>Silahkan tambah periode terlebih dahulu
                </span>
                <br>
                @else
                    <select name="tahun" id="tahun">
                        @foreach ($tahun as $item)
                        <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Set Tahun</button>
                @endif
            </div>
        </form>
    </div>
    <div class="row form-add-tahun" hidden>
        <form action="{{ url('create-tahun-periode') }}" method="POST">
            @csrf
            <div class="col-sm-3">
                <label for="tahun">Tahun : *</label>
                <input type="number" name="tahun" id="tahun" autofocus>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger close-add-tahun">Close</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('.add-tahun').click(function() {
            $(".form-add-tahun").removeAttr('hidden')
            $('.set-tahun-periode').attr('hidden', 'on')
        })

        $('.close-add-tahun').click(function() {
            $(".form-add-tahun").attr('hidden', 'on')
            $('.set-tahun-periode').removeAttr('hidden')
        })
    </script>
@endsection
