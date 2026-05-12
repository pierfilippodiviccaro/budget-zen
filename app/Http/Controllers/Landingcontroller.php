<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('landing_stats', 3600, function () { // Cache 1 ora
            return [
                'active_users' => $this->getActiveUsers(),
                'total_transactions' => $this->getTotalTransactions(),
                'budget_success_rate' => $this->calculateBudgetSuccessRate(),
            ];
        });

        return view('landing', compact('stats'));
    }

    private function getActiveUsers()
    {
        return User::where('last_login_at', '>=', now()->subDays(30))->count();
    }

    private function getTotalTransactions()
    {
        // TODO: Sostituisci con il tuo model quando lo crei
        return 1245000; // Placeholder temporaneo
    }

    private function calculateBudgetSuccessRate()
    {
        // TODO: Sostituisci con il tuo model quando lo crei
        return 73; // Placeholder temporaneo
    }
}