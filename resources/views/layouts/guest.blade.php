<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BudgetZen') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --navy:    #0B2545;
        --blue:    #1463A8;
        --teal:    #1B9E78;
        --cream:   #F4F7FD;
        --muted:   #6B87B0;
        --border:  rgba(20,99,168,0.14);
        --surface: #ffffff;

        --font-display: 'DM Serif Display', Georgia, serif;
        --font-mono:    'DM Mono', monospace;
        --font-body:    'DM Sans', sans-serif;
    }

    html, body {
        background: var(--cream);
        color: var(--navy);
        font-family: var(--font-body);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ─── mesh background ─── */
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
        0%   { opacity: 0.8; }
        100% { opacity: 1;   }
    }

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

    /* ─── griglia sottile ─── */
    body::after {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(20,99,168,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(20,99,168,0.04) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none;
        z-index: 0;
    }

    /* ─── shell ─── */
    .guest-shell {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px 16px;
    }

    /* ─── wordmark ─── */
    .guest-wordmark {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 400;
        color: var(--navy);
        letter-spacing: -0.02em;
        margin-bottom: 6px;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    .guest-wordmark em {
        font-style: italic;
        color: var(--blue);
    }

    .guest-tagline {
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--muted);
        letter-spacing: 0.14em;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .guest-tagline::before,
    .guest-tagline::after {
        content: '';
        display: block;
        width: 24px;
        height: 1px;
        background: var(--muted);
        opacity: 0.5;
    }

    /* ─── card ─── */
    .guest-card {
        width: 100%;
        max-width: 440px;
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px 36px;
        box-shadow:
            0 24px 64px rgba(11,37,69,0.10),
            0 4px 16px rgba(11,37,69,0.06),
            inset 0 1px 0 rgba(255,255,255,0.9);
        animation: cardIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: none; }
    }

    /* ─── footer link ─── */
    .guest-footer {
        margin-top: 20px;
        font-size: 12px;
        color: var(--muted);
        text-align: center;
    }
    .guest-footer a {
        color: var(--blue);
        text-decoration: none;
    }
    .guest-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="bz-mesh"></div>
    <div class="bz-noise"></div>

    <div class="guest-shell">

        <a href="{{ url('/') }}" class="guest-wordmark">
            Budget<em>Zen</em>
        </a>

        <div class="guest-tagline">il tuo spazio finanziario</div>

        <div class="guest-card">
            {{ $slot }}
        </div>

    </div>
</body>
</html>