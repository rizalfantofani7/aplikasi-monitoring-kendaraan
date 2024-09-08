@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover">
        <tr>
            <th>No.</th>
            <th>Nama Pegawai</th>
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
                    @if (!$item->approved_spv)
                        <span class="badge badge-warning" style="display: block; width: max-content">NEED SPV APPROVAL</span>
                    @endif
                    @if (!$item->approved_pool)
                        <span class="badge badge-warning">NEED POOL APPROVAL</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('approve', ['role' => $user->role, 'id_trx' => $item->id]) }}" method="post" class="mb-1">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <a href="{{ route('approval.detail', ['role' => $user->role, 'id_trx' => $item->id]) }}" class="btn btn-sm btn-info text-white float-left">Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada approval request</td>
            </tr>
        @endforelse
    </table>
@endsection