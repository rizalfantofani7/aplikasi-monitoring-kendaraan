@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="employee-name" class="form-label">Nama Peminjam</label>
                <input type="text" class="form-control" id="employee-name" name="employee_name" value="{{ $data->employee_name }}" disabled>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="vehicle" class="form-label">Kendaraan</label>
                <input type="text" class="form-control" id="vehicle" name="vehicle" value="{{ $data->vehicle->name }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="driver" class="form-label">Driver</label>
                <input type="text" class="form-control" id="driver" name="driver" value="{{ $data->driver->name }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="spv" class="form-label">Supervisor</label>
                <input type="text" class="form-control" id="spv" name="spv" value="{{ $data->spv->name }}" disabled>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="man" class="form-label">Manager</label>
                <input type="text" class="form-control" id="man" name="man" value="{{ $data->man->name }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="start-date" class="form-label">Tanggal Pinjam</label>
                <input type="text" class="form-control" id="start-date" name="start_date" value="{{ $data->start_date }}" disabled>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="end-date" class="form-label">Tanggal Kembali</label>
                <input type="text" class="form-control" id="end-date" name="end_date" value="{{ $data->end_date }}" disabled>
            </div>
        </div>
    </div>
    {{-- {{ $data->spv }} --}}
@endsection