<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Kamar;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResepsionisDashboardController extends Controller
{
    public function index()
    {
        $newBookings = Reservasi::where('status', 'Booked')->count();
        $totalCustomers = Pelanggan::count();
        $activeReservations = Reservasi::where('status', 'Checkin')->count();
        $revenue = Transaksi::sum('total_biaya');
        $weeklyEarnings = Transaksi::whereBetween('tgl_transaksi', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_biaya');
        $monthlyEarnings = Transaksi::whereMonth('tgl_transaksi', now()->month)->sum('total_biaya');
        $yearlyEarnings = Transaksi::whereYear('tgl_transaksi', now()->year)->sum('total_biaya');
        $availableRooms = Kamar::where('status', 'Available')->count();
        $bookedRooms = Kamar::where('status', 'Occupied')->count();

        return view(
            'resepsionis.dashboard',
            compact(
                'newBookings',
                'totalCustomers',
                'activeReservations',
                'revenue',
                'weeklyEarnings',
                'monthlyEarnings',
                'yearlyEarnings',
                'availableRooms',
                'bookedRooms'
            )
        );
    }


}
