<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ApprovalController extends Controller
{
    // TODO: refactoring reusable variables

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            $user = Auth::user();
            $approved = $user->role == 'supervisor' ? 'approved_spv' : 'approved_man';
            $id_role = $user->role == 'supervisor' ? 'id_spv' : 'id_man';
            $data = Transaction::where([$id_role => $user->id, $approved => false])->get();

            return view('approval.index', compact('data', 'user'));
        }
        
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $user = Auth::user();
        $id_role = $user->role == 'supervisor' ? 'id_spv' : 'id_man';
        $approved = $user->role == 'supervisor' ? 'approved_spv' : 'approved_man';
        Transaction::where('id', $request->id_trx)->update([$approved => true]);

        return redirect()->route('approval-history', ['role' => $user->role])->with(['success' => 'Berhasil menyetujui peminjaman kendaraan']);
    }

    /**
     * Display all the approved request.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $user = Auth::user();
        $id_role = $user->role == 'supervisor' ? 'id_spv' : 'id_man';
        $approved = $user->role == 'supervisor' ? 'approved_spv' : 'approved_man';
        $data = Transaction::where([$id_role => $user->id, $approved => true])->orderBy('updated_at', 'DESC')->get();

        return view('approval.history', compact('data'));
    }

    /**
     * Show the detail of approval request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $data = Transaction::findOrFail($id);
        return view('approval.detail', compact('data'));
    }
}
