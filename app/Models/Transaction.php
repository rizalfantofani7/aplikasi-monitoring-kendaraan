<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'employee_name',
        'id_pool',
        'id_spv',
        'approved_pool',
        'approved_spv',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function spv() {
        return $this->belongsTo(User::class, 'id_spv', 'id');
    }
    
    public function pool() {
        return $this->belongsTo(User::class, 'id_pool', 'id');
    }
}
