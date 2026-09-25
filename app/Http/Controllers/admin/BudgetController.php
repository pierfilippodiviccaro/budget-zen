<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BudgetController extends Controller
{
    /**
     * Pagina principale dei budget: mostra la panoramica del mese
     * (budget impostato per categoria + quanto speso finora).
     */
    public function index(Request $request)
    {
        $month = (int) $request->query('month', now()->month);
        $year  = (int) $request->query('year', now()->year);

        $userId = auth()->id();

        // Budget impostati per il mese, indicizzati per categoria
        $budgets = Budget::where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->pluck('amount', 'category_id');

        // Spese effettive per categoria nello stesso mese
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

        $spentByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $categories = Category::orderBy('name')->get();

        return view('budgets.index', compact(
            'categories', 'budgets', 'spentByCategory', 'month', 'year'
        ));
    }

    /**
     * Mostra il form per creare / modificare i budget di un mese.
     */
    public function create(Request $request)
    {
        $month = (int) $request->query('month', now()->month);
        $year  = (int) $request->query('year', now()->year);

        $categories = Category::orderBy('name')->get();

        $budgets = Budget::where('month', $month)
            ->where('year', $year)
            ->pluck('amount', 'category_id');

        return view('budgets.create', compact('categories', 'budgets', 'month', 'year'));
    }

    /**
     * Salva / aggiorna i budget per un dato mese/anno.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year'  => 'required|integer|min:2000|max:2100',
            'amounts' => 'array',
            'amounts.*' => 'nullable|numeric|min:0',
        ]);

        foreach ($validated['amounts'] as $categoryId => $amount) {
            if ($amount === null || $amount === '') {
                Budget::where('category_id', $categoryId)
                    ->where('month', $validated['month'])
                    ->where('year', $validated['year'])
                    ->delete();
                continue;
            }

            Budget::updateOrCreate(
                [
                    'category_id' => $categoryId,
                    'month' => $validated['month'],
                    'year' => $validated['year'],
                ],
                ['amount' => $amount]
            );
        }

        return redirect()
            ->route('admin.budgets.index', [
                'month' => $validated['month'],
                'year'  => $validated['year'],
            ])
            ->with('success', 'Budget aggiornato correttamente.');
    }
}