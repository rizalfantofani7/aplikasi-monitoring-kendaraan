<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = Transaction::orderBy('updated_at', 'DESC')->get();
            return view('admin.trx-index', compact('data'));
        }

        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $vehicle = Vehicle::where('status', 'available')->get();
            $spv = User::where('role', 'supervisor')->get();
            $pool = User::where('role', 'pool-officer')->get();

            return view('admin.trx-create', compact('vehicle', 'spv', 'pool'));
        }

        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        Transaction::create($data);
        Vehicle::where('id', $data['vehicle_id'])->update(['status' => 'being booked']);

        return redirect()->route('peminjaman.index')->with(['success' => 'Berhasil mengajukan peminjaman kendaraan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaction::findOrFail($id);
        return view('admin.trx-detail', compact('data'));
    }
}
