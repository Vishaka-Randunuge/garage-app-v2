<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairJobItem extends Model
{
    protected $fillable = [
        'repair_job_id',
        'inventory_id',
        'manual_type',
        'rate',
        'amount',
        'total'
    ];

    public function repairJob()
    {
        return $this->belongsTo(RepairJob::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
