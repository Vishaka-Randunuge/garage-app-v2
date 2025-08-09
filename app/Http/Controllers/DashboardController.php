<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairJob;
use App\Models\Vehicle;
use App\Models\PrintedJob; // adjust if your model name is different
use App\Models\Inventory;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // ==== REPAIR JOBS ====
        $dailyJobs = RepairJob::whereDate('created_at', $now->toDateString())->count();
        $weeklyJobs = RepairJob::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyJobs = RepairJob::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyJobs = RepairJob::whereYear('created_at', $now->year)->count();

        // ==== REVENUE ====
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

        // ==== VEHICLES ====
        $dailyVehicles = Vehicle::whereDate('created_at', $now->toDateString())->count();
        $weeklyVehicles = Vehicle::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyVehicles = Vehicle::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyVehicles = Vehicle::whereYear('created_at', $now->year)->count();

        // ==== PrintedJob INVOICES ====
        $dailyPrintedJob = PrintedJob::whereDate('created_at', $now->toDateString())->count();
        $weeklyPrintedJob = PrintedJob::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyPrintedJob = PrintedJob::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyPrintedJob = PrintedJob::whereYear('created_at', $now->year)->count();

        // ==== INVENTORIES ====
        $dailyInventories = Inventory::whereDate('created_at', $now->toDateString())->count();
        $weeklyInventories = Inventory::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count();
        $monthlyInventories = Inventory::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $yearlyInventories = Inventory::whereYear('created_at', $now->year)->count();

        // ==== LOW INVENTORY ====
        $lowInventory = Inventory::where('stock_level', '<=', 10)->orderBy('stock_level')->get();

        // ==== ONGOING REPAIR JOBS ====
        $ongoingJobs = RepairJob::with('vehicle')
            ->where('status', 'ongoing')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact(
            // Repair Jobs
            'dailyJobs', 'weeklyJobs', 'monthlyJobs', 'yearlyJobs',
            // Revenue
            'dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue',
            // Vehicles
            'dailyVehicles', 'weeklyVehicles', 'monthlyVehicles', 'yearlyVehicles',
            // PrintedJob
            'dailyPrintedJob', 'weeklyPrintedJob', 'monthlyPrintedJob', 'yearlyPrintedJob',
            // Inventories
            'dailyInventories', 'weeklyInventories', 'monthlyInventories', 'yearlyInventories',
            // Low Inventory & Ongoing Jobs
            'lowInventory', 'ongoingJobs'
        ));
    }
}
