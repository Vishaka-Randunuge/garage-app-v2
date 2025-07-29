<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_no',
        'owner_name',
        'owner_contact',
        'brand',
    ];

    public function repairJobs()
    {
        return $this->hasMany(RepairJob::class);
    }
}

