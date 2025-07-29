<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_name',
        'stock_level',
        'unit_price',
        'status',
    ];

    public function repairJobs()
    {
        return $this->hasMany(RepairJob::class);
    }
}

