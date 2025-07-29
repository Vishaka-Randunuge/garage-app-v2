<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepairJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'inventory_id',
        'repair_type_manual',
        'rate',
        'amount',
        'total',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function printedJob()
    {
        return $this->hasOne(PrintedJob::class);
    }
}

