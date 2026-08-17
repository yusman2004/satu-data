<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dataset;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'datasets' => Dataset::count(),
            'published' => Dataset::where('status','published')->count(),
            'categories' => Category::count(),
            'organizations' => Organization::count(),
            'downloads' => Dataset::sum('downloads'),
            'users' => User::count(),
        ];

        $chart = Category::withCount('datasets')->orderByDesc('datasets_count')->get();
        $latest = Dataset::with(['category','organization'])->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats','chart','latest'));
    }
}