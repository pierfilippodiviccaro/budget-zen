<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('landing_stats', 3600, function () { // Cache 1 ora
            return [
                'active_users' => User::count(),
                'total_transactions' => $this->getTotalTransactions(),
                'budget_success_rate' => $this->calculateBudgetSuccessRate(),
            ];
        });

        return view('landing', compact('stats'));
    }


    private function getTotalTransactions()
    {
        
        return Transaction::count(); 
    }

    private function calculateBudgetSuccessRate()
    {
        
        return 73; 
    }
}