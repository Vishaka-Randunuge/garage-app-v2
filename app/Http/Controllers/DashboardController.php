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

        // Jobs counts
        $weeklyJobs = RepairJob::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyJobs = RepairJob::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyJobs = RepairJob::whereYear('created_at', $now->year)->count();
        $dailyJobs = RepairJob::whereDate('created_at', $now->toDateString())->count();

        // Revenue sums by summing related repair job items' totals
        $dailyRevenue = RepairJob::with('items')
            ->whereDate('created_at', $now->toDateString())
            ->get()
            ->flatMap->items
            ->sum('total');

        $weeklyRevenue = RepairJob::with('items')
            ->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])
            ->get()
            ->flatMap->items
            ->sum('total');

        $monthlyRevenue = RepairJob::with('items')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->get()
            ->flatMap->items
            ->sum('total');

        $yearlyRevenue = RepairJob::with('items')
            ->whereYear('created_at', $now->year)
            ->get()
            ->flatMap->items
            ->sum('total');

        // New Vehicles counts
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
