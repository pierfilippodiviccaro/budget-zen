<x-app-layout>
    {{-- HERO --}}
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding: 60px 20px 40px;">
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(29,158,117,0.12); border:1px solid rgba(29,158,117,0.3); border-radius:20px; padding:5px 14px; margin-bottom:28px;">
            <div style="width:6px; height:6px; border-radius:50%; background:#1D9E75;"></div>
            <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#1D9E75; letter-spacing:0.08em; text-transform:uppercase;">finance tracker</span>
        </div>

        <h1 style="font-size:clamp(2.2rem, 5vw, 3.6rem); font-weight:600; color:#0C2D6B; line-height:1.15; letter-spacing:-0.02em; max-width:640px; margin-bottom:18px;">
            Tieni tutto sotto controllo.<br>
            <span style="color:#185FA5;">Senza stress.</span>
        </h1>

        <p style="font-size:16px; color:#5a7aaa; max-width:480px; line-height:1.7; margin-bottom:36px;">
            BudgetZen ti aiuta a tracciare entrate, uscite e budget mensili in un unico posto. Semplice, veloce, chiaro.
        </p>

        <div style="display:flex; gap:12px; flex-wrap:wrap; justify-content:center;">
            @guest
                <a href="{{ route('register') }}" style="display:inline-flex; align-items:center; gap:8px; background:#0C2D6B; color:#fff; padding:12px 24px; border-radius:9px; font-size:14px; font-weight:500; text-decoration:none;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Inizia gratis
                </a>
                <a href="{{ route('login') }}" style="display:inline-flex; align-items:center; gap:8px; background:transparent; color:#185FA5; padding:12px 24px; border-radius:9px; font-size:14px; font-weight:500; text-decoration:none; border:1px solid #dde6f5;">
                    Accedi
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            @else
                <a href="{{ route('dashboard') }}" style="display:inline-flex; align-items:center; gap:8px; background:#0C2D6B; color:#fff; padding:12px 24px; border-radius:9px; font-size:14px; font-weight:500; text-decoration:none;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Vai al Dashboard
                </a>
            @endguest
        </div>
    </div>

    {{-- FEATURE CARDS --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:14px; margin:0 auto 32px; max-width:1200px; padding:0 20px;">

        {{-- Card 1: Transazioni --}}
        <div class="bz-card" style="border-top:3px solid #185FA5;">
            <div style="width:38px; height:38px; border-radius:9px; background:#E6F1FB; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                <svg width="18" height="18" fill="none" stroke="#185FA5" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                </svg>
            </div>
            <p style="font-size:14px; font-weight:500; color:#0C2D6B; margin-bottom:6px;">Transazioni</p>
            <p style="font-size:13px; color:#5a7aaa; line-height:1.6;">Registra entrate e uscite in pochi secondi.</p>
        </div>

        {{-- Card 2: Budget --}}
        <div class="bz-card" style="border-top:3px solid #1D9E75;">
            <div style="width:38px; height:38px; border-radius:9px; background:#E6F8F2; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                <svg width="18" height="18" fill="none" stroke="#1D9E75" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p style="font-size:14px; font-weight:500; color:#0C2D6B; margin-bottom:6px;">Budget Mensile</p>
            <p style="font-size:13px; color:#5a7aaa; line-height:1.6;">Imposta limiti di spesa e monitora i progressi.</p>
        </div>

        {{-- Card 3: Categorie --}}
        <div class="bz-card" style="border-top:3px solid #0C2D6B;">
            <div style="width:38px; height:38px; border-radius:9px; background:#E8EDF8; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                <svg width="18" height="18" fill="none" stroke="#0C2D6B" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                    <path stroke-linecap="round" d="M6 6h.008v.008H6V6z"/>
                </svg>
            </div>
            <p style="font-size:14px; font-weight:500; color:#0C2D6B; margin-bottom:6px;">Categorie</p>
            <p style="font-size:13px; color:#5a7aaa; line-height:1.6;">Organizza le spese per categoria e analizza le abitudini.</p>
        </div>

        {{-- Card 4: Report --}}
        <div class="bz-card" style="border-top:3px solid #8B5CF6;">
            <div style="width:38px; height:38px; border-radius:9px; background:#F3EEFF; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                <svg width="18" height="18" fill="none" stroke="#8B5CF6" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                </svg>
            </div>
            <p style="font-size:14px; font-weight:500; color:#0C2D6B; margin-bottom:6px;">Report & Grafici</p>
            <p style="font-size:13px; color:#5a7aaa; line-height:1.6;">Visualizza l'andamento delle finanze nel tempo.</p>
        </div>

    </div>

    {{-- STATS DINAMICHE DAL DB --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:12px; margin:0 auto 40px; max-width:1200px; padding:0 20px;">
        <div class="bz-stat navy" style="text-align:center;">
            <div class="bz-stat-label">utenti attivi</div>
            <div class="bz-stat-value">{{ number_format($stats['active_users']) }}+</div>
        </div>
        <div class="bz-stat green" style="text-align:center;">
            <div class="bz-stat-label">transazioni tracciate</div>
            <div class="bz-stat-value">{{ number_format($stats['total_transactions']) }}+</div>
        </div>
        <div class="bz-stat blue" style="text-align:center;">
            <div class="bz-stat-label">budget rispettati</div>
            <div class="bz-stat-value">{{ $stats['budget_success_rate'] }}%</div>
        </div>
    </div>

    {{-- CTA BOTTOM --}}
    <div class="bz-card" style="text-align:center; padding:36px 24px; border:1px solid #dde6f5; max-width:500px; margin:0 auto;">
        <p style="font-size:18px; font-weight:600; color:#0C2D6B; margin-bottom:10px;">Pronto a iniziare?</p>
        <p style="font-size:14px; color:#5a7aaa; margin-bottom:24px;">Crea un account gratuito in meno di un minuto.</p>
        @guest
            <a href="{{ route('register') }}" style="display:inline-flex; align-items:center; gap:8px; background:#1D9E75; color:#fff; padding:12px 28px; border-radius:9px; font-size:14px; font-weight:500; text-decoration:none;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Registrati ora
            </a>
        @else
            <a href="{{ route('dashboard') }}" style="display:inline-flex; align-items:center; gap:8px; background:#1D9E75; color:#fff; padding:12px 28px; border-radius:9px; font-size:14px; font-weight:500; text-decoration:none;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
                Vai al Dashboard
            </a>
        @endguest
    </div>

</x-app-layout>