@extends('layouts.app')

@section('content')
    <h3>Form Peminjaman Kendaraan</h3>
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
    <form action="{{ route('peminjaman.store') }}" method="post" class="pb-3">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="employee-name" class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control" id="employee-name" name="employee_name" placeholder="Nama Peminjam">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="vehicle-name" class="form-label">Kendaraan</label> <br>
                    <select class="form-select" id="vehicle-name" name="vehicle_id">
                        @foreach ($vehicle as $item)
                        <option value="{{ $item->id }}">{{ $item->name . ' (Kendaraan ' . Str::ucfirst($item->type) . ')' }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="id-spv" class="form-label">Supervisor</label> <br>
                    <select class="form-select" id="id-spv" name="id_spv">
                        @foreach ($spv as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="id-man" class="form-label">Manager</label> <br>
                    <select class="form-select" id="id-man" name="id_man">
                        @foreach ($man as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="start-date" class="form-label">Tanggal Pinjam</label> <br>
                    <input type="date" class="form-control" id="start-date" name="start_date" min="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label for="end-date" class="form-label">Tanggal Kembali</label> <br>
                    <input type="date" class="form-control" id="end-date" name="end_date" min="{{ date('Y-m-d') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
    </form>
@endsection