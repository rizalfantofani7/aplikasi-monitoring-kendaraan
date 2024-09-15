@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center my-4">Form Peminjaman Kendaraan</h3>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="post" class="pb-3">
        @csrf
        <div class="mb-3">
            <label for="employee-name" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" id="employee-name" name="employee_name" placeholder="Nama Peminjam" required>
        </div>

        <div class="mb-3">
            <label for="vehicle-name" class="form-label">Kendaraan</label>
            <select class="form-select custom-select-style" id="vehicle-name" name="vehicle_id" required>
                <option value="" disabled selected>Pilih Kendaraan</option>
                @foreach ($vehicle as $item)
                    <option value="{{ $item->id }}">{{ $item->name . ' (Kendaraan ' . Str::ucfirst($item->type) . ')' }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id-spv" class="form-label">Supervisor</label>
            <select class="form-select custom-select-style" id="id-spv" name="id_spv" required>
                <option value="" disabled selected>Pilih Supervisor</option>
                @foreach ($spv as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id-man" class="form-label">Manager</label>
            <select class="form-select custom-select-style" id="id-man" name="id_man" required>
                <option value="" disabled selected>Pilih Manager</option>
                @foreach ($man as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start-date" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="start-date" name="start_date" min="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="end-date" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" id="end-date" name="end_date" min="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="driver" class="form-label">Driver</label>
            <select class="form-select custom-select-style" id="driver-id" name="driver_id" required>
                <option value="" disabled selected>Pilih Driver</option>
                @foreach ($drivers as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Ajukan Peminjaman</button>
        </div>
    </form>
</div>
@endsection
