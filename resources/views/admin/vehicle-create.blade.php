@extends('layouts.app')

@section('content')
<h3>Form Tambah Kendaraan</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('kendaraan.store') }}" method="post" class="pb-3">
    @csrf
    <div class="row">
        <!-- Nama Kendaraan Field -->
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kendaraan</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Kendaraan" required>
            </div>
        </div>
        <!-- Tipe Kendaraan Field -->
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="type" class="form-label">Tipe Kendaraan</label> <br>
                <select class="form-select" id="type" name="type" required>
                    <option value="penumpang">Penumpang</option>
                    <option value="barang">Barang</option>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Kendaraan</button>
</form>

@endsection