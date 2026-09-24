<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; 

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

 
public function index(Request $request)
{
    $showAll = $request->query('all') === '1';
 
    $query = Transaction::where('user_id', Auth::id())
        ->with('category')
        ->orderByDesc('date');
 
    $currentMonth = null;
 
    if (! $showAll) {
        // month arriva come 'YYYY-MM' (es. 2026-08) dai link di navigazione; default = mese corrente
        $monthParam   = $request->query('month');
        $currentMonth = $monthParam
            ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth()
            : Carbon::now()->startOfMonth();
 
        $query->whereBetween('date', [
            $currentMonth->copy()->startOfMonth(),
            $currentMonth->copy()->endOfMonth(),
        ]);
    }
 
    $transactions = $query->get();
 
    return view('transactions.index', [
        'transactions' => $transactions,
        'currentMonth' => $currentMonth, // null quando $showAll = true
        'showAll'      => $showAll,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'amount'      => 'required|numeric|min:0.01',
        'type'        => 'required|in:income,expense',
        'description' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'date' => 'required|date',
    ]);

    $validated['user_id'] = Auth::id();

    transaction::create($validated);

    return redirect()->route('dashboard')->with('success', 'Transazione aggiunta!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
