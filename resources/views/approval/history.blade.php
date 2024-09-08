@extends('layouts.app')

@section('content')
@if ($notif = Session::get('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $notif }}</strong>
</div>
@endif
<table class="table table-striped table-hover">
    <tr>
        <th>No.</th>
        <th>Nama Pegawai</th>
        <th>Kendaraan</th>
        <th>Status</th>
    </tr>
    @forelse ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->employee_name }}</td>
        <td>{{ $item->vehicle->name }}</td>
        <td>
            @if (!$item->approved_spv)
            <span class="badge badge-warning">NEED SPV APPROVAL</span>
            @endif
            @if (!$item->approved_pool)
            <span class="badge badge-warning">NEED POOL APPROVAL</span>
            @endif
            @if ($item->approved_spv && $item->approved_pool)
            <span class="badge badge-success">APPROVED</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Belum ada riwayat approval</td>
    </tr>
    @endforelse
</table>
@endsection
