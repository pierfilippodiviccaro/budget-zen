<x-app-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">

    <style>
        .bz {
            --bz-bg: #FBF9F5;
            --bz-card: #ffffff;
            --bz-line: #ebe8e3;
            --bz-text: #292524;
            --bz-muted: #78716c;
            --bz-faint: #a8a29e;
            --bz-green: #059669;
            --bz-green-light: #10b981;
            --bz-dark: #1c1917;

            position: relative;
            min-height: 100vh;
            padding: 2.5rem 1rem 8rem;
            background: var(--bz-bg);
            color: var(--bz-text);
            font-family: 'DM Sans', sans-serif;
            box-sizing: border-box;
        }
        .bz *, .bz *::before, .bz *::after { box-sizing: border-box; }

        /* Bagliori di sfondo */
        .bz-glow { position: fixed; border-radius: 9999px; filter: blur(64px); opacity: .35; pointer-events: none; }
        .bz-glow--a { top: -8rem; right: -8rem; width: 24rem; height: 24rem; background: #d1fae5; }
        .bz-glow--b { top: 50%; left: -10rem; width: 28rem; height: 28rem; background: #fffbeb; }

        .bz-wrap { position: relative; z-index: 1; max-width: 42rem; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem; }

        /* Intestazione */
        .bz-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 1rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--bz-line); }
        .bz-badge { display: inline-block; margin-bottom: .75rem; padding: .25rem .65rem; border-radius: .4rem; border: 1px solid #d1fae5; background: #ecfdf5; color: #065f46; font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: .06em; text-transform: uppercase; }
        .bz-title { margin: 0; font-family: 'DM Serif Display', serif; font-size: 2.25rem; font-weight: 400; letter-spacing: -.02em; color: #1c1917; line-height: 1.1; }
        .bz-sub { margin: .5rem 0 0; max-width: 28rem; font-size: .875rem; line-height: 1.6; color: var(--bz-muted); }

        /* Selettore mese/anno */
        .bz-picker { display: inline-flex; align-items: center; padding: .35rem; border: 1px solid var(--bz-line); border-radius: 1rem; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
        .bz-select {
            -webkit-appearance: none; -moz-appearance: none; appearance: none;
            border: 0; outline: 0; cursor: pointer;
            padding: .4rem 1.75rem .4rem .75rem;
            background-color: transparent;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23a8a29e' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right .4rem center; background-size: .9rem;
            font-family: 'DM Sans', sans-serif; font-size: .8rem; font-weight: 600; color: var(--bz-text);
            box-shadow: none;
        }
        .bz-select--mono { font-family: 'DM Mono', monospace; font-weight: 500; }
        .bz-picker-sep { width: 1px; height: 1rem; background: var(--bz-line); }

        /* Lista categorie */
        .bz-card { overflow: hidden; border: 1px solid var(--bz-line); border-radius: 1.5rem; background: var(--bz-card); box-shadow: 0 4px 20px -4px rgba(0,0,0,.05); }
        .bz-card-head { display: flex; justify-content: space-between; padding: .9rem 1.25rem; background: #fafaf9; border-bottom: 1px solid #f0eeeb; font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: .06em; text-transform: uppercase; color: var(--bz-faint); }
        .bz-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid #f5f4f2; transition: background .15s; }
        .bz-row:last-child { border-bottom: 0; }
        .bz-row:hover { background: #fafaf9; }
        .bz-cat { display: flex; align-items: center; gap: .75rem; }
        .bz-dot { width: .5rem; height: .5rem; border-radius: 9999px; background: rgba(16,185,129,.4); transition: background .15s; }
        .bz-row:hover .bz-dot { background: var(--bz-green); }
        .bz-label { cursor: pointer; font-size: .875rem; font-weight: 600; color: var(--bz-text); }
        .bz-row:hover .bz-label { color: #064e3b; }

        .bz-field { position: relative; width: 11rem; flex-shrink: 0; }
        .bz-euro { position: absolute; top: 0; bottom: 0; left: .9rem; display: flex; align-items: center; font-family: 'DM Mono', monospace; font-size: .75rem; color: var(--bz-faint); pointer-events: none; }
        .bz-input {
            -webkit-appearance: none; -moz-appearance: textfield; appearance: none;
            width: 100%; padding: .6rem .9rem .6rem 2rem;
            border: 1px solid #e7e5e4; border-radius: .75rem; outline: 0;
            background: #fafaf9; color: #1c1917; text-align: right;
            font-family: 'DM Mono', monospace; font-size: .875rem; font-weight: 500;
            box-shadow: none; transition: border-color .15s, background .15s, box-shadow .15s;
        }
        .bz-input::-webkit-inner-spin-button, .bz-input::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .bz-input::placeholder { color: #d6d3d1; }
        .bz-input:hover { border-color: #d6d3d1; }
        .bz-input:focus { border-color: var(--bz-green); background: #fff; box-shadow: 0 0 0 4px rgba(5,150,105,.12); }
        .bz-error { margin: 0; padding: 0 1.25rem .75rem; font-size: .75rem; font-weight: 500; color: #dc2626; }

        .bz-hint { display: flex; gap: .5rem; padding: 0 .5rem; font-size: .75rem; color: var(--bz-faint); line-height: 1.5; }

        /* Barra inferiore */
        .bz-bar { position: sticky; bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1rem 1.5rem; border: 1px solid #292524; border-radius: 1.5rem; background: rgba(28,25,23,.96); color: #fff; box-shadow: 0 25px 50px -12px rgba(0,0,0,.35); -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px); }
        .bz-bar-label { margin: 0; font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: .06em; text-transform: uppercase; color: var(--bz-faint); }
        .bz-bar-total { display: flex; align-items: baseline; gap: .25rem; font-family: 'DM Mono', monospace; }
        .bz-bar-total small { font-size: .75rem; color: #34d399; }
        .bz-bar-total strong { font-size: 1.5rem; font-weight: 500; letter-spacing: -.02em; }
        .bz-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; border: 0; border-radius: 1rem; cursor: pointer; background: var(--bz-green-light); color: #0c0a09; font-family: 'DM Sans', sans-serif; font-size: .875rem; font-weight: 600; box-shadow: 0 0 20px rgba(16,185,129,.25); transition: background .15s, transform .1s; }
        .bz-btn:hover { background: #34d399; }
        .bz-btn:active { transform: scale(.98); }
        .bz-btn:focus-visible { outline: 0; box-shadow: 0 0 0 4px rgba(16,185,129,.3); }

        @media (max-width: 480px) {
            .bz-title { font-size: 1.85rem; }
            .bz-field { width: 9rem; }
            .bz-bar { padding: .85rem 1rem; }
            .bz-btn { padding: .7rem 1rem; }
        }
    </style>

    <div class="bz">
        <div class="bz-glow bz-glow--a"></div>
        <div class="bz-glow bz-glow--b"></div>

        <div class="bz-wrap">

            {{-- Intestazione --}}
            <div class="bz-head">
                <div>
                    <span class="bz-badge">Distribuzione Consapevole</span>
                    <h1 class="bz-title">Imposta il tuo budget</h1>
                    <p class="bz-sub">Coltiva serenità finanziaria definendo intenzionalmente i tuoi limiti di spesa mensili.</p>
                </div>

                {{-- Selettore mese/anno --}}
                <form method="GET" action="{{ route('admin.budgets.create') }}" class="bz-picker">
                    <select name="month" class="bz-select" onchange="this.form.submit()">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" @selected($m === $month)>
                                {{ ucfirst(\Illuminate\Support\Carbon::create(null, $m, 1)->locale('it')->translatedFormat('F')) }}
                            </option>
                        @endforeach
                    </select>
                    <span class="bz-picker-sep"></span>
                    <select name="year" class="bz-select bz-select--mono" onchange="this.form.submit()">
                        @foreach (range(now()->year - 1, now()->year + 2) as $y)
                            <option value="{{ $y }}" @selected($y === $year)>{{ $y }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            {{-- Form budget --}}
            <form method="POST" action="{{ route('admin.budgets.store') }}" style="display:flex;flex-direction:column;gap:1.5rem;">
                @csrf
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="year" value="{{ $year }}">

                <div class="bz-card">
                    <div class="bz-card-head">
                        <span>Categoria</span>
                        <span>Limite mensile</span>
                    </div>

                    @foreach ($categories as $category)
                        <div class="bz-row">
                            <div class="bz-cat">
                                <span class="bz-dot"></span>
                                <label class="bz-label" for="amount-{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                            <div class="bz-field">
                                <span class="bz-euro">€</span>
                                <input class="bz-input"
                                       id="amount-{{ $category->id }}"
                                       type="number" step="0.01" min="0"
                                       name="amounts[{{ $category->id }}]"
                                       value="{{ old('amounts.' . $category->id, $budgets[$category->id] ?? '') }}"
                                       placeholder="0,00">
                            </div>
                        </div>
                        @error('amounts.' . $category->id)
                            <p class="bz-error">{{ $message }}</p>
                        @enderror
                    @endforeach
                </div>

                <div class="bz-hint">
                    <span>Lascia vuoto un campo per non imporre restrizioni a quella voce. L'obiettivo è la consapevolezza, non la privazione.</span>
                </div>

                {{-- Barra fissa con totale e salvataggio --}}
                <div class="bz-bar">
                    <div>
                        <p class="bz-bar-label">Totale pianificato</p>
                        <div class="bz-bar-total"><small>€</small><strong id="total">0,00</strong></div>
                    </div>
                    <button type="submit" class="bz-btn">Conferma budget →</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const inputs = document.querySelectorAll('input[name^="amounts"]');
            const totalEl = document.getElementById('total');
            const update = () => {
                const sum = [...inputs].reduce((s, i) => s + (parseFloat(i.value) || 0), 0);
                totalEl.textContent = sum.toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            };
            inputs.forEach(i => i.addEventListener('input', update));
            update();
        })();
    </script>
</x-app-layout>