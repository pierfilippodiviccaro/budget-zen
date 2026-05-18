<x-app-layout>

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    --font-display: 'DM Serif Display', Georgia, serif;
    --font-mono:    'DM Mono', monospace;
    --font-body:    'DM Sans', sans-serif;
}

.db { font-family: var(--font-body); color: var(--navy); }

/* ── Header ── */
.db-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 12px;
}
.db-header-left h1 {
    font-family: var(--font-display);
    font-size: 1.9rem;
    font-weight: 400;
    line-height: 1.1;
    margin-bottom: 4px;
}
.db-header-left h1 em { font-style: italic; color: var(--blue); }
.db-header-left p {
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--muted);
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.db-month-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--navy);
    color: #fff;
    font-family: var(--font-mono);
    font-size: 11px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 8px 16px;
    border-radius: 100px;
}
.db-month-badge span {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--teal);
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:.4; transform:scale(.7); }
}

/* ── KPI cards ── */
.db-kpis {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media(max-width:700px){ .db-kpis { grid-template-columns: 1fr; } }

.db-kpi {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
    transition: transform .2s, box-shadow .2s;
}
.db-kpi:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 36px rgba(11,37,69,0.09);
}
.db-kpi::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--kpi-color, var(--blue));
    border-radius: 16px 16px 0 0;
}
.db-kpi-label {
    font-family: var(--font-mono);
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.db-kpi-icon {
    width: 28px; height: 28px;
    border-radius: 8px;
    background: var(--kpi-pale, #E6F1FB);
    display: flex; align-items: center; justify-content: center;
}
.db-kpi-value {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 400;
    color: var(--kpi-color, var(--navy));
    line-height: 1;
    margin-bottom: 6px;
}
.db-kpi-sub {
    font-size: 12px;
    color: var(--muted);
}

/* ── Grid 2 colonne ── */
.db-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 24px;
}
@media(max-width:900px){ .db-grid { grid-template-columns: 1fr; } }

.db-grid-wide {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 16px;
    margin-bottom: 24px;
}
@media(max-width:900px){ .db-grid-wide { grid-template-columns: 1fr; } }

/* ── Card generica ── */
.db-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 22px 24px;
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
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--dot-color, var(--blue));
}
.db-card-link {
    font-family: var(--font-mono);
    font-size: 10px;
    color: var(--blue);
    text-decoration: none;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}
.db-card-link:hover { text-decoration: underline; }

/* ── Transazioni ── */
.db-txn-list { display: flex; flex-direction: column; gap: 8px; }
.db-txn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 10px;
    background: var(--cream);
    transition: background .15s;
}
.db-txn:hover { background: #eaf0fb; }
.db-txn-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.db-txn-info { flex: 1; min-width: 0; }
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
.db-txn-amt {
    font-family: var(--font-mono);
    font-size: 13px;
    font-weight: 500;
    flex-shrink: 0;
}
.db-txn-amt.inc { color: var(--teal); }
.db-txn-amt.exp { color: var(--red); }

.db-empty {
    text-align: center;
    padding: 28px 0;
    font-size: 13px;
    color: var(--muted);
    font-family: var(--font-mono);
    letter-spacing: 0.04em;
}

/* ── Budget progress ── */
.db-budget-list { display: flex; flex-direction: column; gap: 16px; }
.db-budget-item {}
.db-budget-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 7px;
}
.db-budget-name {
    font-size: 13px;
    font-weight: 500;
    color: var(--navy);
}
.db-budget-nums {
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--muted);
}
.db-track {
    height: 7px;
    background: var(--cream);
    border-radius: 4px;
    overflow: hidden;
}
.db-fill {
    height: 100%;
    border-radius: 4px;
    transition: width .6s cubic-bezier(.22,1,.36,1);
}
.db-fill.ok     { background: var(--teal); }
.db-fill.warn   { background: #E8A020; }
.db-fill.danger { background: var(--red); }
.db-budget-pct {
    font-family: var(--font-mono);
    font-size: 10px;
    margin-top: 4px;
    text-align: right;
}
.db-budget-pct.ok     { color: var(--teal); }
.db-budget-pct.warn   { color: #E8A020; }
.db-budget-pct.danger { color: var(--red); }
</style>

<div class="db">

    {{-- ── Header ── --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>Buongiorno, <em>{{ explode(' ', Auth::user()->name)[0] }}</em>.</h1>
            <p>panoramica finanziaria del mese</p>
        </div>
        <div class="db-month-badge">
            <span></span>
            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
        </div>
    </div>

    {{-- ── KPI ── --}}
    <div class="db-kpis">

        <div class="db-kpi" style="--kpi-color:var(--teal); --kpi-pale:#E6F8F2;">
            <div class="db-kpi-label">
                <div class="db-kpi-icon">
                    <svg width="14" height="14" fill="none" stroke="#1B9E78" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                    </svg>
                </div>
                Entrate
            </div>
            <div class="db-kpi-value">+{{ number_format($income, 0, ',', '.') }}€</div>
            <div class="db-kpi-sub">incassati questo mese</div>
        </div>

        <div class="db-kpi" style="--kpi-color:var(--red); --kpi-pale:#FCEAEA;">
            <div class="db-kpi-label">
                <div class="db-kpi-icon">
                    <svg width="14" height="14" fill="none" stroke="#E05252" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941"/>
                    </svg>
                </div>
                Uscite
            </div>
            <div class="db-kpi-value">-{{ number_format($expense, 0, ',', '.') }}€</div>
            <div class="db-kpi-sub">spesi questo mese</div>
        </div>

        <div class="db-kpi" style="--kpi-color:var(--navy); --kpi-pale:#E8EDF8;">
            <div class="db-kpi-label">
                <div class="db-kpi-icon">
                    <svg width="14" height="14" fill="none" stroke="#0B2545" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                Saldo
            </div>
            <div class="db-kpi-value" style="color:{{ $balance >= 0 ? 'var(--teal)' : 'var(--red)' }}">
                {{ $balance >= 0 ? '+' : '' }}{{ number_format($balance, 0, ',', '.') }}€
            </div>
            <div class="db-kpi-sub">{{ $balance >= 0 ? 'sei in positivo 🎉' : 'attenzione alle spese' }}</div>
        </div>

    </div>

    {{-- ── Trend + Torta ── --}}
    <div class="db-grid-wide">

        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--blue)"></div>
                    Andamento ultimi 6 mesi
                </div>
            </div>
            <canvas id="trendChart" height="110"></canvas>
        </div>

        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--purple)"></div>
                    Spese per categoria
                </div>
            </div>
            @if($byCategory->isEmpty())
                <div class="db-empty">nessuna spesa</div>
            @else
                <canvas id="catChart" height="180"></canvas>
            @endif
        </div>

    </div>

    {{-- ── Transazioni + Budget ── --}}
    <div class="db-grid">

        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--teal)"></div>
                    Ultime transazioni
                </div>
                {{-- <a href="{{ route('transactions.index') }}" class="db-card-link">vedi tutte →</a> --}}
            </div>
            @if($recent->isEmpty())
                <div class="db-empty">nessuna transazione</div>
            @else
                <div class="db-txn-list">
                    @foreach($recent as $txn)
                        @php
                            $isInc = $txn->type === 'income';
                            $icons = ['🛒','💼','🏠','🚗','🍔','💡','🎮','✈️','💊','🛍️'];
                            $icon  = $txn->category ? '📁' : $icons[array_rand($icons)];
                        @endphp
                        <div class="db-txn">
                            <div class="db-txn-icon" style="background:{{ $isInc ? '#E6F8F2' : '#FCEAEA' }}">
                                {{ $icon }}
                            </div>
                            <div class="db-txn-info">
                                <div class="db-txn-name">{{ $txn->description ?: ($txn->category?->name ?? 'Transazione') }}</div>
                                <div class="db-txn-meta">
                                    {{ $txn->category?->name ?? '—' }} · {{ \Carbon\Carbon::parse($txn->date)->format('d M') }}
                                </div>
                            </div>
                            <div class="db-txn-amt {{ $isInc ? 'inc' : 'exp' }}">
                                {{ $isInc ? '+' : '-' }}{{ number_format($txn->amount, 2, ',', '.') }}€
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="db-card">
            <div class="db-card-head">
                <div class="db-card-title">
                    <div class="db-card-title-dot" style="--dot-color:var(--purple)"></div>
                    Budget del mese
                </div>
                {{-- <a href="{{ route('budgets.index') }}" class="db-card-link">gestisci →</a> --}}
            </div>
            @if($budgets->isEmpty())
                <div class="db-empty">nessun budget impostato</div>
            @else
                <div class="db-budget-list">
                    @foreach($budgets as $b)
                        @php
                            $pct   = $b->percentage;
                            $state = $pct >= 90 ? 'danger' : ($pct >= 70 ? 'warn' : 'ok');
                        @endphp
                        <div class="db-budget-item">
                            <div class="db-budget-top">
                                <span class="db-budget-name">{{ $b->category?->name ?? 'Categoria' }}</span>
                                <span class="db-budget-nums">
                                    {{ number_format($b->spent, 0, ',', '.') }}€
                                    / {{ number_format($b->amount_limit, 0, ',', '.') }}€
                                </span>
                            </div>
                            <div class="db-track">
                                <div class="db-fill {{ $state }}" style="width:{{ $pct }}%"></div>
                            </div>
                            <div class="db-budget-pct {{ $state }}">{{ $pct }}%</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</div>

<script>
const trendData = @json($trend);
const catData   = @json($byCategory);

/* ── Trend chart ── */
new Chart(document.getElementById('trendChart'), {
    type: 'bar',
    data: {
        labels: trendData.map(d => d.label),
        datasets: [
            {
                label: 'Entrate',
                data: trendData.map(d => d.income),
                backgroundColor: 'rgba(27,158,120,0.75)',
                borderRadius: 6,
                borderSkipped: false,
            },
            {
                label: 'Uscite',
                data: trendData.map(d => d.expense),
                backgroundColor: 'rgba(224,82,82,0.65)',
                borderRadius: 6,
                borderSkipped: false,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    font: { family: 'DM Mono', size: 11 },
                    color: '#6B87B0',
                    boxWidth: 10,
                    boxHeight: 10,
                }
            },
            tooltip: {
                callbacks: {
                    label: ctx => ` ${ctx.parsed.y.toLocaleString('it-IT')}€`
                }
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { font: { family: 'DM Mono', size: 11 }, color: '#6B87B0' }
            },
            y: {
                grid: { color: 'rgba(20,99,168,0.07)' },
                ticks: {
                    font: { family: 'DM Mono', size: 11 },
                    color: '#6B87B0',
                    callback: v => v.toLocaleString('it-IT') + '€'
                }
            }
        }
    }
});

/* ── Categoria donut ── */
if (Object.keys(catData).length) {
    const palette = ['#1463A8','#1B9E78','#7C5CFC','#E8A020','#E05252','#0B2545','#378ADD'];
    new Chart(document.getElementById('catChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(catData),
            datasets: [{
                data: Object.values(catData),
                backgroundColor: palette,
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 6,
            }]
        },
        options: {
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'DM Mono', size: 10 },
                        color: '#6B87B0',
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 12,
                    }
                },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.toLocaleString('it-IT')}€`
                    }
                }
            }
        }
    });
}
</script>

</x-app-layout>
