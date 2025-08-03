<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairJob;
use App\Models\Vehicle;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
    
        // Jobs
        $weeklyJobs = RepairJob::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyJobs = RepairJob::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyJobs = RepairJob::whereYear('created_at', $now->year)->count();
        $dailyJobs = RepairJob::whereDate('created_at', $now->toDateString())->count();
    
        // Revenue
        $dailyRevenue = RepairJob::whereDate('created_at', $now->toDateString())->sum('total');
        $weeklyRevenue = RepairJob::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->sum('total');
        $monthlyRevenue = RepairJob::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->sum('total');
        $yearlyRevenue = RepairJob::whereYear('created_at', $now->year)->sum('total');
    
        // New Vehicles
        $dailyVehicles = Vehicle::whereDate('created_at', $now->toDateString())->count();
        $weeklyVehicles = Vehicle::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyVehicles = Vehicle::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyVehicles = Vehicle::whereYear('created_at', $now->year)->count();
    
        return view('dashboard', compact(
            'dailyJobs', 'weeklyJobs', 'monthlyJobs', 'yearlyJobs',
            'dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue',
            'dailyVehicles', 'weeklyVehicles', 'monthlyVehicles', 'yearlyVehicles'
        ));
    }
}
