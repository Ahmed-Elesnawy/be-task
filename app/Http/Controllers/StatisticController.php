<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Repository\Eloquent\Statistic\StatisticRepository;

class StatisticController extends Controller
{    
    public function index(StatisticRepository $statisticRepository)
    {
        $statistics = $statisticRepository->eagerLoad(['user:id,name'])->getTopStatistics();

        return view('statistics.index', compact('statistics'));
    }
}
