<x-app-layout>
    {{-- ═══════════════════════════════════════════════════ GOOGLE FONTS & TAILWIND INTEGRATION ═══════════════════════════════════════════════════ --}}
    @push('head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @endpush

    <style>
        /* ─── Variabili e Token Colore Fedeli ─── */
        :root {
            --navy: #0B2545;
            --blue: #1463A8;
            --teal: #1B9E78;
            --purple: #7C5CFC;
            --cream: #F4F7FD;
            --muted: #6B87B0;
            --border: rgba(20,99,168,0.12);
            --font-display: 'DM Serif Display', Georgia, serif;
            --font-mono: 'DM Mono', monospace;
            --font-body: 'DM Sans', sans-serif;
        }

        .bz-page {
            font-family: var(--font-body);
            background: var(--cream);
            color: var(--navy);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Sfondo mesh fluido */
        .bz-mesh {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle 700px at 5% 10%, rgba(20,99,168,0.08) 0%, transparent 70%),
                radial-gradient(circle 600px at 95% 20%, rgba(27,158,120,0.07) 0%, transparent 65%),
                radial-gradient(circle 800px at 50% 90%, rgba(124,92,252,0.06) 0%, transparent 70%);
            animation: meshDrift 20s ease-in-out infinite alternate;
        }

        @keyframes meshDrift {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.04) translate(-15px, 20px); }
        }

        .bz-content {
            position: relative;
            z-index: 1;
            max-width: 1160px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Animazione sottolineatura corsivo */
        .bz-em {
            font-style: italic;
            color: var(--blue);
            position: relative;
            display: inline-block;
        }
        .bz-em::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--blue), var(--teal));
            border-radius: 4px;
            transform: scaleX(0);
            transform-origin: left;
            animation: underlineExpand 1s 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes underlineExpand {
            to { transform: scaleX(1); }
        }

        /* Mockup con fluttuazione delicata */
        .bz-mockup-wrapper {
            animation: gentleFloat 6s ease-in-out infinite;
            box-shadow: 0 24px 60px -15px rgba(11, 37, 69, 0.16), 0 0 0 1px rgba(20, 99, 168, 0.1);
        }
        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* Cards funzionalità in vetro */
        .bz-glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-top: 3px solid var(--accent, var(--blue));
            box-shadow: 0 10px 25px -5px rgba(11, 37, 69, 0.05);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .bz-glass-card:hover {
            background: #ffffff;
            box-shadow: 0 20px 40px -8px rgba(11, 37, 69, 0.12);
            transform: translateY(-4px);
        }
    </style>

    <div class="bz-page">
        <div class="bz-mesh"></div>

        {{-- NAVBAR --}}
        <header class="relative z-20 border-b border-[#1463A8]/10 bg-white/80 backdrop-blur-md sticky top-0">
            <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0B2545] via-[#1463A8] to-[#1B9E78] flex items-center justify-center text-white shadow-md">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18c-4.5 0-8 3.5-8 8s3.5 8 8 8m0-16c4.5 0 8 3.5 8 8s-3.5 8-8 8M7 9h10M8 15h8"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-['DM_Serif_Display'] text-xl text-[#0B2545]">Budget<span class="text-[#1B9E78]">Zen</span></span>
                        <span class="text-[10px] font-mono tracking-widest uppercase text-[#6B87B0]">Smart Finance</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-[#0B2545]/80">
                    <a href="#funzionalita" class="hover:text-[#1463A8] transition">Funzionalità</a>
                    <a href="#metriche" class="hover:text-[#1463A8] transition">Numeri</a>
                    <a href="#sicurezza" class="hover:text-[#1463A8] transition">Sicurezza</a>
                </nav>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-[#0B2545] hover:text-[#1463A8] px-4 py-2">Accedi</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-[#0B2545] hover:bg-[#1463A8] text-white px-5 py-2.5 rounded-xl shadow-sm transition hover:-translate-y-0.5">Inizia gratis</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium bg-[#0B2545] text-white px-5 py-2.5 rounded-xl">Dashboard</a>
                    @endguest
                </div>
            </div>
        </header>

        <div class="bz-content">
            {{-- HERO SECTION --}}
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center pt-12 pb-20">
                <div class="lg:col-span-6">
                    <div class="inline-flex items-center gap-2 bg-[#1B9E78]/10 border border-[#1B9E78]/25 rounded-full px-3.5 py-1 mb-6">
                       
                        <span class="font-mono text-[11px] font-semibold tracking-wider text-[#1B9E78] uppercase">Budgeting 2.0 • Semplificato</span>
                    </div>

                    <h1 class="font-['DM_Serif_Display'] text-4xl sm:text-5xl lg:text-[3.5rem] leading-[1.12] text-[#0B2545] mb-6">
                        Tieni tutto<br> sotto <span class="bz-em">controllo</span>.<br> Senza alcuno stress.
                    </h1>

                    <p class="text-base sm:text-lg text-[#6B87B0] leading-relaxed max-w-lg mb-8">
                        BudgetZen ti aiuta a tracciare entrate, spese ricorrenti e budget mensili in un’unica dashboard intuitiva. Chiarezza istantanea sui tuoi flussi, senza formule complesse.
                    </p>

                    <div class="flex flex-wrap items-center gap-3.5 mb-10">
                        <a href="#cta" class="inline-flex items-center gap-2 bg-[#0B2545] hover:bg-[#1463A8] text-white px-7 py-3.5 rounded-xl text-sm font-medium transition shadow-lg shadow-[#0B2545]/20 hover:-translate-y-0.5">
                            Inizia la prova gratuita
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <a href="#funzionalita" class="inline-flex items-center gap-2 bg-white text-[#1463A8] border border-[#1463A8]/20 hover:border-[#1463A8] px-6 py-3.5 rounded-xl text-sm font-medium transition hover:-translate-y-0.5">
                            Guarda come funziona
                        </a>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-[#1463A8]/10">
                        <span class="text-amber-400 text-sm">★★★★★</span>
                        <span class="text-xs font-bold text-[#0B2545]">4.9/5</span>
                        <span class="text-xs text-[#6B87B0]">• Oltre 18.000 risparmiatori attivi in Europa</span>
                    </div>
                </div>

                {{-- Mockup con card dinamica --}}
                <div class="lg:col-span-6 relative">
                    <div class="bz-mockup-wrapper bg-white/95 rounded-2xl border border-[#1463A8]/15 p-6 backdrop-blur-xl">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#1463A8]/10">
                            <div class="flex gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#ff5f57]"></span>
                                <span class="w-3 h-3 rounded-full bg-[#ffbd2e]"></span>
                                <span class="w-3 h-3 rounded-full bg-[#28c840]"></span>
                            </div>
                            <span class="text-[11px] font-mono text-[#6B87B0]">Filtro: Maggio 2025</span>
                            <span class="text-[10px] font-mono text-[#1B9E78] font-bold">● Live Sync</span>
                        </div>

                        <div class="grid grid-cols-3 gap-3 mb-5">
                            <div class="bg-[#F4F7FD] p-3 rounded-xl">
                                <div class="text-[10px] font-mono text-[#6B87B0] uppercase">Entrate</div>
                                <div class="text-base font-bold text-[#1B9E78] font-mono">+3.240€</div>
                            </div>
                            <div class="bg-[#F4F7FD] p-3 rounded-xl">
                                <div class="text-[10px] font-mono text-[#6B87B0] uppercase">Uscite</div>
                                <div class="text-base font-bold text-[#e05252] font-mono">-1.890€</div>
                            </div>
                            <div class="bg-[#E6F1FB] p-3 rounded-xl border border-[#1463A8]/20">
                                <div class="text-[10px] font-mono text-[#1463A8] uppercase">Saldo</div>
                                <div class="text-base font-bold text-[#0B2545] font-mono">1.350€</div>
                            </div>
                        </div>

                        {{-- Lista Transazioni --}}
                        <div class="space-y-2">
                            <div class="flex items-center justify-between bg-white border border-[#1463A8]/10 rounded-xl p-2.5">
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#0B2545]">
                                    <span class="p-1 bg-[#E6F8F2] rounded">🛒</span> Esselunga Superstore
                                </div>
                                <span class="text-xs font-mono font-bold text-[#e05252]">-64,50€</span>
                            </div>
                            <div class="flex items-center justify-between bg-white border border-[#1463A8]/10 rounded-xl p-2.5">
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#0B2545]">
                                    <span class="p-1 bg-[#E6F1FB] rounded">💼</span> Bonifico Stipendio
                                </div>
                                <span class="text-xs font-mono font-bold text-[#1B9E78]">+1.800,00€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- FEATURES --}}
            <section id="funzionalita" class="mb-20">
                <div class="text-left mb-10">
                    <span class="font-mono text-xs uppercase tracking-wider text-[#1463A8] font-bold">Funzionalità Chiave</span>
                    <h2 class="font-['DM_Serif_Display'] text-3xl sm:text-4xl text-[#0B2545] mt-1">Tutto il necessario per le tue finanze</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bz-glass-card rounded-2xl p-6" style="--accent:#1463A8">
                        <div class="w-10 h-10 rounded-xl bg-[#E6F1FB] text-[#1463A8] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                        </div>
                        <h3 class="font-semibold text-[#0B2545] mb-2">Transazioni Rapide</h3>
                        <p class="text-xs text-[#6B87B0] leading-relaxed">Registra ogni entrata e uscita in 3 secondi con categorizzazione istantanea.</p>
                    </div>

                    <div class="bz-glass-card rounded-2xl p-6" style="--accent:#1B9E78">
                        <div class="w-10 h-10 rounded-xl bg-[#E6F8F2] text-[#1B9E78] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-semibold text-[#0B2545] mb-2">Budget Dinamici</h3>
                        <p class="text-xs text-[#6B87B0] leading-relaxed">Imposta tetti di spesa mensili e ricevi alert prima di superare i limiti prefissati.</p>
                    </div>

                    <div class="bz-glass-card rounded-2xl p-6" style="--accent:#0B2545">
                        <div class="w-10 h-10 rounded-xl bg-[#E8EDF8] text-[#0B2545] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z"/></svg>
                        </div>
                        <h3 class="font-semibold text-[#0B2545] mb-2">Auto-Categorizzazione</h3>
                        <p class="text-xs text-[#6B87B0] leading-relaxed">Algoritmi smart che riconoscono i tuoi acquisti e dividono le spese fisse dal superfluo.</p>
                    </div>

                    <div class="bz-glass-card rounded-2xl p-6" style="--accent:#7C5CFC">
                        <div class="w-10 h-10 rounded-xl bg-[#F3EEFF] text-[#7C5CFC] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        </div>
                        <h3 class="font-semibold text-[#0B2545] mb-2">Report & Trend</h3>
                        <p class="text-xs text-[#6B87B0] leading-relaxed">Analisi visive dettagliate sull'andamento mese su mese ed esportazione istantanea.</p>
                    </div>
                </div>
            </section>

            {{-- STATS STRIP --}}
            <section id="metriche" class="mb-20">
                <div class="bg-white rounded-3xl border border-[#1463A8]/15 shadow-lg p-8 sm:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-[#1463A8]/10 text-center">
                        <div class="px-4">
                            <div class="font-mono text-xs text-[#6B87B0] uppercase mb-2">Utenti Attivi</div>
                            <div class="font-['DM_Serif_Display'] text-4xl text-[#0B2545] mb-1">18.450+</div>
                            <div class="text-xs text-[#6B87B0]">Risparmiatori in costante crescita</div>
                        </div>
                        <div class="px-4 pt-6 md:pt-0">
                            <div class="font-mono text-xs text-[#1B9E78] uppercase mb-2">Transazioni Tracciate</div>
                            <div class="font-['DM_Serif_Display'] text-4xl text-[#1B9E78] mb-1">2.4M€</div>
                            <div class="text-xs text-[#6B87B0]">Monitorati in totale sicurezza</div>
                        </div>
                        <div class="px-4 pt-6 md:pt-0">
                            <div class="font-mono text-xs text-[#1463A8] uppercase mb-2">Budget Rispettati</div>
                            <div class="font-['DM_Serif_Display'] text-4xl text-[#1463A8] mb-1">94%</div>
                            <div class="text-xs text-[#6B87B0]">Degli obiettivi raggiunti</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA BOTTOM CON SPOTLIGHT --}}
            <section id="cta" class="mb-16">
                <div id="bz-cta" class="relative rounded-3xl p-10 sm:p-16 text-center overflow-hidden bg-gradient-to-b from-[#113460] to-[#0B2545] shadow-2xl">
                    <div id="bz-spotlight" class="absolute w-[450px] h-[450px] rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2" style="background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);"></div>

                    <div class="relative z-10 max-w-xl mx-auto">
                        <div class="inline-block bg-white/10 text-white/80 border border-white/20 text-xs font-mono uppercase px-3.5 py-1 rounded-full mb-5">
                            Inizia in 60 secondi • Nessuna carta
                        </div>
                        <h2 class="font-['DM_Serif_Display'] text-3xl sm:text-4xl text-white mb-4">
                            Pronto a prendere il controllo delle tue finanze?
                        </h2>
                        <p class="text-white/70 text-sm sm:text-base mb-8 font-light">
                            Crea il tuo profilo gratuito in meno di un minuto e sperimenta la serenità di BudgetZen.
                        </p>
                        <div class="flex flex-wrap items-center justify-center gap-4">
                            <a href="{{ route('register') }}" class="bg-white hover:bg-[#F4F7FD] text-[#0B2545] font-semibold px-8 py-3.5 rounded-xl text-sm transition shadow-lg hover:-translate-y-0.5">
                                Registrati gratis
                            </a>
                            <a href="{{ route('login') }}" class="border border-white/30 hover:border-white/70 text-white font-medium px-8 py-3.5 rounded-xl text-sm transition">
                                Hai già un account? Accedi
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Spotlight effect per la sezione CTA finale
        const cta = document.getElementById('bz-cta');
        const spot = document.getElementById('bz-spotlight');
        if (cta && spot) {
            cta.addEventListener('mousemove', e => {
                const r = cta.getBoundingClientRect();
                spot.style.left = (e.clientX - r.left) + 'px';
                spot.style.top = (e.clientY - r.top) + 'px';
            });
        }

        // 3D tilt delicato per le card funzionalità
        document.querySelectorAll('.bz-glass-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width - 0.5;
                const y = (e.clientY - r.top) / r.height - 0.5;
                card.style.transform = `perspective(600px) rotateX(${-y * 6}deg) rotateY(${x * 6}deg) translateY(-4px)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
    </script>
</x-app-layout>