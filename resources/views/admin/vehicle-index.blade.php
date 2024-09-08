@extends('layouts.app')

@section('content')
<h3>Data Kendaraan</h3>
<a class="btn btn-primary btn-sm mb-3" href="{{ route('kendaraan.create') }}">Tambah Kendaraan</a>
<table class="table table-striped table-hover">
    <tr>
        <th>No</th>
        <th>Nama Kendaraan</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @forelse ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>Kendaraan {{ Str::ucfirst($item->type) }}</td>
        <td>
            @if ($item->status == 'available')
            <span class="badge badge-success">AVAILABLE</span>
            @elseif ($item->status == 'being booked')
            <span class="badge badge-warning">BEING BOOKED</span>
            @else
            <span class="badge badge-primary">ON DUTY</span>
            @endif
        </td>
        <td>Aksi</td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Belum ada data kendaraan</td>
    </tr>
    @endforelse
</table>
@endsection
