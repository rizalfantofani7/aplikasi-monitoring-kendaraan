<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use DB;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\User;
use App\Exports\ExportTransactions;
use Maatwebsite\Excel\Facades\Excel;

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
            $man = User::where('role', 'manager')->get();
            $drivers = Driver::all();
            return view('admin.trx-create', compact('vehicle', 'spv', 'man','drivers'));
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
        $data = Transaction::with(['vehicle', 'spv','man'])->findOrFail($id);
        $drivers = Driver::all();
        return view('admin.trx-detail', compact('data','drivers'));
    }


    public function dashboard()
    {
        $list = array_map(function ($item) {
            return [
                'type' => $item->type,
                'name' => $item->name,
                'total' => $item->total,
            ];
        }, DB::select('SELECT type, name, COUNT(vehicle_id) as total FROM transactions JOIN vehicles ON (transactions.vehicle_id = vehicles.id) GROUP BY vehicle_id ORDER BY COUNT(vehicle_id) DESC'));
        return view('admin.index', compact('list'));
        
    }

    public function export()
    {
        $fileName = 'peminjaman.xlsx';
        return Excel::download(new ExportTransactions, $fileName);
    }
}
