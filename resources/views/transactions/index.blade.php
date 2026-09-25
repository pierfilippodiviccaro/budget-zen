<x-app-layout>
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

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .tx-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 24px 24px 64px;
            font-family: var(--font-body);
            color: var(--navy);
        }

        /* ── TOP NAV ── */
        .db-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 22px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(11, 37, 69, 0.03);
        }

        .db-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: var(--font-display);
            font-size: 1.35rem;
            color: var(--navy);
            text-decoration: none;
        }

        .db-brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 600;
        }

        .db-nav-links {
            display: flex;
            align-items: center;
            background: var(--cream);
            padding: 4px;
            border-radius: 100px;
            gap: 2px;
        }

        .db-nav-item {
            padding: 7px 18px;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            border-radius: 100px;
            transition: all .2s;
        }

        .db-nav-item:hover {
            color: var(--navy);
        }

        .db-nav-item.active {
            background: #fff;
            color: var(--navy);
            box-shadow: 0 2px 8px rgba(11, 37, 69, 0.08);
        }

        .db-nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .db-month-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid var(--border);
            color: var(--navy);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 7px 15px;
            border-radius: 100px;
        }

        .db-month-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--teal);
            box-shadow: 0 0 0 3px rgba(27, 158, 120, 0.2);
            animation: pulse 2.2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(0.85);
                opacity: 0.5;
            }
        }

        .db-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--cream);
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 600;
            color: var(--blue);
        }

        /* ── TOOLBAR / HEADER ── */
        .tx-toolbar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 18px;
        }

        .tx-toolbar-left h1 {
            font-family: var(--font-display);
            font-size: clamp(1.9rem, 3.2vw, 2.5rem);
            font-weight: 400;
            line-height: 1.15;
            letter-spacing: -0.01em;
            margin-bottom: 6px;
        }

        .tx-toolbar-left h1 em {
            font-style: italic;
            color: var(--blue);
        }

        .tx-toolbar-sub {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tx-toolbar-sub::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--blue);
        }

        .tx-toolbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .tx-month-switch {
            display: inline-flex;
            align-items: center;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 3px;
            gap: 3px;
            box-shadow: 0 2px 8px rgba(11, 37, 69, 0.02);
        }

        .tx-month-arrow {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: var(--navy);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all .18s;
        }

        .tx-month-arrow:hover {
            background: var(--cream);
            color: var(--blue);
        }

        .tx-month-label {
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--navy);
            padding: 0 14px;
            white-space: nowrap;
            font-weight: 500;
        }

        .tx-pill-link {
            font-family: var(--font-mono);
            font-size: 10.5px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--navy);
            text-decoration: none;
            padding: 9px 18px;
            border: 1px solid var(--border);
            border-radius: 100px;
            background: #fff;
            transition: all .2s;
            white-space: nowrap;
            font-weight: 500;
        }

        .tx-pill-link:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--cream);
        }

        .btn-new-txn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--navy);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 100px;
            border: none;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(11, 37, 69, 0.15);
            text-decoration: none;
        }

        .btn-new-txn:hover {
            background: var(--blue);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(20, 99, 168, 0.25);
        }

        /* ── SUMMARY KPIS ── */
        .tx-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        @media (max-width: 860px) {
            .tx-summary {
                grid-template-columns: 1fr;
            }
        }

        .tx-sum-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 22px 26px 20px;
            position: relative;
            overflow: hidden;
            transition: transform .22s cubic-bezier(.22, 1, .36, 1), box-shadow .22s;
        }

        .tx-sum-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(11, 37, 69, 0.08);
        }

        .tx-sum-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--sum-color, var(--blue));
        }

        .tx-sum-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .tx-sum-label {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .tx-sum-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--sum-pale, var(--cream));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tx-sum-value {
            font-family: var(--font-display);
            font-size: clamp(2.1rem, 3.2vw, 2.5rem);
            font-weight: 400;
            color: var(--sum-color, var(--navy));
            line-height: 1;
            margin-bottom: 12px;
            letter-spacing: -0.01em;
        }

        .tx-sum-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid rgba(20, 99, 168, 0.06);
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
        }

        /* ── TABLE CARD ── */
        .tx-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(11, 37, 69, 0.02);
        }

        .tx-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid rgba(20, 99, 168, 0.08);
            flex-wrap: wrap;
            gap: 16px;
        }

        .tx-filters {
            display: flex;
            align-items: center;
            background: var(--cream);
            padding: 4px;
            border-radius: 100px;
            gap: 3px;
        }

        .tx-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 18px;
            border-radius: 100px;
            border: none;
            background: transparent;
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
            cursor: pointer;
            transition: all .18s;
            font-weight: 500;
        }

        .tx-filter-btn:hover {
            color: var(--navy);
        }

        .tx-filter-btn.active-all {
            background: var(--navy);
            color: #fff;
            box-shadow: 0 2px 8px rgba(11, 37, 69, 0.15);
        }

        .tx-filter-btn.active-income {
            background: var(--teal);
            color: #fff;
            box-shadow: 0 2px 8px rgba(27, 158, 120, 0.25);
        }

        .tx-filter-btn.active-expense {
            background: var(--red);
            color: #fff;
            box-shadow: 0 2px 8px rgba(224, 82, 82, 0.25);
        }

        .tx-search-box {
            position: relative;
        }

        .tx-search-input {
            padding: 9px 16px 9px 38px;
            border: 1.5px solid var(--border);
            border-radius: 100px;
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--navy);
            background: var(--cream);
            outline: none;
            width: 240px;
            transition: border-color .18s, background .18s, box-shadow .18s;
        }

        .tx-search-input:focus {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(20, 99, 168, 0.08);
            width: 270px;
        }

        .tx-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .tx-table-wrap {
            overflow-x: auto;
        }

        table.tx-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .tx-table thead tr {
            background: #FAFCFE;
            border-bottom: 1px solid rgba(20, 99, 168, 0.08);
        }

        .tx-table thead th {
            padding: 14px 24px;
            text-align: left;
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
            white-space: nowrap;
        }

        .tx-table tbody tr {
            border-bottom: 1px solid rgba(20, 99, 168, 0.06);
            transition: background .15s;
        }

        .tx-table tbody tr:hover {
            background: #F4F8FD;
        }

        .tx-table td {
            padding: 14px 24px;
            vertical-align: middle;
        }

        .tx-icon-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tx-row-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .tx-row-desc {
            font-weight: 600;
            color: var(--navy);
            font-size: 13.5px;
        }

        .tx-row-desc-empty {
            color: var(--muted);
            font-style: italic;
        }

        .tx-date {
            font-family: var(--font-mono);
            font-size: 11.5px;
            color: var(--muted);
            white-space: nowrap;
        }

        .tx-cat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 4px 11px;
            font-family: var(--font-mono);
            font-size: 10.5px;
            color: var(--navy);
            white-space: nowrap;
            font-weight: 500;
        }

        .tx-amount {
            font-family: var(--font-mono);
            font-size: 13.5px;
            font-weight: 600;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .tx-badge {
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .tx-badge.inc {
            color: var(--teal);
            background: rgba(27, 158, 120, 0.12);
        }

        .tx-badge.exp {
            color: var(--red);
            background: rgba(224, 82, 82, 0.12);
        }

        .tx-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #FAFCFE;
            border-top: 1px solid rgba(20, 99, 168, 0.08);
            flex-wrap: wrap;
            gap: 12px;
        }

        .tx-pagination-info {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.06em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tx-empty {
            text-align: center;
            padding: 68px 24px;
            color: var(--muted);
        }

        .tx-empty-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px;
            border: 1px solid var(--border);
        }

        .tx-empty h3 {
            font-family: var(--font-display);
            font-size: 1.4rem;
            color: var(--navy);
            margin-bottom: 6px;
        }
    </style>

    <div class="tx-container">
        {{-- Top Navigation Bar --}}
        <nav class="db-nav">
            <a href="{{ route('dashboard') ?? '#' }}" class="db-brand">
                <div class="db-brand-icon">B</div>
                BudgetZen
            </a>

            <div class="db-nav-links">
                <a href="{{ route('dashboard') ?? '#' }}" class="db-nav-item">Dashboard</a>
                <a href="{{ route('admin.transactions.index') ?? '#' }}" class="db-nav-item active">Transazioni</a>
                <a href="{{ route('admin.budgets.index') ?? '#' }}" class="db-nav-item">Budget</a>
                <a href="#" class="db-nav-item">Analisi</a>
            </div>

            <div class="db-nav-right">
                <div class="db-month-badge">
                    
                    {{ isset($currentMonth) ? $currentMonth->translatedFormat('F Y') : \Carbon\Carbon::now()->translatedFormat('F Y') }}
                </div>
                <div class="db-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'Mario Rossi', 0, 2)) }}
                </div>
            </div>
        </nav>

        {{-- Toolbar Header --}}
        <div class="tx-toolbar">
            <div class="tx-toolbar-left">
                <h1>Le tue <em>transazioni</em>.</h1>
                <div class="tx-toolbar-sub">
                    @if(isset($showAll) && $showAll)
                        Registro Storico Completo
                    @else
                        {{ isset($currentMonth) ? $currentMonth->translatedFormat('F Y') : \Carbon\Carbon::now()->translatedFormat('F Y') }} · Registro Movimenti
                    @endif
                </div>
            </div>

            <div class="tx-toolbar-right">
                @if(isset($showAll) && $showAll)
                    <a href="{{ route('admin.transactions.index') }}" class="tx-pill-link">← Torna al Mese Corrente</a>
                @elseif(isset($currentMonth))
                    <div class="tx-month-switch">
                        <a class="tx-month-arrow" href="{{ route('admin.transactions.index', ['month' => $currentMonth->copy()->subMonth()->format('Y-m')]) }}" title="Mese precedente">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                        </a>
                        <span class="tx-month-label">{{ $currentMonth->translatedFormat('F Y') }}</span>
                        <a class="tx-month-arrow" href="{{ route('admin.transactions.index', ['month' => $currentMonth->copy()->addMonth()->format('Y-m')]) }}" title="Mese successivo">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </a>
                    </div>
                    <a href="{{ route('admin.transactions.index', ['all' => 1]) }}" class="tx-pill-link">Tutte le transazioni</a>
                @endif

                <a href="{{ route('dashboard') }}" class="btn-new-txn">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuova Transazione
                </a>
            </div>
        </div>

        {{-- Summary KPI Cards --}}
        @php
            $incomeTxns = $transactions ? $transactions->where('type', 'income') : collect();
            $expenseTxns = $transactions ? $transactions->where('type', 'expense') : collect();
            $totalIncome = $incomeTxns->sum('amount');
            $totalExpense = $expenseTxns->sum('amount');
            $totalBalance = $totalIncome - $totalExpense;
        @endphp

        <div class="tx-summary">
            {{-- Entrate --}}
            <div class="tx-sum-card" style="--sum-color:var(--teal); --sum-pale:#E6F8F2;">
                <div class="tx-sum-top">
                    <span class="tx-sum-label">Entrate Totali</span>
                    <div class="tx-sum-icon">
                        <svg width="16" height="16" fill="none" stroke="#1B9E78" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                        </svg>
                    </div>
                </div>
                <div class="tx-sum-value">+{{ number_format($totalIncome, 2, ',', '.') }}€</div>
                <div class="tx-sum-footer">
                    <span>{{ $incomeTxns->count() }} accrediti registrati</span>
                    <span style="color:var(--teal); font-weight:500;">↑ +12% mese prec.</span>
                </div>
            </div>

            {{-- Uscite --}}
            <div class="tx-sum-card" style="--sum-color:var(--red); --sum-pale:#FCEAEA;">
                <div class="tx-sum-top">
                    <span class="tx-sum-label">Uscite Totali</span>
                    <div class="tx-sum-icon">
                        <svg width="16" height="16" fill="none" stroke="#E05252" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941"/>
                        </svg>
                    </div>
                </div>
                <div class="tx-sum-value">-{{ number_format($totalExpense, 2, ',', '.') }}€</div>
                <div class="tx-sum-footer">
                    <span>{{ $expenseTxns->count() }} spese contabilizzate</span>
                    <span>54% del budget</span>
                </div>
            </div>

            {{-- Saldo Netto Mese --}}
            <div class="tx-sum-card" style="--sum-color:var(--navy); --sum-pale:#E8EDF8;">
                <div class="tx-sum-top">
                    <span class="tx-sum-label">Saldo Netto Mese</span>
                    <div class="tx-sum-icon">
                        <svg width="16" height="16" fill="none" stroke="#0B2545" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="tx-sum-value" style="color:{{ $totalBalance >= 0 ? 'var(--teal)' : 'var(--red)' }}">
                    {{ $totalBalance >= 0 ? '+' : '' }}{{ number_format($totalBalance, 2, ',', '.') }}€
                </div>
                <div class="tx-sum-footer">
                    <span>{{ $transactions ? $transactions->count() : 0 }} movimenti totali</span>
                    <span style="color:{{ $totalBalance >= 0 ? 'var(--teal)' : 'var(--red)' }}; font-weight:500;">
                        {{ $totalBalance >= 0 ? 'Attivo 🎉' : 'Disavanzo ⚠️' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="tx-card">
            @if(!$transactions || $transactions->isEmpty())
                <div class="tx-empty">
                    <div class="tx-empty-icon">💸</div>
                    <h3>Nessuna transazione trovata</h3>
                    <p>Non risultano movimenti registrati per questo periodo. Aggiungine uno con il pulsante in alto.</p>
                </div>
            @else
                <div class="tx-card-head">
                    <div class="tx-filters">
                        <button class="tx-filter-btn active-all" id="filter-all" onclick="filterTx('all')">
                            Tutte ({{ $transactions->count() }})
                        </button>
                        <button class="tx-filter-btn" id="filter-income" onclick="filterTx('income')">
                            Entrate
                        </button>
                        <button class="tx-filter-btn" id="filter-expense" onclick="filterTx('expense')">
                            Uscite
                        </button>
                    </div>

                    <div class="tx-search-box">
                        <svg class="tx-search-icon" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                        <input type="text" id="tx-search-input" class="tx-search-input" placeholder="Cerca transazione o categoria…" oninput="searchTx(this.value)">
                    </div>
                </div>

                <div class="tx-table-wrap">
                    <table class="tx-table" id="tx-table">
                        <thead>
                            <tr>
                                <th>Transazione</th>
                                <th>Data</th>
                                <th>Categoria</th>
                                <th>Tipo</th>
                                <th style="text-align:right">Importo</th>
                            </tr>
                        </thead>
                        <tbody id="tx-tbody">
                            @php
                                $icons = ['🛒','🏠','🚗','🍔','💡','🎮','✈️','💊','🛍️','📦','💼','💻','⚡','☕'];
                            @endphp

                            @foreach($transactions as $txn)
                                @php
                                    $isInc = $txn->type === 'income';
                                    $icon = $txn->category ? '📁' : $icons[crc32($txn->description ?? (string)$txn->id) % count($icons)];
                                @endphp

                                <tr class="tx-row" data-type="{{ $txn->type }}" data-search="{{ strtolower(($txn->description ?? '') . ' ' . ($txn->category?->name ?? '')) }}">
                                    <td>
                                        <div class="tx-icon-cell">
                                            <div class="tx-row-icon" style="background:{{ $isInc ? '#E6F8F2' : '#FCEAEA' }}">
                                                {{ $icon }}
                                            </div>
                                            <div>
                                                <div class="tx-row-desc">{{ $txn->description ?: ($txn->category?->name ?? 'Transazione') }}</div>
                                                <div style="font-family:var(--font-mono); font-size:10.5px; color:var(--muted); margin-top:2px;">
                                                    {{ $txn->category?->name ?? 'Generale' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="tx-date">
                                            {{ \Carbon\Carbon::parse($txn->date)->translatedFormat('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="tx-cat">
                                            {{ $icon }} {{ $txn->category?->name ?? 'Nessuna' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="tx-badge {{ $isInc ? 'inc' : 'exp' }}">
                                            {{ $isInc ? 'Entrata' : 'Uscita' }}
                                        </span>
                                    </td>
                                    <td style="text-align:right">
                                        <span class="tx-amount" style="color:{{ $isInc ? 'var(--teal)' : 'var(--red)' }}">
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
                        Mostrando <strong>{{ $transactions->count() }}</strong> transazioni registrate
                    </span>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <button class="tx-pill-link" style="padding:6px 14px; font-size:10px;" disabled>← Precedente</button>
                        <button class="tx-pill-link" style="padding:6px 14px; font-size:10px;">Successiva →</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
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
                const typeMatch = currentFilter === 'all' || row.dataset.type === currentFilter;
                const searchMatch = !currentSearch || row.dataset.search.includes(currentSearch);
                const show = typeMatch && searchMatch;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            const countEl = document.getElementById('tx-count');
            if (countEl) {
                countEl.innerHTML = `Mostrando <strong>${visible}</strong> transazioni filtrate`;
            }
        }
    </script>
</x-app-layout>