<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_job_id',
        'printed_at',
    ];

    public function repairJob()
    {
        return $this->belongsTo(RepairJob::class);
    }
}

