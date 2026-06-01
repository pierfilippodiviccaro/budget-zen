<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $transactions = Transaction::where('user_id', Auth::id())
        ->with('category')
        ->orderByDesc('date')
        ->get();

    return view('transactions.index', compact('transactions'));
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
