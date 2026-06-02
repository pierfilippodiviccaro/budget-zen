<x-app-layout>

    @push('head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap"
            rel="stylesheet">
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
            --border: rgba(20, 99, 168, 0.14);
            --red: #E05252;
            --amber: #E8A020;

            --font-display: 'DM Serif Display', Georgia, serif;
            --font-mono: 'DM Mono', monospace;
            --font-body: 'DM Sans', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .db {
            font-family: var(--font-body);
            color: var(--navy);
            padding-bottom: 48px;
        }

        /* ════════════════════════════════
   HEADER
════════════════════════════════ */
        .db-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .db-header-left h1 {
            font-family: var(--font-display);
            font-size: clamp(1.7rem, 3vw, 2.2rem);
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 5px;
        }

        .db-header-left h1 em {
            font-style: italic;
            color: var(--blue);
        }

        .db-header-left p {
            font-family: var(--font-mono);
            font-size: 10.5px;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .db-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .db-month-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--navy);
            color: #fff;
            font-family: var(--font-mono);
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 9px 18px;
            border-radius: 100px;
        }

        .db-month-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--teal);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .4;
                transform: scale(.7);
            }
        }

        /* ════════════════════════════════
   KPI CARDS
════════════════════════════════ */
        .db-kpis {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        @media(max-width:700px) {
            .db-kpis {
                grid-template-columns: 1fr;
            }
        }

        .db-kpi {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px 26px 20px;
            position: relative;
            overflow: hidden;
            transition: transform .22s cubic-bezier(.22, 1, .36, 1), box-shadow .22s;
            cursor: default;
        }

        .db-kpi:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(11, 37, 69, 0.1);
        }

        /* top stripe */
        .db-kpi::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--kpi-color, var(--blue));
            border-radius: 18px 18px 0 0;
        }

        /* background glow */
        .db-kpi::after {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--kpi-pale, #E6F1FB), transparent 70%);
            bottom: -60px;
            right: -40px;
            pointer-events: none;
            opacity: 0.7;
        }

        .db-kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .db-kpi-label {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .db-kpi-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--kpi-pale, #E6F1FB);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .22s;
        }

        .db-kpi:hover .db-kpi-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .db-kpi-value {
            font-family: var(--font-display);
            font-size: clamp(1.9rem, 3vw, 2.4rem);
            font-weight: 400;
            color: var(--kpi-color, var(--navy));
            line-height: 1;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .db-kpi-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .db-kpi-sub {
            font-size: 12px;
            color: var(--muted);
        }

        /* Add button on KPI */
        .db-kpi-add {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--kpi-color, var(--blue));
            background: var(--kpi-pale, #E6F1FB);
            border: none;
            border-radius: 6px;
            padding: 5px 10px;
            cursor: pointer;
            transition: opacity .15s, transform .15s;
        }

        .db-kpi-add:hover {
            opacity: 0.8;
            transform: scale(1.04);
        }

        /* ════════════════════════════════
   LAYOUT GRIDS
════════════════════════════════ */
        .db-grid-wide {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        @media(max-width:900px) {
            .db-grid-wide {
                grid-template-columns: 1fr;
            }
        }

        .db-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        @media(max-width:900px) {
            .db-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ════════════════════════════════
   CARD
════════════════════════════════ */
        .db-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 22px 24px;
            transition: box-shadow .2s;
        }

        .db-card:hover {
            box-shadow: 0 8px 32px rgba(11, 37, 69, 0.07);
        }

        .db-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .db-card-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .db-card-title-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--dot-color, var(--blue));
            flex-shrink: 0;
        }

        .db-card-link {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--blue);
            text-decoration: none;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            opacity: 0.7;
            transition: opacity .15s;
        }

        .db-card-link:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* ════════════════════════════════
   TRANSAZIONI
════════════════════════════════ */
        .db-txn-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .db-txn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            border-radius: 12px;
            background: var(--cream);
            transition: background .15s, transform .15s;
        }

        .db-txn:hover {
            background: #e8eef8;
            transform: translateX(3px);
        }

        .db-txn-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .db-txn-info {
            flex: 1;
            min-width: 0;
        }

        .db-txn-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--navy);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .db-txn-meta {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
        }

        .db-txn-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .db-txn-badge.inc {
            color: var(--teal);
            background: rgba(27, 158, 120, 0.1);
        }

        .db-txn-badge.exp {
            color: var(--red);
            background: rgba(224, 82, 82, 0.1);
        }

        .db-empty {
            text-align: center;
            padding: 32px 0;
            font-size: 12px;
            color: var(--muted);
            font-family: var(--font-mono);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .db-empty-icon {
            font-size: 28px;
            margin-bottom: 10px;
            display: block;
            opacity: 0.5;
        }

        /* ════════════════════════════════
   BUDGET
════════════════════════════════ */
        .db-budget-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .db-budget-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .db-budget-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .db-budget-name-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--state-color, var(--teal));
            flex-shrink: 0;
        }

        .db-budget-nums {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
        }

        .db-track {
            height: 8px;
            background: var(--cream);
            border-radius: 6px;
            overflow: hidden;
        }

        .db-fill {
            height: 100%;
            border-radius: 6px;
            transition: width .8s cubic-bezier(.22, 1, .36, 1);
        }

        .db-fill.ok {
            background: linear-gradient(90deg, var(--teal), #2dd4a4);
        }

        .db-fill.warn {
            background: linear-gradient(90deg, var(--amber), #f5b942);
        }

        .db-fill.danger {
            background: linear-gradient(90deg, var(--red), #f07070);
        }

        .db-budget-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

        .db-budget-pct {
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 500;
        }

        .db-budget-pct.ok {
            color: var(--teal);
        }

        .db-budget-pct.warn {
            color: var(--amber);
        }

        .db-budget-pct.danger {
            color: var(--red);
        }

        .db-budget-remaining {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
        }

        /* ════════════════════════════════
   QUICK STATS ROW
════════════════════════════════ */
        .db-quick-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        @media(max-width:800px) {
            .db-quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .db-qs {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 13px;
            transition: transform .2s, box-shadow .2s;
        }

        .db-qs:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(11, 37, 69, 0.07);
        }

        .db-qs-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--qs-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .db-qs-label {
            font-family: var(--font-mono);
            font-size: 9.5px;
            color: var(--muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .db-qs-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--navy);
            line-height: 1;
        }

        /* ════════════════════════════════
   MODAL
════════════════════════════════ */
        .bz-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 37, 69, 0.45);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s;
        }

        .bz-modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .bz-modal {
            background: #fff;
            border-radius: 22px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 32px 80px rgba(11, 37, 69, 0.2);
            transform: translateY(24px) scale(0.97);
            transition: transform .3s cubic-bezier(.22, 1, .36, 1);
            overflow: hidden;
        }

        .bz-modal-overlay.open .bz-modal {
            transform: translateY(0) scale(1);
        }

        .bz-modal-header {
            padding: 24px 26px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bz-modal-title {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 400;
            color: var(--navy);
        }

        .bz-modal-title em {
            font-style: italic;
            color: var(--blue);
        }

        .bz-modal-close {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--cream);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            transition: background .15s, color .15s;
        }

        .bz-modal-close:hover {
            background: #e0e8f5;
            color: var(--navy);
        }

        .bz-modal-body {
            padding: 24px 26px;
        }

        /* Type toggle */
        .bz-type-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 22px;
        }

        .bz-type-btn {
            padding: 12px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            background: var(--cream);
            cursor: pointer;
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all .18s;
        }

        .bz-type-btn.active-income {
            border-color: var(--teal);
            background: rgba(27, 158, 120, 0.08);
            color: var(--teal);
        }

        .bz-type-btn.active-expense {
            border-color: var(--red);
            background: rgba(224, 82, 82, 0.08);
            color: var(--red);
        }

        /* Form fields */
        .bz-field {
            margin-bottom: 16px;
        }

        .bz-label {
            display: block;
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .bz-input,
        .bz-select {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 11px;
            font-family: var(--font-body);
            font-size: 14px;
            color: var(--navy);
            background: var(--cream);
            outline: none;
            transition: border-color .18s, box-shadow .18s;
            appearance: none;
        }

        .bz-input:focus,
        .bz-select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(20, 99, 168, 0.1);
            background: #fff;
        }

        .bz-input-amount {
            font-family: var(--font-mono);
            font-size: 22px;
            font-weight: 500;
            text-align: center;
            letter-spacing: 0.02em;
        }

        .bz-input-amount:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(27, 158, 120, 0.1);
        }

        .bz-fields-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .bz-modal-footer {
            padding: 0 26px 24px;
            display: flex;
            gap: 10px;
        }

        .bz-btn-cancel {
            flex: 1;
            padding: 13px;
            border-radius: 11px;
            border: 1.5px solid var(--border);
            background: var(--cream);
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .bz-btn-cancel:hover {
            background: #e0e8f5;
            color: var(--navy);
        }

        .bz-btn-submit {
            flex: 2;
            padding: 13px;
            border-radius: 11px;
            border: none;
            background: var(--navy);
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            transition: background .18s, transform .18s, box-shadow .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .bz-btn-submit:hover {
            background: var(--blue);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(20, 99, 168, 0.25);
        }

        .bz-btn-submit.is-income {
            background: var(--teal);
        }

        .bz-btn-submit.is-income:hover {
            background: #178a68;
            box-shadow: 0 6px 20px rgba(27, 158, 120, 0.3);
        }

        .bz-btn-submit.is-expense {
            background: var(--red);
        }

        .bz-btn-submit.is-expense:hover {
            background: #c94444;
            box-shadow: 0 6px 20px rgba(224, 82, 82, 0.3);
        }

        /* Success flash */
        .db-flash {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(27, 158, 120, 0.1);
            border: 1px solid rgba(27, 158, 120, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            color: var(--teal);
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* Scroll reveal */
        .db-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s cubic-bezier(.22, 1, .36, 1), transform .6s cubic-bezier(.22, 1, .36, 1);
        }

        .db-reveal.visible {
            opacity: 1;
            transform: none;
        }
    </style>

    <div class="db">

        {{-- Flash success --}}
        @if(session('success'))
            <div class="db-flash">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- ── Header ── --}}
        <div class="db-header db-reveal">
            <div class="db-header-left">
                <h1>Buongiorno, <em>{{ explode(' ', Auth::user()->name)[0] }}</em>.</h1>
                <p>panoramica finanziaria · {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
            </div>

        </div>

        {{-- ── KPI cards ── --}}
        <div class="db-kpis db-reveal" style="transition-delay:.05s">

            <div class="db-kpi" style="--kpi-color:var(--teal); --kpi-pale:#E6F8F2;">
                <div class="db-kpi-top">
                    <span class="db-kpi-label">Entrate</span>
                    <div class="db-kpi-icon">
                        <svg width="15" height="15" fill="none" stroke="#1B9E78" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>
                    </div>
                </div>
                <div class="db-kpi-value">+{{ number_format($income, 0, ',', '.') }}€</div>
                <div class="db-kpi-footer">
                    <span class="db-kpi-sub">incassati questo mese</span>
                    <button class="db-kpi-add" onclick="openModal('income')">
                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Aggiungi
                    </button>
                </div>
            </div>

            <div class="db-kpi" style="--kpi-color:var(--red); --kpi-pale:#FCEAEA;">
                <div class="db-kpi-top">
                    <span class="db-kpi-label">Uscite</span>
                    <div class="db-kpi-icon">
                        <svg width="15" height="15" fill="none" stroke="#E05252" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941" />
                        </svg>
                    </div>
                </div>
                <div class="db-kpi-value">-{{ number_format($expense, 0, ',', '.') }}€</div>
                <div class="db-kpi-footer">
                    <span class="db-kpi-sub">spesi questo mese</span>
                    <button class="db-kpi-add" onclick="openModal('expense')"
                        style="--kpi-color:var(--red); --kpi-pale:#FCEAEA;">
                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Aggiungi
                    </button>
                </div>
            </div>

            <div class="db-kpi" style="--kpi-color:var(--navy); --kpi-pale:#E8EDF8;">
                <div class="db-kpi-top">
                    <span class="db-kpi-label">Saldo</span>
                    <div class="db-kpi-icon">
                        <svg width="15" height="15" fill="none" stroke="#0B2545" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="db-kpi-value" style="color:{{ $balance >= 0 ? 'var(--teal)' : 'var(--red)' }}">
                    {{ $balance >= 0 ? '+' : '' }}{{ number_format($balance, 0, ',', '.') }}€
                </div>
                <div class="db-kpi-footer">
                    <span
                        class="db-kpi-sub">{{ $balance >= 0 ? 'sei in positivo 🎉' : 'attenzione alle spese ⚠️' }}</span>

                </div>
            </div>

        </div>

        {{-- ── Quick stats row ── --}}
        <div class="db-quick-stats db-reveal" style="transition-delay:.1s">
            <div class="db-qs" style="--qs-pale:#E6F1FB;">
                <div class="db-qs-icon">💳</div>
                <div>
                    <div class="db-qs-label">Transazioni</div>
                    <div class="db-qs-value">{{ $recent->count() > 0 ? $recent->count() . '+' : '0' }}</div>
                </div>
            </div>
            
            <div class="db-qs" style="--qs-pale:#E6F8F2;">
                <div class="db-qs-icon">📁</div>
                <div>
                    <div class="db-qs-label">Categorie</div>
                    <div class="db-qs-value">{{ $byCategory->count() }}</div>
                </div>
            </div>
            <div class="db-qs" style="--qs-pale:#FFF4E6;">
                <div class="db-qs-icon">📅</div>
                <div>
                    <div class="db-qs-label">Giorni rimasti</div>
                    <div class="db-qs-value">{{ \Carbon\Carbon::now()->daysInMonth - \Carbon\Carbon::now()->day }}</div>
                </div>
            </div>
        </div>

      
       

        {{-- ── Transazioni + Budget ── --}}
        <div class="db-grid db-reveal" style="transition-delay:.2s">

            <div class="db-card">
                <div class="db-card-head">
                    <div class="db-card-title">
                        <div class="db-card-title-dot" style="--dot-color:var(--teal)"></div>
                        Ultime transazioni
                    </div>
                    <a href="{{ route('admin.transactions.index') }}" class="db-card-link">vedi tutte →</a>
                </div>
                @if($recent->isEmpty())
                    <div class="db-empty">
                        <span class="db-empty-icon">💸</span>
                        nessuna transazione
                    </div>
                @else
                    <div class="db-txn-list">
                        @foreach($recent as $txn)
                            @php
                                $isInc = $txn->type === 'income';
                                $icons = ['🛒', '🏠', '🚗', '🍔', '💡', '🎮', '✈️', '💊', '🛍️', '📦'];
                                $icon = $txn->category ? '📁' : $icons[crc32($txn->description ?? '') % count($icons)];
                            @endphp
                            <div class="db-txn">
                                <div class="db-txn-icon" style="background:{{ $isInc ? '#E6F8F2' : '#FCEAEA' }}">{{ $icon }}
                                </div>
                                <div class="db-txn-info">
                                    <div class="db-txn-name">{{ $txn->description ?: ($txn->category?->name ?? 'Transazione') }}
                                    </div>
                                    <div class="db-txn-meta">{{ $txn->category?->name ?? '—' }} ·
                                        {{ \Carbon\Carbon::parse($txn->date)->format('d M') }}</div>
                                </div>
                                <div class="db-txn-badge {{ $isInc ? 'inc' : 'exp' }}">
                                    {{ $isInc ? '+' : '-' }}{{ number_format($txn->amount, 2, ',', '.') }}€
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            

        </div>

    </div>

   
    <div class="bz-modal-overlay" id="txnModal" onclick="handleOverlayClick(event)">
        <div class="bz-modal">

            <div class="bz-modal-header">
                <div class="bz-modal-title">Nuova <em>transazione</em></div>
                <button class="bz-modal-close" onclick="closeModal()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf
                <div class="bz-modal-body">

                    {{-- Type toggle --}}
                    <div class="bz-type-toggle">
                        <button type="button" class="bz-type-btn" id="btn-income" onclick="setType('income')">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                            Entrata
                        </button>
                        <button type="button" class="bz-type-btn" id="btn-expense" onclick="setType('expense')">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941" />
                            </svg>
                            Uscita
                        </button>
                    </div>
                    <input type="hidden" name="type" id="input-type" value="income">

                    {{-- Amount --}}
                    <div class="bz-field">
                        <label class="bz-label">Importo (€)</label>
                        <input type="number" name="amount" step="0.01" min="0.01" placeholder="0,00"
                            class="bz-input bz-input-amount" required>
                    </div>

                    {{-- Category + Description --}}
                    <div class="bz-fields-row">
                        <div class="bz-field">
                            <label class="bz-label">Categoria</label>
                            <select name="category_id" class="bz-select">
                                <option value="">— nessuna —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="bz-field">
                            <label class="bz-label">Descrizione</label>
                            <input type="text" name="description" placeholder="es. Supermercato" class="bz-input"
                                maxlength="255">
                        </div>
                        <div class="bz-field">
                            <label class="bz-label">Data</label>
                            <input type="date" name="date" class="bz-input" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                </div>

                <div class="bz-modal-footer">
                    <button type="button" class="bz-btn-cancel" onclick="closeModal()">Annulla</button>
                    <button type="submit" class="bz-btn-submit" id="btn-submit">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Salva transazione
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        /* ── Scroll reveal ── */
        const revealEls = document.querySelectorAll('.db-reveal');
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.08 });
        revealEls.forEach(el => io.observe(el));

        /* ── Modal ── */
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
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

        function setType(type) {
            document.getElementById('input-type').value = type;
            const btnIncome = document.getElementById('btn-income');
            const btnExpense = document.getElementById('btn-expense');
            const btnSubmit = document.getElementById('btn-submit');
            btnIncome.className = 'bz-type-btn' + (type === 'income' ? ' active-income' : '');
            btnExpense.className = 'bz-type-btn' + (type === 'expense' ? ' active-expense' : '');
            btnSubmit.className = 'bz-btn-submit is-' + type;
        }
        // default
        setType('income');

        /* ── Charts ── */
        const trendData = @json($trend);
        const catData = @json($byCategory);

        new Chart(document.getElementById('trendChart'), {
            type: 'bar',
            data: {
                labels: trendData.map(d => d.label),
                datasets: [
                    {
                        label: 'Entrate',
                        data: trendData.map(d => d.income),
                        backgroundColor: 'rgba(27,158,120,0.75)',
                        borderRadius: 7,
                        borderSkipped: false,
                    },
                    {
                        label: 'Uscite',
                        data: trendData.map(d => d.expense),
                        backgroundColor: 'rgba(224,82,82,0.65)',
                        borderRadius: 7,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0', boxWidth: 10, boxHeight: 10 }
                    },
                    tooltip: {
                        callbacks: { label: ctx => ` ${ctx.parsed.y.toLocaleString('it-IT')}€` }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0' } },
                    y: {
                        grid: { color: 'rgba(20,99,168,0.07)' },
                        ticks: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0', callback: v => v.toLocaleString('it-IT') + '€' }
                    }
                }
            }
        });

        if (Object.keys(catData).length) {
            const palette = ['#1463A8', '#1B9E78', '#7C5CFC', '#E8A020', '#E05252', '#0B2545', '#378ADD', '#2dd4a4'];
            new Chart(document.getElementById('catChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(catData),
                    datasets: [{
                        data: Object.values(catData),
                        backgroundColor: palette,
                        borderWidth: 3,
                        borderColor: '#fff',
                        hoverOffset: 8,
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: { family: 'DM Mono', size: 10 }, color: '#6B87B0', boxWidth: 10, boxHeight: 10, padding: 14 }
                        },
                        tooltip: {
                            callbacks: { label: ctx => ` ${ctx.parsed.toLocaleString('it-IT')}€` }
                        }
                    }
                }
            });
        }
    </script>

</x-app-layout>