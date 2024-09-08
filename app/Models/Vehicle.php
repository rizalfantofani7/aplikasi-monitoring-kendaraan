<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'status'
    ];

    protected $guarded = [];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'transaction_id', 'id');
    }
}
