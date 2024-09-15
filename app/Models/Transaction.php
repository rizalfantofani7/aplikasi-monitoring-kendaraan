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
        'id_man',
        'id_spv',
        'driver_id',
        'approved_man',
        'approved_spv',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id', 'id');
    }

    public function spv() {
        return $this->belongsTo(User::class, 'id_spv', 'id');
    }
    
    public function man() {
        return $this->belongsTo(User::class, 'id_man', 'id');
    }
}
