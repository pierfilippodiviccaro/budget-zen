<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Budget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        // Transazioni del mese corrente — usate per le KPI (entrate/uscite/saldo) e per il donut categorie
        $monthTxns = Transaction::where('user_id', $userId)
            ->with('category')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get();

        // KPI: entrate, uscite, saldo — SOLO mese corrente
        $income  = $monthTxns->where('type', 'income')->sum('amount');
        $expense = $monthTxns->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        // --- NUOVO: transazioni mese scorso, per calcolare la variazione % ---
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        $lastMonthTxns = Transaction::where('user_id', $userId)
            ->whereBetween('date', [$startOfLastMonth, $endOfLastMonth])
            ->get();

        $incomeLastMonth  = $lastMonthTxns->where('type', 'income')->sum('amount');
        $expenseLastMonth = $lastMonthTxns->where('type', 'expense')->sum('amount');

        $incomeChange = $incomeLastMonth > 0
            ? (($income - $incomeLastMonth) / $incomeLastMonth) * 100
            : ($income > 0 ? 100 : 0);

        $expenseChange = $expenseLastMonth > 0
            ? (($expense - $expenseLastMonth) / $expenseLastMonth) * 100
            : ($expense > 0 ? 100 : 0);

        // --- NUOVO: budget mensile totale (somma di tutte le categorie) ---
        $monthlyBudget = Budget::where('user_id', $userId)
        ->where('month', Carbon::now()->month)
        ->where('year', Carbon::now()->year)
        ->sum('amount');
        
        
        $budgetPercentage = $monthlyBudget > 0
            ? round(($expense / $monthlyBudget) * 100)
            : 0;

        // Ultime 10 transazioni in assoluto (non filtrate per mese, per mostrare l'attività più recente)
        $recent = Transaction::where('user_id', $userId)
            ->with('category')
            ->orderByDesc('date')
            ->limit(10)
            ->get();

        // Ripartizione spese per categoria (solo uscite, mese corrente)
        $byCategory = $monthTxns
            ->where('type', 'expense')
            ->groupBy(fn($txn) => $txn->category->name ?? 'Senza categoria')
            ->map(fn($group) => $group->sum('amount'))
            ->sortDesc()
            ->toArray();

        // Trend ultimi 6 mesi (entrate vs uscite)
        $trend = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate  = Carbon::now()->subMonths($i);
            $monthStart = $monthDate->copy()->startOfMonth();
            $monthEnd   = $monthDate->copy()->endOfMonth();

            $monthData = Transaction::where('user_id', $userId)
                ->whereBetween('date', [$monthStart, $monthEnd])
                ->get();

            $trend[] = [
                'label'   => ucfirst($monthDate->translatedFormat('M')),
                'income'  => (float) $monthData->where('type', 'income')->sum('amount'),
                'expense' => (float) $monthData->where('type', 'expense')->sum('amount'),
            ];
        }

        // Categorie per il select del modal "Nuova transazione"
        $categories = Category::orderBy('name')->get();

        return view('dashboard', compact(
            'income',
            'expense',
            'balance',
            'incomeChange',
            'expenseChange',
            'budgetPercentage',
            'recent',
            'byCategory',
            'trend',
            'categories'
            ));
    }
}