<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Inspection;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $debutMois = Carbon::now()->startOfMonth();
        $finMois   = Carbon::now()->endOfMonth();

        $totalInspecteurs = User::where(
            'role',
            'inspecteur'
        )->count();

        $query = User::query()
        ->whereBetween('created_at', [
        $debutMois,
        $finMois
        ]);

        $totalInspections = Inspection::count();

        $totalRapports = Mission::whereIn(
            'statut',
            [
                'terminee',
                'validee'
            ]
        )->count();

        $usersMois = User::whereMonth(
            'created_at',
            Carbon::now()->month
        )
        ->whereYear(
            'created_at',
            Carbon::now()->year
        )
        ->count();

        $inspectionsMois = Inspection::whereMonth(
            'created_at',
            Carbon::now()->month
        )
        ->whereYear(
            'created_at',
            Carbon::now()->year
        )
        ->count();

        $missionsMois = Mission::whereMonth(
            'created_at',
            Carbon::now()->month
        )
        ->whereYear(
            'created_at',
            Carbon::now()->year
        )
        ->count();

        $rapportsMois = Mission::whereIn(
            'statut',
            ['terminee', 'validee']
        )
        ->whereMonth(
            'updated_at',
            Carbon::now()->month
        )
        ->whereYear(
            'updated_at',
            Carbon::now()->year
        )
        ->count();

        $admins = User::where(
            'role',
            'admin'
        )->count();

        $dg = User::where(
            'role',
            'dg'
        )->count();

        $dt = User::where(
            'role',
            'dt'
        )->count();

        $inspecteurs = User::where(
            'role',
            'inspecteur'
        )->count();

        $recentUsers = User::latest()
            ->take(10)
            ->get();

        return view(
            'dashboards.admin',
            compact(
                'totalUsers',
                'totalInspecteurs',
                'totalInspections',
                'totalRapports',
                'usersMois',
                'inspectionsMois',
                'missionsMois',
                'rapportsMois',
                'admins',
                'dg',
                'dt',
                'inspecteurs',
                'recentUsers'
            )
        );
    }
}