<x-app-layout>
@php
    $trendDefault = [
        ['label' => 'Mag', 'income' => 3100, 'expense' => 1950],
        ['label' => 'Giu', 'income' => 3250, 'expense' => 2100],
        ['label' => 'Lug', 'income' => 3400, 'expense' => 2480],
        ['label' => 'Ago', 'income' => 2950, 'expense' => 2200],
        ['label' => 'Set', 'income' => 3300, 'expense' => 1850],
        ['label' => 'Ott', 'income' => 3450, 'expense' => 1890],
    ];

    $byCategoryDefault = [
        'Alimentari' => 420,
        'Utenze'     => 260,
        'Svago'      => 190,
        'Shopping'   => 210,
        'Trasporti'  => 110,
    ];
@endphp
@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

/* ── TOP NAV ── */
.db-nav { display: flex; align-items: center; justify-content: space-between; padding: 12px 22px; background: #fff; border: 1px solid var(--border); border-radius: 18px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(11, 37, 69, 0.03); }
.db-brand { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-size: 1.35rem; color: var(--navy); text-decoration: none; }
.db-brand-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--navy); color: #fff; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; }
.db-nav-links { display: flex; align-items: center; background: var(--cream); padding: 4px; border-radius: 100px; gap: 2px; }
.db-nav-item { padding: 6px 16px; font-size: 12px; font-weight: 500; color: var(--muted); text-decoration: none; border-radius: 100px; transition: all .2s; }
.db-nav-item:hover { color: var(--navy); }
.db-nav-item.active { background: #fff; color: var(--navy); box-shadow: 0 2px 8px rgba(11, 37, 69, 0.08); }
.db-nav-right { display: flex; align-items: center; gap: 12px; }
.db-month-badge { display: inline-flex; align-items: center; gap: 7px; background: #fff; border: 1px solid var(--border); color: var(--navy); font-family: var(--font-mono); font-size: 10.5px; letter-spacing: 0.08em; text-transform: uppercase; padding: 7px 15px; border-radius: 100px; }
.db-month-badge-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--teal); box-shadow: 0 0 0 3px rgba(27, 158, 120, 0.2); animation: pulse 2.2s infinite; }
@keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(0.85); opacity: 0.45; } }
.db-user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--cream); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-size: 11px; font-weight: 600; color: var(--blue); }

/* ── HEADER ── */
.db-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
.db-header-left h1 { font-family: var(--font-display); font-size: clamp(1.9rem, 3.2vw, 2.5rem); font-weight: 400; line-height: 1.15; margin-bottom: 6px; letter-spacing: -0.01em; }
.db-header-left h1 em { font-style: italic; color: var(--blue); }
.db-header-left p { font-family: var(--font-mono); font-size: 10.5px; color: var(--muted); letter-spacing: 0.12em; text-transform: uppercase; display: flex; align-items: center; gap: 8px; }
.db-header-left p::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--blue); }
.btn-new-txn { display: inline-flex; align-items: center; gap: 8px; background: var(--navy); color: #fff; font-size: 13px; font-weight: 500; padding: 10px 20px; border-radius: 100px; border: none; cursor: pointer; transition: all .2s; box-shadow: 0 4px 16px rgba(11, 37, 69, 0.12); }
.btn-new-txn:hover { background: var(--blue); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(20, 99, 168, 0.25); }

/* ── KPI CARDS ── */
.db-kpis { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 22px; }
@media (max-width: 860px) { .db-kpis { grid-template-columns: 1fr; } }
.db-kpi { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px 26px 20px; position: relative; overflow: hidden; transition: transform .22s cubic-bezier(.22, 1, .36, 1), box-shadow .22s; }
.db-kpi:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(11, 37, 69, 0.08); }
.db-kpi::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--kpi-color, var(--blue)); }
.db-kpi-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
.db-kpi-label { font-family: var(--font-mono); font-size: 10px; color: var(--muted); letter-spacing: 0.12em; text-transform: uppercase; font-weight: 500; }
.db-kpi-icon { width: 36px; height: 36px; border-radius: 10px; background: var(--kpi-pale, #E6F1FB); display: flex; align-items: center; justify-content: center; }
.db-kpi-value { font-family: var(--font-display); font-size: clamp(2.1rem, 3.2vw, 2.6rem); font-weight: 400; color: var(--kpi-color, var(--navy)); line-height: 1; margin-bottom: 14px; }
.db-kpi-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 12px; border-top: 1px solid rgba(20, 99, 168, 0.06); }
.db-kpi-sub { font-size: 12px; color: var(--muted); }
.db-kpi-add { display: inline-flex; align-items: center; gap: 6px; font-family: var(--font-mono); font-size: 10.5px; letter-spacing: 0.06em; text-transform: uppercase; color: var(--kpi-color, var(--blue)); background: var(--kpi-pale, #E6F1FB); border: none; border-radius: 8px; padding: 5px 12px; cursor: pointer; font-weight: 500; transition: opacity .15s, transform .15s; }
.db-kpi-add:hover { opacity: 0.85; transform: scale(1.03); }

/* ── QUICK STATS ── */
.db-quick-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
@media (max-width: 900px) { .db-quick-stats { grid-template-columns: repeat(2, 1fr); } }
.db-qs { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; transition: transform .2s, box-shadow .2s; }
.db-qs:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(11, 37, 69, 0.05); }
.db-qs-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--qs-pale, var(--cream)); display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
.db-qs-label { font-family: var(--font-mono); font-size: 10px; color: var(--muted); letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 4px; }
.db-qs-value { font-size: 17px; font-weight: 600; color: var(--navy); line-height: 1; display: flex; align-items: baseline; gap: 6px; }
.db-qs-tag { font-family: var(--font-mono); font-size: 10px; font-weight: 500; color: var(--teal); background: rgba(27, 158, 120, 0.1); padding: 2px 6px; border-radius: 4px; }

/* ── 2-COL GRIDS ── */
.db-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 24px; }
@media (max-width: 900px) { .db-grid { grid-template-columns: 1fr; } }
.db-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px 26px; box-shadow: 0 4px 20px rgba(11, 37, 69, 0.02); }
.db-card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid rgba(20, 99, 168, 0.08); }
.db-card-title { font-size: 14px; font-weight: 600; color: var(--navy); display: flex; align-items: center; gap: 9px; }
.db-card-title-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--dot-color, var(--blue)); }
.db-card-link { font-family: var(--font-mono); font-size: 10.5px; color: var(--blue); text-decoration: none; letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; }
.db-card-link:hover { text-decoration: underline; }

/* ── TRANSAZIONI ── */
.db-txn-list { display: flex; flex-direction: column; gap: 10px; }
.db-txn { display: flex; align-items: center; gap: 14px; padding: 12px 14px; border-radius: 14px; background: var(--cream); transition: background .15s, transform .15s; }
.db-txn:hover { background: #edf2fb; transform: translateX(3px); }
.db-txn-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.db-txn-info { flex: 1; min-width: 0; }
.db-txn-name { font-size: 13.5px; font-weight: 600; color: var(--navy); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.db-txn-meta { font-family: var(--font-mono); font-size: 10.5px; color: var(--muted); margin-top: 3px; }
.db-txn-badge { font-family: var(--font-mono); font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 8px; flex-shrink: 0; }
.db-txn-badge.inc { color: var(--teal); background: rgba(27, 158, 120, 0.12); }
.db-txn-badge.exp { color: var(--red); background: rgba(224, 82, 82, 0.12); }

/* ── BUDGET ── */
.db-budget-list { display: flex; flex-direction: column; gap: 18px; }
.db-budget-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; }
.db-budget-name { font-size: 13.5px; font-weight: 500; color: var(--navy); display: flex; align-items: center; gap: 8px; }
.db-budget-name-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--state-color, var(--teal)); }
.db-budget-nums { font-family: var(--font-mono); font-size: 11.5px; color: var(--muted); }
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

/* ── CHARTS ── */
.chart-container { position: relative; height: 240px; width: 100%; }

/* ── MODAL ── */
.bz-modal-overlay { position: fixed; inset: 0; background: rgba(11, 37, 69, 0.45); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px; opacity: 0; pointer-events: none; transition: opacity .25s ease; }
.bz-modal-overlay.open { opacity: 1; pointer-events: all; }
.bz-modal { background: #fff; border-radius: 24px; width: 100%; max-width: 480px; box-shadow: 0 32px 80px rgba(11, 37, 69, 0.2); transform: translateY(20px) scale(0.98); transition: transform .3s cubic-bezier(.22, 1, .36, 1); overflow: hidden; }
.bz-modal-overlay.open .bz-modal { transform: translateY(0) scale(1); }
.bz-modal-header { padding: 24px 26px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
.bz-modal-title { font-family: var(--font-display); font-size: 1.45rem; font-weight: 400; color: var(--navy); }
.bz-modal-title em { font-style: italic; color: var(--blue); }
.bz-modal-close { width: 34px; height: 34px; border-radius: 10px; background: var(--cream); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--muted); transition: background .15s, color .15s; }
.bz-modal-close:hover { background: #e0e8f5; color: var(--navy); }
.bz-modal-body { padding: 24px 26px; }
.bz-type-toggle { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 22px; }
.bz-type-btn { padding: 12px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--cream); cursor: pointer; font-family: var(--font-body); font-size: 13px; font-weight: 600; color: var(--muted); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; }
.bz-type-btn.active-income { border-color: var(--teal); background: rgba(27, 158, 120, 0.08); color: var(--teal); }
.bz-type-btn.active-expense { border-color: var(--red); background: rgba(224, 82, 82, 0.08); color: var(--red); }
.bz-field { margin-bottom: 16px; }
.bz-label { display: block; font-family: var(--font-mono); font-size: 10px; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 7px; font-weight: 500; }
.bz-input, .bz-select { width: 100%; padding: 12px 14px; border: 1.5px solid var(--border); border-radius: 12px; font-family: var(--font-body); font-size: 14px; color: var(--navy); background: var(--cream); outline: none; transition: border-color .18s, box-shadow .18s; appearance: none; }
.bz-input:focus, .bz-select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(20, 99, 168, 0.1); background: #fff; }
.bz-input-amount { font-family: var(--font-mono); font-size: 24px; font-weight: 500; text-align: center; letter-spacing: 0.02em; }
.bz-input-amount:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(27, 158, 120, 0.1); }
.bz-fields-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.bz-modal-footer { padding: 0 26px 24px; display: flex; gap: 12px; }
.bz-btn-cancel { flex: 1; padding: 13px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--cream); font-family: var(--font-body); font-size: 14px; font-weight: 500; color: var(--muted); cursor: pointer; transition: background .15s, color .15s; }
.bz-btn-cancel:hover { background: #e0e8f5; color: var(--navy); }
.bz-btn-submit { flex: 2; padding: 13px; border-radius: 12px; border: none; background: var(--navy); font-family: var(--font-body); font-size: 14px; font-weight: 500; color: #fff; cursor: pointer; transition: background .18s, transform .18s, box-shadow .18s; display: flex; align-items: center; justify-content: center; gap: 8px; }
.bz-btn-submit.is-income { background: var(--teal); }
.bz-btn-submit.is-income:hover { background: #178a68; }
.bz-btn-submit.is-expense { background: var(--red); }
.bz-btn-submit.is-expense:hover { background: #c94444; }
</style>

<div class="db">
    {{-- Top Navigation Bar --}}
    <nav class="db-nav">
        <a href="#" class="db-brand">
            <div class="db-brand-icon">B</div>
            BudgetZen
        </a>
        <div class="db-nav-links">
            <a href="#" class="db-nav-item active">Dashboard</a>
            <a href="{{ route('admin.transactions.index') ?? '#' }}" class="db-nav-item">Transazioni</a>
            <a href="{{ route('admin.budgets.index') ?? '#' }}" class="db-nav-item">Budget</a>
            <a href="#" class="db-nav-item">Analisi</a>
        </div>
        <div class="db-nav-right">
            <div class="db-month-badge">
                
                {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
            </div>
            <div class="db-user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'Mario Rossi', 0, 2)) }}
            </div>
        </div>
    </nav>

    {{-- Header --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>Buongiorno, <em>{{ explode(' ', Auth::user()->name ?? 'Mario')[0] }}</em></h1>
            <p>Panoramica finanziaria personale · {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
        </div>
        <div class="db-header-right">
            <button class="btn-new-txn" onclick="openModal('income')">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuova Transazione
            </button>
        </div>
    </div>

    {{-- KPI Cards --}}
<div class="db-kpis">
    {{-- Entrate --}}
    <div class="db-kpi" style="--kpi-color:var(--teal); --kpi-pale:#E6F8F2;">
        <div class="db-kpi-top">
            <span class="db-kpi-label">Entrate Totali</span>
            <div class="db-kpi-icon">
                <svg width="16" height="16" fill="none" stroke="#1B9E78" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                </svg>
            </div>
        </div>
        <div class="db-kpi-value">+{{ number_format($income ?? 0, 0, ',', '.') }}€</div>
        <div class="db-kpi-footer">
            <span class="db-kpi-sub">
                @if(isset($incomeChange))
                    {{ $incomeChange >= 0 ? '↑' : '↓' }} {{ $incomeChange >= 0 ? '+' : '' }}{{ round($incomeChange) }}% rispetto al mese scorso
                @else
                    Nessun dato mese scorso
                @endif
            </span>
            <button class="db-kpi-add" onclick="openModal('income')">+ Entrata</button>
        </div>
    </div>

    {{-- Uscite --}}
    <div class="db-kpi" style="--kpi-color:var(--red); --kpi-pale:#FCEAEA;">
        <div class="db-kpi-top">
            <span class="db-kpi-label">Uscite Totali</span>
            <div class="db-kpi-icon">
                <svg width="16" height="16" fill="none" stroke="#E05252" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941" />
                </svg>
            </div>
        </div>
        <div class="db-kpi-value">-{{ number_format($expense ?? 0, 0, ',', '.') }}€</div>
        <div class="db-kpi-footer">
            <span class="db-kpi-sub">
                @if(isset($budgetPercentage))
                    {{ $budgetPercentage }}% del budget mensile
                @else
                    Nessun budget impostato
                @endif
            </span>
            <button class="db-kpi-add" onclick="openModal('expense')">+ Uscita</button>
        </div>
    </div>

    {{-- Saldo --}}
    @php $currentBalance = $balance ?? 0; @endphp
    <div class="db-kpi" style="--kpi-color:var(--navy); --kpi-pale:#E8EDF8;">
        <div class="db-kpi-top">
            <span class="db-kpi-label">Saldo Netto</span>
            <div class="db-kpi-icon">
                <svg width="16" height="16" fill="none" stroke="#0B2545" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="db-kpi-value" style="color:{{ $currentBalance >= 0 ? 'var(--teal)' : 'var(--red)' }}">
            {{ $currentBalance >= 0 ? '+' : '' }}{{ number_format($currentBalance, 0, ',', '.') }}€
        </div>
        <div class="db-kpi-footer">
            <span class="db-kpi-sub">{{ $currentBalance >= 0 ? 'Sei in attivo questo mese 🎉' : 'Attenzione alle spese ⚠️' }}</span>
            <span class="db-kpi-sub" style="font-family:var(--font-mono); font-size:11px;">
                Tasso risp. {{ $savingsRate ?? 0 }}%
            </span>
        </div>
    </div>
</div>

       {{-- Quick Stats Row --}}
    <div class="db-quick-stats">
        <div class="db-qs" style="--qs-pale:#E6F1FB;">
            <div class="db-qs-icon">💳</div>
            <div>
                <div class="db-qs-label">Transazioni</div>
                <div class="db-qs-value">
                    {{ isset($recent) ? $recent->count() : 28 }}
                  
                </div>
            </div>
        </div>
        <div class="db-qs" style="--qs-pale:#E6F8F2;">
            <div class="db-qs-icon">📁</div>
            <div>
                <div class="db-qs-label">Categorie Attive</div>
                <div class="db-qs-value">{{ isset($byCategory) ? count($byCategory) : 6 }} <span style="font-size:12px; color:var(--muted); font-weight:400;">su 8</span></div>
            </div>
        </div>
        <div class="db-qs" style="--qs-pale:#FFF4E6;">
            <div class="db-qs-icon">📅</div>
            <div>
                <div class="db-qs-label">Giorni al Rinnovo</div>
                <div class="db-qs-value">{{ \Carbon\Carbon::now()->daysInMonth - \Carbon\Carbon::now()->day }} <span style="font-size:12px; color:var(--muted); font-weight:400;">giorni</span></div>
            </div>
        </div>
        <div class="db-qs" style="--qs-pale:#F3E8FF;">
            <div class="db-qs-icon">🎯</div>
            <div>
                <div class="db-qs-label">Obiettivo Risparmio</div>
                <div class="db-qs-value">82% <span class="db-qs-tag" style="color:var(--purple); background:rgba(124,92,252,0.1);">In target</span></div>
            </div>
        </div>
    </div>

    {{-- Main Grid: Transazioni + Budget --}}
    <div class="db-grid">
        {{-- Ultime Transazioni --}}
        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--teal)"></div>
                    Ultime transazioni registrate
                </div>
                <a href="{{ route('admin.transactions.index') ?? '#' }}" class="db-card-link">Vedi tutte ({{ isset($recent) ? $recent->count() : 28 }}) →</a>
            </div>
            <div class="db-txn-list">
                @if(isset($recent) && $recent->isNotEmpty())
                    @foreach($recent as $txn)
                        @php
                            $isInc = $txn->type === 'income';
                            $icons = ['🛒', '🏠', '🚗', '🍔', '💡', '🎮', '✈️', '💊', '🛍️', '📦'];
                            $icon = $txn->category ? '📁' : $icons[crc32($txn->description ?? '') % count($icons)];
                        @endphp
                        <div class="db-txn">
                            <div class="db-txn-icon" style="background:{{ $isInc ? '#E6F8F2' : '#FCEAEA' }}">{{ $icon }}</div>
                            <div class="db-txn-info">
                                <div class="db-txn-name">{{ $txn->description ?: ($txn->category?->name ?? 'Transazione') }}</div>
                                <div class="db-txn-meta">{{ $txn->category?->name ?? 'Generale' }} · {{ \Carbon\Carbon::parse($txn->date)->format('d M') }}</div>
                            </div>
                            <div class="db-txn-badge {{ $isInc ? 'inc' : 'exp' }}">
                                {{ $isInc ? '+' : '-' }}{{ number_format($txn->amount, 2, ',', '.') }}€
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="db-txn">
                        <div class="db-txn-icon" style="background:#E6F8F2">💼</div>
                        <div class="db-txn-info">
                            <div class="db-txn-name">Stipendio Mensile</div>
                            <div class="db-txn-meta">Lavoro dipendente · 27 Ottobre</div>
                        </div>
                        <div class="db-txn-badge inc">+2.600,00€</div>
                    </div>
                    <div class="db-txn">
                        <div class="db-txn-icon" style="background:#FCEAEA">🛒</div>
                        <div class="db-txn-info">
                            <div class="db-txn-name">Esselunga Spesa Settimanale</div>
                            <div class="db-txn-meta">Alimentari · 26 Ottobre</div>
                        </div>
                        <div class="db-txn-badge exp">-124,50€</div>
                    </div>
                    <div class="db-txn">
                        <div class="db-txn-icon" style="background:#FCEAEA">⚡</div>
                        <div class="db-txn-info">
                            <div class="db-txn-name">Bolletta Enel Energia</div>
                            <div class="db-txn-meta">Utenze Casa · 24 Ottobre</div>
                        </div>
                        <div class="db-txn-badge exp">-86,30€</div>
                    </div>
                    <div class="db-txn">
                        <div class="db-txn-icon" style="background:#E6F8F2">💻</div>
                        <div class="db-txn-info">
                            <div class="db-txn-name">Consulenza Web UI Freelance</div>
                            <div class="db-txn-meta">Attività Extra · 22 Ottobre</div>
                        </div>
                        <div class="db-txn-badge inc">+850,00€</div>
                    </div>
                    <div class="db-txn">
                        <div class="db-txn-icon" style="background:#FCEAEA">🍔</div>
                        <div class="db-txn-info">
                            <div class="db-txn-name">Cena Ristorante La Pergola</div>
                            <div class="db-txn-meta">Svago e Ristoranti · 20 Ottobre</div>
                        </div>
                        <div class="db-txn-badge exp">-68,00€</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Avanzamento Budget Mensile --}}
        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--blue)"></div>
                    Avanzamento Budget Mensile
                </div>
                <a href="{{ route('admin.budgets.index') ?? '#' }}" class="db-card-link">Gestisci →</a>
            </div>
            <div class="db-budget-list">
                @forelse($budgetProgress ?? [] as $item)
                    <div class="db-budget-item">
                        <div class="db-budget-top">
                            <div class="db-budget-name">
                                <div class="db-budget-name-dot" style="--state-color:var(--{{ $item['state'] === 'ok' ? 'teal' : ($item['state'] === 'warn' ? 'amber' : 'red') }})"></div>
                                {{ $item['name'] }}
                            </div>
                            <div class="db-budget-nums">
                                <strong style="{{ $item['state'] === 'danger' ? 'color:var(--red)' : '' }}">{{ number_format($item['spent'], 0, ',', '.') }}€</strong> / {{ number_format($item['budget'], 0, ',', '.') }}€
                            </div>
                        </div>
                        <div class="db-track"><div class="db-fill {{ $item['state'] }}" style="width: {{ min($item['pct'], 100) }}%;"></div></div>
                        <div class="db-budget-bottom">
                            <span class="db-budget-pct {{ $item['state'] }}">
                                {{ $item['pct'] }}%{{ $item['state'] === 'danger' ? ' (Sforato)' : ' utilizzato' }}
                            </span>
                            <span class="db-budget-remaining" style="{{ $item['remaining'] < 0 ? 'color:var(--red)' : '' }}">
                                {{ $item['remaining'] >= 0 ? number_format($item['remaining'], 0, ',', '.') . '€ rimanenti' : number_format(abs($item['remaining']), 0, ',', '.') . '€ extra budget' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center; padding: 24px 10px; color: var(--muted); font-size: 13px;">
                        Nessun budget impostato per questo mese.
                        <br>
                        <a href="{{ route('admin.budgets.create') ?? '#' }}" style="color: var(--blue); font-weight: 500;">Impostane uno →</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Charts Grid --}}
    <div class="db-grid">
        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--blue)"></div>
                    Trend Entrate vs Uscite (Ultimi 6 Mesi)
                </div>
                <span style="font-family:var(--font-mono); font-size:11px; color:var(--muted);">€ / mese</span>
            </div>
            <div class="chart-container">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--purple)"></div>
                    Ripartizione Spese per Categoria
                </div>
            </div>
            <div class="chart-container">
                <canvas id="catChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- MODAL NUOVA TRANSAZIONE --}}
<div class="bz-modal-overlay" id="txnModal" onclick="handleOverlayClick(event)">
    <div class="bz-modal">
        <div class="bz-modal-header">
            <div class="bz-modal-title">Nuova <em>transazione</em></div>
            <button class="bz-modal-close" onclick="closeModal()">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.transactions.store') ?? '#' }}" method="POST">
            @csrf
            <div class="bz-modal-body">
                <div class="bz-type-toggle">
                    <button type="button" class="bz-type-btn active-income" id="btn-income" onclick="setType('income')">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>
                        Entrata
                    </button>
                    <button type="button" class="bz-type-btn" id="btn-expense" onclick="setType('expense')">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941" />
                        </svg>
                        Uscita
                    </button>
                </div>
                <input type="hidden" name="type" id="input-type" value="income">
                <div class="bz-field">
                    <label class="bz-label">Importo (€)</label>
                    <input type="number" name="amount" step="0.01" min="0.01" placeholder="0,00" class="bz-input bz-input-amount" required>
                </div>
                <div class="bz-fields-row">
                    <div class="bz-field">
                        <label class="bz-label">Categoria</label>
                        <select name="category_id" class="bz-select">
                            <option value="">— nessuna —</option>
                            @if(isset($categories))
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            @else
                                <option value="1">Alimentari</option>
                                <option value="2">Utenze</option>
                                <option value="3">Svago</option>
                                <option value="4">Shopping</option>
                            @endif
                        </select>
                    </div>
                    <div class="bz-field">
                        <label class="bz-label">Data</label>
                        <input type="date" name="date" class="bz-input" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="bz-field">
                    <label class="bz-label">Descrizione</label>
                    <input type="text" name="description" placeholder="es. Spesa supermercato" class="bz-input" maxlength="255">
                </div>
            </div>
            <div class="bz-modal-footer">
                <button type="button" class="bz-btn-cancel" onclick="closeModal()">Annulla</button>
                <button type="submit" class="bz-btn-submit is-income" id="btn-submit">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Salva transazione
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(type) {
    document.getElementById('txnModal').classList.add('open');
    document.body.style.overflow = 'hidden';
    if (type) setType(type);
}
function closeModal() {
    document.getElementById('txnModal').classList.remove('open');
    document.body.style.overflow = '';
}
function handleOverlayClick(e) {
    if (e.target === document.getElementById('txnModal')) closeModal();
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});
function setType(type) {
    document.getElementById('input-type').value = type;
    const btnIncome = document.getElementById('btn-income');
    const btnExpense = document.getElementById('btn-expense');
    const btnSubmit = document.getElementById('btn-submit');
    btnIncome.className = 'bz-type-btn' + (type === 'income' ? ' active-income' : '');
    btnExpense.className = 'bz-type-btn' + (type === 'expense' ? ' active-expense' : '');
    btnSubmit.className = 'bz-btn-submit is-' + type;
}

/* Trend Entrate vs Uscite */
const trendData = @json($trend ?? $trendDefault);
const ctxTrend = document.getElementById('trendChart');
if (ctxTrend) {
    new Chart(ctxTrend, {
        type: 'bar',
        data: {
            labels: trendData.map(d => d.label),
            datasets: [
                { label: 'Entrate', data: trendData.map(d => d.income), backgroundColor: '#1B9E78', borderRadius: 6, barPercentage: 0.6, categoryPercentage: 0.6 },
                { label: 'Uscite', data: trendData.map(d => d.expense), backgroundColor: 'rgba(224, 82, 82, 0.7)', borderRadius: 6, barPercentage: 0.6, categoryPercentage: 0.6 }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', align: 'end', labels: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0', boxWidth: 10, boxHeight: 10, usePointStyle: true } },
                tooltip: { callbacks: { label: ctx => ` ${ctx.dataset.label}: ${ctx.parsed.y.toLocaleString('it-IT')}€` } }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0' } },
                y: { grid: { color: 'rgba(20,99,168,0.06)' }, ticks: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0', callback: v => v.toLocaleString('it-IT') + '€' } }
            }
        }
    });
}

/* Donut Chart Categorie */
const catData = @json($byCategory ?? $byCategoryDefault);
const ctxCat = document.getElementById('catChart');
if (ctxCat) {
    new Chart(ctxCat, {
        type: 'doughnut',
        data: {
            labels: Object.keys(catData),
            datasets: [{
                data: Object.values(catData),
                backgroundColor: ['#1463A8', '#1B9E78', '#7C5CFC', '#E8A020', '#E05252', '#0B2545'],
                borderWidth: 3,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { position: 'bottom', labels: { font: { family: 'DM Mono', size: 10 }, color: '#6B87B0', boxWidth: 10, boxHeight: 10, padding: 12, usePointStyle: true } },
                tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.parsed.toLocaleString('it-IT')}€` } }
            }
        }
    });
}
</script>
</x-app-layout>