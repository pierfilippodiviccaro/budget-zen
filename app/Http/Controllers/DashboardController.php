<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Budget;
use App\Models\category;  // va bene, ma il model va in CamelCase
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now  = Carbon::now();

        // ── Totali mese corrente con range esplicito ──
        $from = $now->copy()->startOfMonth();
        $to   = $now->copy()->endOfMonth();

        $transactions = Transaction::where('user_id', $user->id)
            ->whereBetween('date', [$from, $to])
            ->get();

        $income  = $transactions->where('type', 'income')->sum('amount');
        $expense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        // ── Ultime 5 transazioni ──
        $recent = Transaction::where('user_id', $user->id)
            ->with('category')
            ->orderByDesc('date')
            ->limit(5)
            ->get(); 

        // ── Budget mese corrente con spese per categoria ──
        $budgets = Budget::where('user_id', $user->id)
            ->whereMonth('start_date', $now->month)   
            ->whereYear('start_date', $now->year)
            ->with('category')
            ->get()
            ->map(function ($b) use ($user, $now) {
                $start = $now->copy()->startOfMonth();
                $end   = $now->copy()->endOfMonth();

                $spent = Transaction::where('user_id', $user->id)
                    ->where('category_id', $b->category_id)
                    ->where('type', 'expense')
                    ->whereBetween('date', [$start, $end])
                    ->sum('amount');

                $b->spent      = $spent;
                $b->percentage = $b->amount_limit > 0
                    ? min(100, round(($spent / $b->amount_limit) * 100))
                    : 0;

                return $b;
            });

        // ── Spese per categoria (grafico torta) ──
        $byCategory = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('date', [$from, $to])
            ->with('category')
            ->get()
            ->groupBy('category.name')
            ->map(fn ($group) => $group->sum('amount'));

        // ── Andamento ultimi 6 mesi ──
        $trend = collect(range(5, 0))->map(function ($i) use ($user) {
            $d = Carbon::now()->subMonths($i);
            $start = $d->copy()->startOfMonth();
            $end   = $d->copy()->endOfMonth();

            $inc = Transaction::where('user_id', $user->id)
                ->where('type', 'income')
                ->whereBetween('date', [$start, $end])
                ->sum('amount');

            $exp = Transaction::where('user_id', $user->id)
                ->where('type', 'expense')
                ->whereBetween('date', [$start, $end])
                ->sum('amount');


                
                return [
                    'label'   => $d->translatedFormat('M'),
                    'income'  => $inc,
                    'expense' => $exp,
                    ];
                    });
                    
                    $categories = Category::all();
        // passo 'month' e 'year' solo se li usi nel Blade
        $month = $now->month;
        $year  = $now->year;

        return view('dashboard', compact(
            'income',
            'expense',
            'balance',
            'recent',
            'budgets',
            'byCategory',
            'trend',
            'month',
            'year',
            'categories'
        ));
    }
}