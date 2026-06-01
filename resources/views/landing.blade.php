<x-app-layout>

{{-- ═══════════════════════════════════════════════════
     GOOGLE FONTS
═══════════════════════════════════════════════════ --}}
@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

<style>
/* ─── Reset & tokens ─── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --navy:    #0B2545;
    --blue:    #1463A8;
    --teal:    #1B9E78;
    --purple:  #7C5CFC;
    --cream:   #F4F7FD;
    --muted:   #6B87B0;
    --border:  rgba(20,99,168,0.14);
    --glow-b:  rgba(20,99,168,0.22);
    --glow-t:  rgba(27,158,120,0.22);

    --font-display: 'DM Serif Display', Georgia, serif;
    --font-mono:    'DM Mono', monospace;
    --font-body:    'DM Sans', sans-serif;
}

/* ─── Page wrapper ─── */
.bz-page {
    font-family: var(--font-body);
    background: var(--cream);
    min-height: 100vh;
    overflow-x: hidden;
    position: relative;
}

/* ─── Animated mesh background ─── */
.bz-mesh {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    background:
        radial-gradient(ellipse 80% 60% at 10% 0%,   rgba(20,99,168,0.09)  0%, transparent 70%),
        radial-gradient(ellipse 60% 50% at 90% 20%,  rgba(27,158,120,0.07) 0%, transparent 70%),
        radial-gradient(ellipse 70% 60% at 50% 100%, rgba(124,92,252,0.06) 0%, transparent 70%);
    animation: meshDrift 18s ease-in-out infinite alternate;
}
@keyframes meshDrift {
    0%   { background-position: 0%   0%,   100% 0%,   50% 100%; }
    100% { background-position: 5%   5%,   95%  25%,  55% 95%;  }
}

/* Noise overlay */
.bz-noise {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    opacity: 0.025;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 180px;
}

/* ─── Content layers ─── */
.bz-content {
    position: relative;
    z-index: 1;
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 24px;
}

/* ════════════════════════════════════
   HERO
════════════════════════════════════ */
.bz-hero {
    padding: 80px 0 56px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
}
@media (max-width: 760px) {
    .bz-hero { grid-template-columns: 1fr; padding: 56px 0 40px; }
    .bz-hero-visual { display: none; }
}

/* Badge */
.bz-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(27,158,120,0.1);
    border: 1px solid rgba(27,158,120,0.28);
    border-radius: 100px;
    padding: 5px 14px 5px 10px;
    margin-bottom: 28px;
    width: fit-content;
}
.bz-badge-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--teal);
    animation: pulse 2.2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.7); }
}
.bz-badge span {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: var(--teal);
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* Headline */
.bz-hero h1 {
    font-family: var(--font-display);
    font-size: clamp(2.6rem, 4.5vw, 3.8rem);
    font-weight: 400;
    color: var(--navy);
    line-height: 1.1;
    letter-spacing: -0.01em;
    margin-bottom: 20px;
}
.bz-hero h1 em {
    font-style: italic;
    color: var(--blue);
    position: relative;
    display: inline-block;
}
.bz-hero h1 em::after {
    content: '';
    position: absolute;
    left: 0; bottom: -4px;
    width: 100%; height: 2px;
    background: linear-gradient(90deg, var(--blue), var(--teal));
    border-radius: 2px;
    transform: scaleX(0);
    transform-origin: left;
    animation: underlineIn 0.9s 0.5s cubic-bezier(0.22,1,0.36,1) forwards;
}
@keyframes underlineIn {
    to { transform: scaleX(1); }
}

.bz-hero p {
    font-size: 16px;
    color: var(--muted);
    line-height: 1.75;
    max-width: 420px;
    margin-bottom: 36px;
}

/* CTA buttons */
.bz-ctas {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.bz-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: var(--navy);
    color: #fff;
    padding: 13px 26px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    letter-spacing: 0.01em;
    transition: transform 0.18s, box-shadow 0.18s, background 0.18s;
    box-shadow: 0 4px 18px rgba(11,37,69,0.18);
}
.bz-btn-primary:hover {
    background: var(--blue);
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(20,99,168,0.28);
}
.bz-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: #fff;
    color: var(--blue);
    padding: 13px 26px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid var(--border);
    transition: transform 0.18s, box-shadow 0.18s, border-color 0.18s;
}
.bz-btn-secondary:hover {
    transform: translateY(-2px);
    border-color: var(--blue);
    box-shadow: 0 4px 16px rgba(20,99,168,0.12);
}

/* ─── Hero visual / floating dashboard mockup ─── */
.bz-hero-visual {
    position: relative;
    height: 340px;
}
.bz-mockup {
    position: absolute;
    inset: 0;
    background: #fff;
    border-radius: 18px;
    border: 1px solid var(--border);
    box-shadow: 0 24px 64px rgba(11,37,69,0.12), 0 4px 16px rgba(11,37,69,0.06);
    padding: 22px 24px;
    overflow: hidden;
    animation: floatMockup 5s ease-in-out infinite;
}
@keyframes floatMockup {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-8px); }
}
.bz-mock-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
}
.bz-mock-dot { width:10px; height:10px; border-radius:50%; }
.bz-mock-bar {
    height: 9px; border-radius: 6px; background: var(--cream);
    flex: 1;
}
.bz-mock-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
    margin-bottom: 16px;
}
.bz-mock-stat {
    background: var(--cream);
    border-radius: 10px;
    padding: 12px 14px;
}
.bz-mock-stat-label { font-size:10px; color: var(--muted); margin-bottom:4px; font-family: var(--font-mono); }
.bz-mock-stat-value { font-size:16px; font-weight:600; color: var(--navy); }
.bz-mock-chart {
    background: var(--cream);
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 14px;
    height: 100px;
    display: flex;
    align-items: flex-end;
    gap: 6px;
}
.bz-mock-bar-chart {
    flex: 1;
    border-radius: 4px 4px 0 0;
    animation: barGrow 1s cubic-bezier(0.22,1,0.36,1) both;
    transform-origin: bottom;
}
@keyframes barGrow { from { transform: scaleY(0); } to { transform: scaleY(1); } }
.bz-mock-txns { display: flex; flex-direction: column; gap: 7px; }
.bz-mock-txn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    background: var(--cream);
    border-radius: 8px;
}
.bz-mock-txn-icon {
    width: 28px; height: 28px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}
.bz-mock-txn-name { font-size:12px; color: var(--navy); font-weight:500; flex:1; }
.bz-mock-txn-amt  { font-size:12px; font-weight:600; font-family: var(--font-mono); }

/* floating chips */
.bz-chip {
    position: absolute;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 8px 14px;
    font-size: 12px;
    font-weight: 500;
    color: var(--navy);
    box-shadow: 0 6px 20px rgba(11,37,69,0.1);
    display: flex;
    align-items: center;
    gap: 7px;
    white-space: nowrap;
}
.bz-chip-1 { top: -16px; right: -12px; animation: floatMockup 4s ease-in-out infinite; }
.bz-chip-2 { bottom: -14px; left: -14px; animation: floatMockup 4s 1.5s ease-in-out infinite; }

/* ════════════════════════════════════
   DIVIDER
════════════════════════════════════ */
.bz-divider {
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), transparent);
    margin: 0 0 48px;
}

/* ════════════════════════════════════
   FEATURE CARDS
════════════════════════════════════ */
.bz-section-label {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: var(--muted);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin-bottom: 36px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.bz-section-label::before {
    content: '';
    display: block;
    width: 28px; height: 1px;
    background: var(--muted);
}

.bz-features {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 56px;
}
@media (max-width: 900px) { .bz-features { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 520px) { .bz-features { grid-template-columns: 1fr; } }

.bz-feature-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    cursor: default;
    transition: transform 0.25s cubic-bezier(0.22,1,0.36,1), box-shadow 0.25s;
    position: relative;
    overflow: hidden;
    transform-style: preserve-3d;
}
/* top accent bar */
.bz-feature-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 16px 16px 0 0;
    background: var(--card-accent, var(--blue));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s cubic-bezier(0.22,1,0.36,1);
}
.bz-feature-card:hover::before { transform: scaleX(1); }

/* glow spot on hover */
.bz-feature-card::after {
    content: '';
    position: absolute;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: var(--card-glow, rgba(20,99,168,0.08));
    top: -40px; right: -40px;
    opacity: 0;
    transition: opacity 0.3s, transform 0.3s;
    transform: scale(0.6);
}
.bz-feature-card:hover::after {
    opacity: 1;
    transform: scale(1);
}

.bz-feature-card:hover {
    box-shadow: 0 16px 48px rgba(11,37,69,0.1), 0 4px 12px rgba(11,37,69,0.05);
    transform: translateY(-4px) perspective(600px) rotateX(2deg);
}

.bz-feature-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: var(--icon-bg, #E6F1FB);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    transition: transform 0.25s cubic-bezier(0.22,1,0.36,1);
}
.bz-feature-card:hover .bz-feature-icon { transform: scale(1.1) rotate(-4deg); }

.bz-feature-card h3 {
    font-size: 15px;
    font-weight: 600;
    color: var(--navy);
    margin-bottom: 8px;
    letter-spacing: -0.01em;
}
.bz-feature-card p {
    font-size: 13px;
    color: var(--muted);
    line-height: 1.65;
}

/* ════════════════════════════════════
   STATS
════════════════════════════════════ */
.bz-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 64px;
    position: relative;
}
@media (max-width: 640px) { .bz-stats { grid-template-columns: 1fr; } }

.bz-stats::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 20px;
    border: 1px solid var(--border);
    background: #fff;
    z-index: -1;
    box-shadow: 0 8px 32px rgba(11,37,69,0.07);
}

.bz-stat-block {
    padding: 32px 28px;
    text-align: center;
    position: relative;
}
.bz-stat-block + .bz-stat-block::before {
    content: '';
    position: absolute;
    left: 0; top: 20%; bottom: 20%;
    width: 1px;
    background: var(--border);
}
@media (max-width: 640px) {
    .bz-stat-block + .bz-stat-block::before { display: none; }
}

.bz-stat-block .label {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.bz-stat-block .value {
    font-family: var(--font-display);
    font-size: clamp(2.4rem, 4vw, 3.2rem);
    font-weight: 400;
    color: var(--navy);
    line-height: 1;
    margin-bottom: 6px;
}
.bz-stat-block.is-teal   .value { color: var(--teal); }
.bz-stat-block.is-blue   .value { color: var(--blue); }
.bz-stat-block .sub {
    font-size: 12px;
    color: var(--muted);
}

/* ════════════════════════════════════
   CTA BOTTOM
════════════════════════════════════ */
.bz-cta-bottom {
    position: relative;
    overflow: hidden;
    background: var(--navy);
    border-radius: 24px;
    padding: 56px 48px;
    text-align: center;
    margin-bottom: 64px;
}
.bz-cta-bottom::before {
    content: '';
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(27,158,120,0.25), transparent 70%);
    top: -120px; left: -80px;
    pointer-events: none;
}
.bz-cta-bottom::after {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(124,92,252,0.2), transparent 70%);
    bottom: -80px; right: -60px;
    pointer-events: none;
}
/* spotlight on mouse */
.bz-spotlight {
    position: absolute;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,0.04), transparent 70%);
    pointer-events: none;
    transform: translate(-50%, -50%);
    transition: left 0.15s, top 0.15s;
}
.bz-cta-bottom .tag {
    font-family: var(--font-mono);
    font-size: 10.5px;
    color: rgba(255,255,255,0.45);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 18px;
}
.bz-cta-bottom h2 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 400;
    color: #fff;
    margin-bottom: 14px;
    line-height: 1.15;
    position: relative;
    z-index: 1;
}
.bz-cta-bottom p {
    font-size: 15px;
    color: rgba(255,255,255,0.55);
    margin-bottom: 32px;
    position: relative;
    z-index: 1;
}
.bz-btn-white {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: #fff;
    color: var(--navy);
    padding: 14px 30px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.18s, box-shadow 0.18s;
    position: relative;
    z-index: 1;
}
.bz-btn-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.25);
}
.bz-btn-outline-white {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: transparent;
    color: rgba(255,255,255,0.75);
    padding: 14px 30px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.2);
    transition: transform 0.18s, border-color 0.18s, color 0.18s;
    position: relative;
    z-index: 1;
}
.bz-btn-outline-white:hover {
    transform: translateY(-2px);
    border-color: rgba(255,255,255,0.5);
    color: #fff;
}
.bz-cta-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* ─── Scroll-in animation ─── */
.bz-reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s cubic-bezier(0.22,1,0.36,1), transform 0.7s cubic-bezier(0.22,1,0.36,1);
}
.bz-reveal.visible {
    opacity: 1;
    transform: none;
}
</style>

<div class="bz-page">
    <div class="bz-mesh"></div>
    <div class="bz-noise"></div>

    <div class="bz-content">

        {{-- ══════════════════ HERO ══════════════════ --}}
        <section class="bz-hero">
            <div>

                <h1>
                    Tieni tutto<br>
                    sotto <em>controllo</em>.<br>
                    Senza stress.
                </h1>

                <p>
                    BudgetZen ti aiuta a tracciare entrate, uscite e budget
                    mensili in un unico posto. Semplice, veloce, chiaro.
                </p>

                
            </div>

            {{-- Floating dashboard mockup --}}
            <div class="bz-hero-visual">
                <div class="bz-mockup">
                    {{-- window chrome --}}
                    <div class="bz-mock-header">
                        <div class="bz-mock-dot" style="background:#ff5f57"></div>
                        <div class="bz-mock-dot" style="background:#ffbe2e"></div>
                        <div class="bz-mock-dot" style="background:#2ac940"></div>
                        <div class="bz-mock-bar"></div>
                    </div>
                    {{-- stat row --}}
                    <div class="bz-mock-row">
                        <div class="bz-mock-stat">
                            <div class="bz-mock-stat-label">Entrate</div>
                            <div class="bz-mock-stat-value" style="color:#1B9E78">+3.240€</div>
                        </div>
                        <div class="bz-mock-stat">
                            <div class="bz-mock-stat-label">Uscite</div>
                            <div class="bz-mock-stat-value" style="color:#e05252">-1.890€</div>
                        </div>
                        <div class="bz-mock-stat">
                            <div class="bz-mock-stat-label">Saldo</div>
                            <div class="bz-mock-stat-value" style="color:#0B2545">1.350€</div>
                        </div>
                    </div>
                    {{-- mini bar chart --}}
                    <div class="bz-mock-chart">
                        @foreach([40,65,52,80,60,90,72,55,68,85,75,95] as $i => $h)
                            <div class="bz-mock-bar-chart"
                                 style="height:{{ $h }}%; background:{{ $h > 75 ? '#1B9E78' : '#dde9f5' }}; animation-delay:{{ $i * 0.05 }}s;">
                            </div>
                        @endforeach
                    </div>
                    {{-- transactions --}}
                    <div class="bz-mock-txns">
                        <div class="bz-mock-txn">
                            <div class="bz-mock-txn-icon" style="background:#E6F8F2">🛒</div>
                            <span class="bz-mock-txn-name">Supermercato</span>
                            <span class="bz-mock-txn-amt" style="color:#e05252">-64€</span>
                        </div>
                        <div class="bz-mock-txn">
                            <div class="bz-mock-txn-icon" style="background:#E6F1FB">💼</div>
                            <span class="bz-mock-txn-name">Stipendio</span>
                            <span class="bz-mock-txn-amt" style="color:#1B9E78">+1.800€</span>
                        </div>
                    </div>
                </div>

                {{-- Floating chips --}}
                <div class="bz-chip bz-chip-1">
                    <svg width="13" height="13" fill="none" stroke="#1B9E78" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                    </svg>
                    Budget +12%
                </div>
                <div class="bz-chip bz-chip-2">
                    <svg width="13" height="13" fill="none" stroke="#1463A8" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Obiettivo rispettato
                </div>
            </div>
        </section>

        <div class="bz-divider"></div>

        
        <div class="bz-section-label">Funzionalità</div>

        <div class="bz-features">

            <div class="bz-feature-card bz-reveal"
                 style="--card-accent:#1463A8; --card-glow:rgba(20,99,168,0.09); --icon-bg:#E6F1FB;">
                <div class="bz-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="#1463A8" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                    </svg>
                </div>
                <h3>Transazioni</h3>
                <p>Registra entrate e uscite in pochi secondi, con categorie e note.</p>
            </div>

            <div class="bz-feature-card bz-reveal"
                 style="--card-accent:#1B9E78; --card-glow:rgba(27,158,120,0.09); --icon-bg:#E6F8F2; transition-delay:.08s">
                <div class="bz-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="#1B9E78" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3>Budget Mensile</h3>
                <p>Imposta limiti per categoria e monitora i progressi in tempo reale.</p>
            </div>

            <div class="bz-feature-card bz-reveal"
                 style="--card-accent:#0B2545; --card-glow:rgba(11,37,69,0.09); --icon-bg:#E8EDF8; transition-delay:.16s">
                <div class="bz-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="#0B2545" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z"/>
                    </svg>
                </div>
                <h3>Categorie</h3>
                <p>Organizza le spese per tipo e analizza le tue abitudini finanziarie.</p>
            </div>

            <div class="bz-feature-card bz-reveal"
                 style="--card-accent:#7C5CFC; --card-glow:rgba(124,92,252,0.09); --icon-bg:#F3EEFF; transition-delay:.24s">
                <div class="bz-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="#7C5CFC" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                    </svg>
                </div>
                <h3>Report & Grafici</h3>
                <p>Visualizza l'andamento mensile e annuale delle tue finanze.</p>
            </div>

        </div>

        {{-- ══════════════════ STATS ══════════════════ --}}
        <div class="bz-stats bz-reveal" style="transition-delay:.1s">
            <div class="bz-stat-block">
                <div class="label">utenti attivi</div>
                <div class="value" data-count="{{ $stats['active_users'] }}">0</div>
                <div class="sub">e in crescita ogni mese</div>
            </div>
            <div class="bz-stat-block is-teal">
                <div class="label">transazioni tracciate</div>
                <div class="value" data-count="{{ $stats['total_transactions'] }}">0</div>
                <div class="sub">dal lancio della piattaforma</div>
            </div>
            <div class="bz-stat-block is-blue">
                <div class="label">budget rispettati</div>
                <div class="value" data-count="{{ $stats['budget_success_rate'] }}" data-suffix="%">0%</div>
                <div class="sub">degli obiettivi completati</div>
            </div>
        </div>

        {{-- ══════════════════ CTA BOTTOM ══════════════════ --}}
        <div class="bz-cta-bottom bz-reveal" id="bz-cta">
            <div class="bz-spotlight" id="bz-spotlight"></div>
            <div class="tag">Inizia oggi</div>
            <h2>Pronto a prendere<br>il controllo delle tue finanze?</h2>
            <p>Crea un account gratuito in meno di un minuto.<br>Nessuna carta richiesta.</p>
            <div class="bz-cta-btns">
                @guest
                    <a href="{{ route('register') }}" class="bz-btn-white">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Registrati gratis
                    </a>
                    <a href="{{ route('login') }}" class="bz-btn-outline-white">
                        Hai già un account? Accedi
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bz-btn-white">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                        Vai al Dashboard
                    </a>
                @endguest
            </div>
        </div>

    </div>{{-- /bz-content --}}
</div>{{-- /bz-page --}}

<script>
/* ─── Scroll reveal ─── */
const revealEls = document.querySelectorAll('.bz-reveal');
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.12 });
revealEls.forEach(el => io.observe(el));

/* ─── Count-up animation ─── */
function countUp(el, target, suffix = '') {
    const dur = 1600;
    const start = performance.now();
    (function step(now) {
        const p = Math.min((now - start) / dur, 1);
        const ease = 1 - Math.pow(1 - p, 4);
        const val = Math.round(ease * target);
        el.textContent = val.toLocaleString('it-IT') + suffix;
        if (p < 1) requestAnimationFrame(step);
    })(start);
}
const statIo = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.querySelectorAll('[data-count]').forEach(el => {
                countUp(el, +el.dataset.count, el.dataset.suffix || '');
            });
            statIo.unobserve(e.target);
        }
    });
}, { threshold: 0.3 });
document.querySelectorAll('.bz-stats').forEach(el => statIo.observe(el));

/* ─── CTA spotlight effect ─── */
const cta = document.getElementById('bz-cta');
const spot = document.getElementById('bz-spotlight');
if (cta && spot) {
    cta.addEventListener('mousemove', e => {
        const r = cta.getBoundingClientRect();
        spot.style.left = (e.clientX - r.left) + 'px';
        spot.style.top  = (e.clientY - r.top)  + 'px';
    });
}

/* ─── Card 3D tilt ─── */
document.querySelectorAll('.bz-feature-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const r = card.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width  - 0.5;
        const y = (e.clientY - r.top)  / r.height - 0.5;
        card.style.transform = `translateY(-4px) perspective(600px) rotateX(${-y*6}deg) rotateY(${x*6}deg)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});
</script>

</x-app-layout>