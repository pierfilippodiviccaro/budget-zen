<x-app-layout>

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

<style>
:root {
    --navy:   #0B2545;
    --blue:   #1463A8;
    --teal:   #1B9E78;
    --purple: #7C5CFC;
    --cream:  #F4F7FD;
    --muted:  #6B87B0;
    --border: rgba(20,99,168,0.14);
    --red:    #E05252;
    --amber:  #E8A020;

    --font-display: 'DM Serif Display', Georgia, serif;
    --font-mono:    'DM Mono', monospace;
    --font-body:    'DM Sans', sans-serif;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.tx { font-family: var(--font-body); color: var(--navy); padding-bottom: 48px; }

/* ── Header ── */
.tx-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 14px;
}
.tx-header h1 {
    font-family: var(--font-display);
    font-size: clamp(1.7rem, 3vw, 2.2rem);
    font-weight: 400;
    line-height: 1.1;
    margin-bottom: 5px;
}
.tx-header h1 em { font-style: italic; color: var(--blue); }
.tx-header p {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* ── Summary strip ── */
.tx-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 24px;
}
@media(max-width:600px){ .tx-summary { grid-template-columns: 1fr; } }

.tx-sum-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px 22px;
    position: relative;
    overflow: hidden;
    transition: transform .2s, box-shadow .2s;
}
.tx-sum-card:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(11,37,69,0.09); }
.tx-sum-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--sum-color, var(--blue));
    border-radius: 16px 16px 0 0;
}
.tx-sum-card::after {
    content: '';
    position: absolute;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: radial-gradient(circle, var(--sum-pale, #E6F1FB), transparent 70%);
    bottom: -40px; right: -30px;
    pointer-events: none;
}
.tx-sum-label {
    font-family: var(--font-mono);
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.tx-sum-value {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 2.5vw, 2rem);
    color: var(--sum-color, var(--navy));
    line-height: 1;
    position: relative;
    z-index: 1;
}
.tx-sum-sub {
    font-size: 11px;
    color: var(--muted);
    margin-top: 5px;
    position: relative;
    z-index: 1;
}

/* ── Filters ── */
.tx-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}
.tx-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 100px;
    border: 1.5px solid var(--border);
    background: #fff;
    font-family: var(--font-mono);
    font-size: 10.5px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--muted);
    cursor: pointer;
    transition: all .18s;
}
.tx-filter-btn:hover { border-color: var(--blue); color: var(--blue); }
.tx-filter-btn.active-all     { background: var(--navy);  border-color: var(--navy);  color: #fff; }
.tx-filter-btn.active-income  { background: var(--teal);  border-color: var(--teal);  color: #fff; }
.tx-filter-btn.active-expense { background: var(--red);   border-color: var(--red);   color: #fff; }

.tx-search {
    margin-left: auto;
    position: relative;
}
.tx-search input {
    padding: 9px 14px 9px 36px;
    border: 1.5px solid var(--border);
    border-radius: 100px;
    font-family: var(--font-body);
    font-size: 13px;
    color: var(--navy);
    background: #fff;
    outline: none;
    width: 220px;
    transition: border-color .18s, box-shadow .18s;
}
.tx-search input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(20,99,168,0.1);
}
.tx-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
}

/* ── Table card ── */
.tx-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
}

.tx-table-wrap { overflow-x: auto; }

table.tx-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.tx-table thead tr {
    background: var(--cream);
    border-bottom: 1px solid var(--border);
}
.tx-table thead th {
    padding: 13px 18px;
    text-align: left;
    font-family: var(--font-mono);
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-weight: 400;
    white-space: nowrap;
}
.tx-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .13s;
}
.tx-table tbody tr:last-child { border-bottom: none; }
.tx-table tbody tr:hover { background: #f8faff; }
.tx-table td { padding: 13px 18px; vertical-align: middle; }

/* Icon cell */
.tx-icon-cell { display: flex; align-items: center; gap: 10px; }
.tx-row-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.tx-row-desc { font-weight: 500; color: var(--navy); }
.tx-row-desc-empty { color: var(--muted); font-style: italic; }

/* Date */
.tx-date {
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--muted);
    white-space: nowrap;
}

/* Category badge */
.tx-cat {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 4px 10px;
    font-family: var(--font-mono);
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 0.04em;
    white-space: nowrap;
}

/* Amount badge */
.tx-amount {
    font-family: var(--font-mono);
    font-size: 13px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 8px;
    white-space: nowrap;
}
.tx-amount.inc { color: var(--teal); background: rgba(27,158,120,0.1); }
.tx-amount.exp { color: var(--red);  background: rgba(224,82,82,0.1); }

/* Type pill */
.tx-type {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-family: var(--font-mono);
    font-size: 9.5px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 100px;
    font-weight: 500;
}
.tx-type.inc { color: var(--teal); background: rgba(27,158,120,0.1); }
.tx-type.exp { color: var(--red);  background: rgba(224,82,82,0.1); }

/* Empty state */
.tx-empty {
    text-align: center;
    padding: 56px 0;
    color: var(--muted);
}
.tx-empty-icon { font-size: 40px; display: block; margin-bottom: 14px; opacity: 0.5; }
.tx-empty h3 {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 400;
    color: var(--navy);
    margin-bottom: 6px;
}
.tx-empty p { font-size: 13px; }

/* Pagination */
.tx-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 10px;
}
.tx-pagination-info {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: var(--muted);
    letter-spacing: 0.06em;
}

/* Reveal */
.tx-reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity .6s cubic-bezier(.22,1,.36,1), transform .6s cubic-bezier(.22,1,.36,1);
}
.tx-reveal.visible { opacity: 1; transform: none; }
</style>

<div class="tx">

    {{-- ── Header ── --}}
    <div class="tx-header tx-reveal">
        <div>
            <h1>Le tue <em>transazioni</em>.</h1>
            <p>storico completo · {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
        </div>
        <a href="{{ route('dashboard') }}" style="
            display:inline-flex; align-items:center; gap:7px;
            background: var(--navy); color:#fff;
            padding: 10px 20px; border-radius: 100px;
            font-family: var(--font-mono); font-size: 10.5px;
            letter-spacing: 0.08em; text-transform: uppercase;
            text-decoration: none;
            transition: background .18s;
        " onmouseover="this.style.background='#1463A8'" onmouseout="this.style.background='#0B2545'">
            ← Dashboard
        </a>
    </div>

    {{-- ── Summary strip ── --}}
    <div class="tx-summary tx-reveal" style="transition-delay:.05s">
        @php
            $totalIncome  = $transactions->where('type','income')->sum('amount');
            $totalExpense = $transactions->where('type','expense')->sum('amount');
            $totalBalance = $totalIncome - $totalExpense;
        @endphp

        <div class="tx-sum-card" style="--sum-color:var(--teal); --sum-pale:#E6F8F2;">
            <div class="tx-sum-label">Totale entrate</div>
            <div class="tx-sum-value">+{{ number_format($totalIncome, 2, ',', '.') }}€</div>
            <div class="tx-sum-sub">{{ $transactions->where('type','income')->count() }} transazioni</div>
        </div>
        <div class="tx-sum-card" style="--sum-color:var(--red); --sum-pale:#FCEAEA;">
            <div class="tx-sum-label">Totale uscite</div>
            <div class="tx-sum-value">-{{ number_format($totalExpense, 2, ',', '.') }}€</div>
            <div class="tx-sum-sub">{{ $transactions->where('type','expense')->count() }} transazioni</div>
        </div>
        <div class="tx-sum-card" style="--sum-color:{{ $totalBalance >= 0 ? 'var(--teal)' : 'var(--red)' }}; --sum-pale:{{ $totalBalance >= 0 ? '#E6F8F2' : '#FCEAEA' }};">
            <div class="tx-sum-label">Saldo netto</div>
            <div class="tx-sum-value">{{ $totalBalance >= 0 ? '+' : '' }}{{ number_format($totalBalance, 2, ',', '.') }}€</div>
            <div class="tx-sum-sub">{{ $transactions->count() }} transazioni totali</div>
        </div>
    </div>

    {{-- ── Filters + Search ── --}}
    <div class="tx-filters tx-reveal" style="transition-delay:.1s">
        <button class="tx-filter-btn active-all" id="filter-all" onclick="filterTx('all')">
            Tutte
        </button>
        <button class="tx-filter-btn" id="filter-income" onclick="filterTx('income')">
            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22"/>
            </svg>
            Entrate
        </button>
        <button class="tx-filter-btn" id="filter-expense" onclick="filterTx('expense')">
            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22"/>
            </svg>
            Uscite
        </button>

        <div class="tx-search">
            <svg class="tx-search-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input type="text" id="tx-search-input" placeholder="Cerca transazione…" oninput="searchTx(this.value)">
        </div>
    </div>

    {{-- ── Table ── --}}
    <div class="tx-card tx-reveal" style="transition-delay:.15s">
        @if($transactions->isEmpty())
            <div class="tx-empty">
                <span class="tx-empty-icon">💸</span>
                <h3>Nessuna transazione</h3>
                <p>Aggiungi la tua prima transazione dal dashboard.</p>
            </div>
        @else
            <div class="tx-table-wrap">
                <table class="tx-table" id="tx-table">
                    <thead>
                        <tr>
                            <th>Descrizione</th>
                            <th>Data</th>
                            <th>Categoria</th>
                            <th>Tipo</th>
                            <th style="text-align:right">Importo</th>
                        </tr>
                    </thead>
                    <tbody id="tx-tbody">
                        @php
                            $icons = ['🛒','🏠','🚗','🍔','💡','🎮','✈️','💊','🛍️','📦','💼','🎵','📚','🏋️'];
                        @endphp
                        @foreach($transactions as $txn)
                            @php
                                $isInc = $txn->type === 'income';
                                $icon  = $txn->category ? '📁' : $icons[crc32($txn->description ?? $txn->id) % count($icons)];
                            @endphp
                            <tr class="tx-row" data-type="{{ $txn->type }}" data-search="{{ strtolower($txn->description . ' ' . ($txn->category?->name ?? '')) }}">
                                <td>
                                    <div class="tx-icon-cell">
                                        <div class="tx-row-icon" style="background:{{ $isInc ? '#E6F8F2' : '#FCEAEA' }}">
                                            {{ $icon }}
                                        </div>
                                        <span class="{{ $txn->description ? 'tx-row-desc' : 'tx-row-desc-empty' }}">
                                            {{ $txn->description ?: 'Nessuna descrizione' }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="tx-date">
                                        {{ \Carbon\Carbon::parse($txn->date)->translatedFormat('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="tx-cat">
                                        {{ $txn->category?->name ?? '—' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="tx-type {{ $isInc ? 'inc' : 'exp' }}">
                                        {{ $isInc ? 'Entrata' : 'Uscita' }}
                                    </span>
                                </td>
                                <td style="text-align:right">
                                    <span class="tx-amount {{ $isInc ? 'inc' : 'exp' }}">
                                        {{ $isInc ? '+' : '-' }}{{ number_format($txn->amount, 2, ',', '.') }}€
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tx-pagination">
                <span class="tx-pagination-info" id="tx-count">
                    {{ $transactions->count() }} transazioni
                </span>
            </div>
        @endif
    </div>

</div>

<script>
/* ── Scroll reveal ── */
const revealEls = document.querySelectorAll('.tx-reveal');
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.08 });
revealEls.forEach(el => io.observe(el));

/* ── Filter ── */
let currentFilter = 'all';
let currentSearch = '';

function filterTx(type) {
    currentFilter = type;
    document.querySelectorAll('.tx-filter-btn').forEach(b => {
        b.className = 'tx-filter-btn';
    });
    document.getElementById('filter-' + type).classList.add('active-' + type);
    applyFilters();
}

function searchTx(val) {
    currentSearch = val.toLowerCase();
    applyFilters();
}

function applyFilters() {
    const rows = document.querySelectorAll('.tx-row');
    let visible = 0;
    rows.forEach(row => {
        const typeMatch   = currentFilter === 'all' || row.dataset.type === currentFilter;
        const searchMatch = !currentSearch || row.dataset.search.includes(currentSearch);
        const show = typeMatch && searchMatch;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    const countEl = document.getElementById('tx-count');
    if (countEl) countEl.textContent = visible + ' transazioni';
}
</script>

</x-app-layout>