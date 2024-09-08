@extends('layouts.app')

@section('content')
<h3>Riwayat Peminjaman</h3>
@if ($notif = Session::get('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $notif }}</strong>
</div>
@endif
<a class="btn btn-primary btn-sm mb-3" href="{{ route('peminjaman.create') }}">Pinjam Kendaraan</a>
<table class="table table-striped table-hover">
    <tr>
        <th>No.</th>
        <th>Nama Peminjam</th>
        <th>Kendaraan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @forelse ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->employee_name }}</td>
        <td>{{ $item->vehicle->name }}</td>
        <td>
            @if (!($item->approved_pool && $item->approved_spv))
            <span class="badge badge-warning">APPROVAL PROCESS</span>
            @else
                @if (Date::now() < $item->start_date)
                <span class="badge badge-danger">BOOKED</span>
                @elseif (Date::now() < $item->end_date)
                <span class="badge badge-primary">ON DUTY</span>
                @else
                <span class="badge badge-success">COMPLETED</span>
                @endif
            @endif
        </td>
        <td>
            <a href="{{ route('peminjaman.show', ['peminjaman' => $item->id]) }}" class="btn btn-sm btn-info text-white">Detail</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Belum ada riwayat peminjaman</td>
    </tr>
    @endforelse
</table>
@endsection
