<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    const STATISTICS_LIMIT = 10;
    
    public function index()
    {
        $statistics = Statistic::query()
            ->with('user:id,name')
            ->latest('task_count')
            ->limit(self::STATISTICS_LIMIT)
            ->get();

        return view('statistics.index', compact('statistics'));
    }
}
