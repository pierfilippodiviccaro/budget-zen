<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Pagina principale dei budget (lista / panoramica).
     * Per ora reindirizza alla creazione del mese corrente.
     */
    public function index()
    {
        return redirect()->route('admin.budgets.create', [
            'month' => now()->month,
            'year'  => now()->year,
        ]);
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
            ->route('budgets.create', [
                'month' => $validated['month'],
                'year'  => $validated['year'],
            ])
            ->with('success', 'Budget aggiornato correttamente.');
    }
}