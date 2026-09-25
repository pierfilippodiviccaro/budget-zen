<x-app-layout>
    @php
    $currentMonthDate = \Carbon\Carbon::create($year, $month, 1);
    $prevMonthDate    = $currentMonthDate->copy()->subMonth();
    $nextMonthDate    = $currentMonthDate->copy()->addMonth();
    $totalBudget = collect($budgets)->sum();
    $totalSpent  = collect($spentByCategory)->sum();
    $totalPct    = $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100) : 0;

    $stateFor = function ($pct) {
        if ($pct >= 100) return 'danger';
        if ($pct >= 80) return 'warn';
        return 'ok';
    };
@endphp
@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

<style>
:root {
    --navy: #0B2545;
    --blue: #1463A8;
    --teal: #1B9E78;
    --purple: #7C5CFC;
    --cream: #F4F7FD;
    --muted: #6B87B0;
    --border: rgba(20, 99, 168, 0.12);
    --red: #E05252;
    --amber: #E8A020;
    --font-display: 'DM Serif Display', Georgia, serif;
    --font-mono: 'DM Mono', monospace;
    --font-body: 'DM Sans', sans-serif;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.db { font-family: var(--font-body); color: var(--navy); max-width: 1240px; margin: 0 auto; padding: 16px 20px 60px; }

/* ── TOP NAV (identica alla dashboard) ── */
.db-nav { display: flex; align-items: center; justify-content: space-between; padding: 12px 22px; background: #fff; border: 1px solid var(--border); border-radius: 18px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(11, 37, 69, 0.03); }
.db-brand { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-size: 1.35rem; color: var(--navy); text-decoration: none; }
.db-brand-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--navy); color: #fff; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; }
.db-nav-links { display: flex; align-items: center; background: var(--cream); padding: 4px; border-radius: 100px; gap: 2px; }
.db-nav-item { padding: 6px 16px; font-size: 12px; font-weight: 500; color: var(--muted); text-decoration: none; border-radius: 100px; transition: all .2s; }
.db-nav-item:hover { color: var(--navy); }
.db-nav-item.active { background: #fff; color: var(--navy); box-shadow: 0 2px 8px rgba(11, 37, 69, 0.08); }
.db-nav-right { display: flex; align-items: center; gap: 12px; }
.db-user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--cream); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-size: 11px; font-weight: 600; color: var(--blue); }

/* ── HEADER ── */
.db-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
.db-header-left h1 { font-family: var(--font-display); font-size: clamp(1.9rem, 3.2vw, 2.5rem); font-weight: 400; line-height: 1.15; margin-bottom: 6px; letter-spacing: -0.01em; }
.db-header-left h1 em { font-style: italic; color: var(--blue); }
.db-header-left p { font-family: var(--font-mono); font-size: 10.5px; color: var(--muted); letter-spacing: 0.12em; text-transform: uppercase; display: flex; align-items: center; gap: 8px; }
.db-header-left p::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--blue); }
.db-header-right { display: flex; align-items: center; gap: 10px; }

.btn-new-txn { display: inline-flex; align-items: center; gap: 8px; background: var(--navy); color: #fff; font-size: 13px; font-weight: 500; padding: 10px 20px; border-radius: 100px; border: none; cursor: pointer; text-decoration: none; transition: all .2s; box-shadow: 0 4px 16px rgba(11, 37, 69, 0.12); }
.btn-new-txn:hover { background: var(--blue); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(20, 99, 168, 0.25); }

/* ── Selettore mese ── */
.db-month-switch { display: inline-flex; align-items: center; gap: 4px; background: #fff; border: 1px solid var(--border); border-radius: 100px; padding: 4px; }
.db-month-switch a { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; color: var(--muted); text-decoration: none; transition: background .15s, color .15s; }
.db-month-switch a:hover { background: var(--cream); color: var(--navy); }
.db-month-switch span { font-family: var(--font-mono); font-size: 11px; font-weight: 500; color: var(--navy); letter-spacing: 0.05em; text-transform: uppercase; padding: 0 10px; min-width: 110px; text-align: center; }

/* ── KPI riepilogo totale ── */
.db-kpi-summary { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px 28px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; position: relative; overflow: hidden; }
.db-kpi-summary::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--blue); }
.db-kpi-summary-label { font-family: var(--font-mono); font-size: 10px; color: var(--muted); letter-spacing: 0.12em; text-transform: uppercase; font-weight: 500; margin-bottom: 8px; }
.db-kpi-summary-value { font-family: var(--font-display); font-size: clamp(1.9rem, 3vw, 2.3rem); font-weight: 400; color: var(--navy); line-height: 1; }
.db-kpi-summary-value small { font-family: var(--font-mono); font-size: 14px; color: var(--muted); font-weight: 500; }
.db-kpi-summary-pct { font-family: var(--font-mono); font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 100px; }
.db-kpi-summary-pct.ok { color: var(--teal); background: rgba(27, 158, 120, 0.1); }
.db-kpi-summary-pct.warn { color: var(--amber); background: rgba(232, 160, 32, 0.12); }
.db-kpi-summary-pct.danger { color: var(--red); background: rgba(224, 82, 82, 0.12); }

/* ── CARD generica ── */
.db-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px 26px; box-shadow: 0 4px 20px rgba(11, 37, 69, 0.02); }
.db-card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid rgba(20, 99, 168, 0.08); }
.db-card-title { font-size: 14px; font-weight: 600; color: var(--navy); display: flex; align-items: center; gap: 9px; }
.db-card-title-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--dot-color, var(--blue)); }
.db-card-link { font-family: var(--font-mono); font-size: 10.5px; color: var(--blue); text-decoration: none; letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; }
.db-card-link:hover { text-decoration: underline; }

/* ── Griglia budget per categoria ── */
.db-budget-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
@media (max-width: 860px) { .db-budget-grid { grid-template-columns: 1fr; } }

.db-budget-list { display: flex; flex-direction: column; gap: 18px; }
.db-budget-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; gap: 10px; }
.db-budget-name { font-size: 13.5px; font-weight: 500; color: var(--navy); display: flex; align-items: center; gap: 8px; min-width: 0; }
.db-budget-name-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--state-color, var(--teal)); flex-shrink: 0; }
.db-budget-name-text { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.db-budget-nums { font-family: var(--font-mono); font-size: 11.5px; color: var(--muted); white-space: nowrap; }
.db-track { height: 8px; background: var(--cream); border-radius: 100px; overflow: hidden; }
.db-fill { height: 100%; border-radius: 100px; transition: width .8s cubic-bezier(.22, 1, .36, 1); }
.db-fill.ok { background: linear-gradient(90deg, var(--teal), #2dd4a4); }
.db-fill.warn { background: linear-gradient(90deg, var(--amber), #f5b942); }
.db-fill.danger { background: linear-gradient(90deg, var(--red), #f07070); }
.db-budget-bottom { display: flex; justify-content: space-between; align-items: center; margin-top: 6px; }
.db-budget-pct { font-family: var(--font-mono); font-size: 10.5px; font-weight: 600; }
.db-budget-pct.ok { color: var(--teal); }
.db-budget-pct.warn { color: var(--amber); }
.db-budget-pct.danger { color: var(--red); }
.db-budget-remaining { font-family: var(--font-mono); font-size: 10.5px; color: var(--muted); }

/* ── Empty state ── */
.db-empty { text-align: center; padding: 50px 20px; }
.db-empty-icon { font-size: 34px; margin-bottom: 14px; }
.db-empty-title { font-family: var(--font-display); font-size: 1.3rem; color: var(--navy); margin-bottom: 8px; }
.db-empty-text { font-size: 13px; color: var(--muted); margin-bottom: 22px; }

/* ── Alert successo ── */
.db-alert-success { background: rgba(27, 158, 120, 0.08); border: 1px solid rgba(27, 158, 120, 0.25); color: var(--teal); font-size: 13px; font-weight: 500; padding: 13px 18px; border-radius: 14px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
</style>

<div class="db">
    {{-- Top Navigation Bar --}}
    <nav class="db-nav">
        <a href="{{ route('dashboard') ?? '#' }}" class="db-brand">
            <div class="db-brand-icon">B</div>
            BudgetZen
        </a>
        <div class="db-nav-links">
            <a href="{{ route('dashboard') ?? '#' }}" class="db-nav-item">Dashboard</a>
            <a href="{{ route('admin.transactions.index') ?? '#' }}" class="db-nav-item">Transazioni</a>
            <a href="{{ route('admin.budgets.index') ?? '#' }}" class="db-nav-item active">Budget</a>
            <a href="#" class="db-nav-item">Analisi</a>
        </div>
        <div class="db-nav-right">
            <div class="db-user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'Mario Rossi', 0, 2)) }}
            </div>
        </div>
    </nav>

    {{-- Header --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>I tuoi <em>budget</em>.</h1>
            <p>Panoramica per categoria · {{ $currentMonthDate->translatedFormat('F Y') }}</p>
        </div>
        <div class="db-header-right">
            <div class="db-month-switch">
                <a href="{{ route('admin.budgets.index', ['month' => $prevMonthDate->month, 'year' => $prevMonthDate->year]) }}" aria-label="Mese precedente">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <span>{{ ucfirst($currentMonthDate->translatedFormat('M Y')) }}</span>
                <a href="{{ route('admin.budgets.index', ['month' => $nextMonthDate->month, 'year' => $nextMonthDate->year]) }}" aria-label="Mese successivo">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
            <a href="{{ route('admin.budgets.create', ['month' => $month, 'year' => $year]) }}" class="btn-new-txn">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Modifica Budget
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="db-alert-success">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($totalBudget > 0)
        {{-- Riepilogo totale mese --}}
        <div class="db-kpi-summary">
            <div>
                <div class="db-kpi-summary-label">Budget Totale del Mese</div>
                <div class="db-kpi-summary-value">
                    {{ number_format($totalSpent, 0, ',', '.') }}€ <small>/ {{ number_format($totalBudget, 0, ',', '.') }}€</small>
                </div>
            </div>
            <span class="db-kpi-summary-pct {{ $stateFor($totalPct) }}">
                {{ $totalPct }}% utilizzato
            </span>
        </div>
    @endif

    {{-- Griglia Budget per Categoria --}}
    <div class="db-card">
        <div class="db-card-head">
            <div class="db-card-title">
                <div class="db-card-title-dot" style="--dot-color:var(--blue)"></div>
                Avanzamento per Categoria
            </div>
            <a href="{{ route('admin.budgets.create', ['month' => $month, 'year' => $year]) }}" class="db-card-link">Gestisci →</a>
        </div>

        @if($categories->isEmpty() || $totalBudget == 0)
            <div class="db-empty">
                <div class="db-empty-icon">🎯</div>
                <div class="db-empty-title">Nessun budget impostato</div>
                <div class="db-empty-text">Imposta un budget per categoria per {{ $currentMonthDate->translatedFormat('F Y') }} e inizia a monitorare le tue spese.</div>
                <a href="{{ route('admin.budgets.create', ['month' => $month, 'year' => $year]) }}" class="btn-new-txn">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Imposta Budget
                </a>
            </div>
        @else
            <div class="db-budget-grid">
                @foreach($categories as $cat)
                    @php
                        $catBudget = (float) ($budgets[$cat->id] ?? 0);
                        if ($catBudget <= 0) continue;
                        $catSpent = (float) ($spentByCategory[$cat->id] ?? 0);
                        $catPct = round(($catSpent / $catBudget) * 100);
                        $state = $stateFor($catPct);
                        $remaining = $catBudget - $catSpent;
                    @endphp
                    <div class="db-budget-list">
                        <div class="db-budget-item">
                            <div class="db-budget-top">
                                <div class="db-budget-name">
                                    <div class="db-budget-name-dot" style="--state-color:var(--{{ $state === 'ok' ? 'teal' : ($state === 'warn' ? 'amber' : 'red') }})"></div>
                                    <span class="db-budget-name-text">{{ $cat->name }}</span>
                                </div>
                                <div class="db-budget-nums">
                                    <strong style="{{ $state === 'danger' ? 'color:var(--red)' : '' }}">{{ number_format($catSpent, 0, ',', '.') }}€</strong> / {{ number_format($catBudget, 0, ',', '.') }}€
                                </div>
                            </div>
                            <div class="db-track"><div class="db-fill {{ $state }}" style="width: {{ min($catPct, 100) }}%;"></div></div>
                            <div class="db-budget-bottom">
                                <span class="db-budget-pct {{ $state }}">
                                    {{ $catPct }}%{{ $state === 'danger' ? ' (Sforato)' : ' utilizzato' }}
                                </span>
                                <span class="db-budget-remaining" style="{{ $remaining < 0 ? 'color:var(--red)' : '' }}">
                                    {{ $remaining >= 0 ? number_format($remaining, 0, ',', '.') . '€ rimanenti' : number_format(abs($remaining), 0, ',', '.') . '€ extra budget' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</x-app-layout>