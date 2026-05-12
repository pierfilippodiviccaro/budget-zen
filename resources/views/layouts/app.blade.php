<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BudgetZen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg:           #f0f4ff;
        --surface:      #ffffff;
        --border:       #dde6f5;
        --navy:         #0C2D6B;
        --navy-dark:    #0F1E4A;
        --blue:         #185FA5;
        --blue-mid:     #378ADD;
        --blue-lt:      #85B7EB;
        --blue-pale:    #E6F1FB;
        --green:        #1D9E75;
        --green-dark:   #085041;
        --green-pale:   #E1F5EE;
        --text:         #0C2D6B;
        --muted:        #5a7aaa;
        --danger:       #E24B4A;
        --danger-pale:  #FCEBEB;
    }

    html, body {
        background: var(--bg);
        color: var(--text);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* sfondo con griglia sottile */
    body::after {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(24,95,165,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(24,95,165,0.04) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none;
        z-index: 0;
    }

    /* orbs decorativi */
    .orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(130px);
        pointer-events: none;
        z-index: 0;
    }
    .orb-1 {
        width: 500px; height: 500px;
        background: rgba(24,95,165,0.07);
        top: -150px; left: -150px;
    }
    .orb-2 {
        width: 420px; height: 420px;
        background: rgba(29,158,117,0.06);
        bottom: -120px; right: -100px;
    }

    /* layout */
    .wrapper {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* TOPBAR */
    .bz-topbar {
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 40;
        height: 54px;
        background: rgba(12,45,107,0.97);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
    }

    .bz-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    .bz-logo-mark {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: var(--green);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .bz-logo-mark svg { display: block; }
    .bz-logo-name {
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        letter-spacing: -0.01em;
    }
    .bz-logo-sub {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        color: var(--blue-lt);
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .bz-topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .bz-topbar-icon {
        width: 36px; height: 36px;
        border-radius: 8px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        color: var(--blue-lt);
        transition: background 0.15s;
    }
    .bz-topbar-icon:hover { background: rgba(255,255,255,0.14); }

    .bz-user-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 4px 12px 4px 4px;
        cursor: pointer;
        transition: background 0.15s;
    }
    .bz-user-chip:hover { background: rgba(255,255,255,0.14); }
    .bz-user-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: var(--green);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #fff;
        font-family: 'Inter', sans-serif;
    }
    .bz-user-name {
        font-size: 12px;
        color: #E6F1FB;
    }

    /* SHELL */
    .bz-shell {
        display: flex;
        padding-top: 54px;
        min-height: 100vh;
    }

    /* SIDEBAR */
    .bz-sidebar {
        position: fixed;
        top: 54px; bottom: 0; left: 0;
        width: 220px;
        background: var(--navy-dark);
        border-right: 1px solid rgba(255,255,255,0.06);
        z-index: 30;
        display: flex;
        flex-direction: column;
        padding: 16px 10px;
        overflow-y: auto;
    }

    .bz-nav { display: flex; flex-direction: column; gap: 2px; }

    .bz-nav-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        font-weight: 400;
        color: var(--blue-mid);
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 12px 8px 5px;
    }

    .bz-nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 11px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 400;
        color: var(--blue-lt);
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
        border: 1px solid transparent;
    }
    .bz-nav-item:hover {
        background: rgba(255,255,255,0.06);
        color: #fff;
    }
    .bz-nav-item.active {
        background: var(--blue);
        color: #fff;
        border-color: rgba(255,255,255,0.1);
    }
    .bz-nav-item svg { flex-shrink: 0; opacity: 0.85; }
    .bz-nav-item.active svg { opacity: 1; }

    .bz-pill {
        margin-left: auto;
        background: var(--green);
        color: #fff;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
        padding: 2px 7px;
        border-radius: 10px;
    }
    .bz-pill.warn { background: #BA7517; }

    .bz-logout-wrap {
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid rgba(255,255,255,0.07);
    }
    .bz-logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 11px;
        width: 100%;
        border: none;
        background: none;
        border-radius: 8px;
        font-size: 13px;
        color: var(--blue-lt);
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        transition: background 0.15s, color 0.15s;
    }
    .bz-logout-btn:hover { background: rgba(255,255,255,0.06); color: #fff; }

    /* MAIN */
    .bz-main {
        margin-left: 220px;
        flex: 1;
        padding: 32px 32px;
        min-height: calc(100vh - 54px);
    }

    /* ALERTS */
    .bz-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 22px;
    }
    .bz-alert-success {
        background: var(--green-pale);
        color: var(--green-dark);
        border: 1px solid #5DCAA5;
    }
    .bz-alert-error {
        background: var(--danger-pale);
        color: #791F1F;
        border: 1px solid #F09595;
    }

    /* CARD riutilizzabile nelle view */
    .bz-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 22px;
    }
    .bz-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }
    .bz-card-title {
        font-size: 14px;
        font-weight: 500;
        color: var(--navy);
    }
    .bz-card-action {
        font-family: 'JetBrains Mono', monospace;
        font-size: 11px;
        color: var(--blue);
        text-decoration: none;
        letter-spacing: 0.04em;
    }
    .bz-card-action:hover { text-decoration: underline; }

    /* STAT card colorata */
    .bz-stat {
        border-radius: 12px;
        padding: 18px 20px;
        color: #fff;
    }
    .bz-stat.navy  { background: var(--navy); }
    .bz-stat.blue  { background: var(--blue); }
    .bz-stat.green { background: var(--green-dark); }
    .bz-stat-icon {
        width: 36px; height: 36px;
        border-radius: 8px;
        background: rgba(255,255,255,0.12);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
    }
    .bz-stat-label { font-size: 11px; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
    .bz-stat-value { font-size: 22px; font-weight: 600; }
    .bz-stat-delta { font-size: 11px; margin-top: 5px; color: rgba(255,255,255,0.4); }
    .bz-stat-delta.up { color: #5DCAA5; }
    .bz-stat-delta.dn { color: #F09595; }

    /* PROGRESS */
    .bz-track {
        height: 6px;
        background: var(--blue-pale);
        border-radius: 3px;
        overflow: hidden;
    }
    .bz-fill { height: 100%; border-radius: 3px; background: var(--blue); transition: width 0.4s; }
    .bz-fill.green { background: var(--green); }
    .bz-fill.amber { background: #BA7517; }
    .bz-fill.red   { background: var(--danger); }

    @media (max-width: 768px) {
        .bz-sidebar { display: none; }
        .bz-main { margin-left: 0; padding: 20px 16px; }
    }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="wrapper">

        <!-- TOPBAR -->
        <header class="bz-topbar">
            <a href="{{ url('/') }}" class="bz-logo">
                <div class="bz-logo-mark">
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </div>
                <div>
                    <div class="bz-logo-name">BudgetZen</div>
                    <div class="bz-logo-sub">finance tracker</div>
                </div>
            </a>

            <div class="bz-topbar-right">
                <button class="bz-topbar-icon" aria-label="Notifiche">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                </button>
                <div class="bz-user-chip">
                    <div class="bz-user-avatar">
    {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : '?' }}
</div>
<span class="bz-user-name">{{ Auth::user()?->name ?? 'Ospite' }}</span>
                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </div>
            </div>
        </header>

        <div class="bz-shell">

            <!-- SIDEBAR -->
            <aside class="bz-sidebar">
                <nav class="bz-nav">

                    <p class="bz-nav-label">panoramica</p>

                    <a href="{{ route('dashboard') }}"
                       class="bz-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Dashboard
                    </a>

                    {{-- <a href="{{ route('transactions.index') }}"
                       class="bz-nav-item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                        </svg>
                        Transazioni
                    </a>

                    <a href="{{ route('budgets.index') }}"
                       class="bz-nav-item {{ request()->routeIs('budgets.*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18-3a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3m18-3V6"/>
                        </svg>
                        Budget
</a> --}}

                    {{--<a href="{{ route('categories.index') }}"
                       class="bz-nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z"/>
                        </svg>
                        Categorie
                    </a>--}}

                    <p class="bz-nav-label">sistema</p>

                   

                </nav>

                <div class="bz-logout-wrap">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bz-logout-btn">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                            </svg>
                            Esci
                        </button>
                    </form>
                </div>
            </aside>

            <!-- MAIN -->
            <main class="bz-main">

                @if(session('success'))
                    <div class="bz-alert bz-alert-success">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bz-alert bz-alert-error">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}

            </main>
        </div>
    </div>
</body>
</html>