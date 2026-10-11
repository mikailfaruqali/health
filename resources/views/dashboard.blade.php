<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light" />
    <title>Health</title>
    <link
        rel="icon"
        type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='20 20 472 472'%3E%3Crect x='20' y='20' width='472' height='472' rx='42' fill='%23249658'/%3E%3Cg fill='%23fff'%3E%3Crect x='154' y='154' width='92' height='92' rx='10'/%3E%3Crect x='266' y='154' width='92' height='92' rx='10'/%3E%3Crect x='154' y='266' width='92' height='92' rx='10'/%3E%3Crect x='266' y='266' width='92' height='92' rx='10'/%3E%3C/g%3E%3C/svg%3E"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=Geist+Mono:wght@400;500&display=swap"
        rel="stylesheet"
    />
    <style>
        :root {
            --bg: #fafafa;
            --surface: #fff;
            --subtle: #f4f4f5;
            --border: #e4e4e7;
            --border-strong: #d4d4d8;
            --text: #18181b;
            --text-soft: #3f3f46;
            --muted: #71717a;
            --faint: #a1a1aa;
            --ink: #18181b;
            --ink-hover: #3f3f46;

            --success: #16a34a;
            --success-bg: #f0fdf4;
            --success-line: #bbf7d0;
            --warning: #d97706;
            --warning-bg: #fffbeb;
            --warning-line: #fde68a;
            --error: #dc2626;
            --error-bg: #fef2f2;
            --error-line: #fecaca;

            --radius: 10px;
            --radius-sm: 6px;
            --shadow: 0 1px 2px rgba(24, 24, 27, .04), 0 1px 3px rgba(24, 24, 27, .06);
            --sans: 'Geist', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
            --mono: 'Geist Mono', ui-monospace, 'SFMono-Regular', Consolas, monospace;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: var(--sans);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        h1,
        h2,
        p {
            margin: 0;
        }

        .i {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .container {
            width: 100%;
            max-width: 920px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Top bar */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255, 255, 255, .85);
            border-bottom: 1px solid var(--border);
            backdrop-filter: saturate(180%) blur(8px);
        }

        .topbar__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            height: 60px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: -.01em;
        }

        .brand__mark {
            display: block;
            width: 28px;
            height: 28px;
        }

        .topbar__actions {
            display: flex;
            gap: 8px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 34px;
            padding: 0 14px;
            border: 1px solid transparent;
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            cursor: pointer;
            transition: background-color .15s, border-color .15s, color .15s;
        }

        .btn .i {
            width: 14px;
            height: 14px;
        }

        .btn-dark {
            background: var(--ink);
            color: #fff;
        }

        .btn-dark:hover {
            background: var(--ink-hover);
        }

        .btn-outline {
            background: var(--surface);
            border-color: var(--border);
            color: var(--text-soft);
        }

        .btn-outline:hover {
            border-color: var(--border-strong);
            color: var(--text);
        }

        .btn-ghost {
            width: 30px;
            height: 30px;
            padding: 0;
            background: transparent;
            color: var(--muted);
        }

        .btn-ghost:hover {
            background: var(--subtle);
            color: var(--text);
        }

        /* Page */
        main {
            flex: 1;
            padding: 32px 0 48px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        /* Summary */
        .summary {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 24px;
            margin-bottom: 28px;
        }

        .summary__main {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }

        .summary__title {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: -.015em;
        }

        .summary__text {
            margin-top: 2px;
            color: var(--muted);
        }

        .stats {
            display: flex;
            gap: 28px;
        }

        .stat__value {
            font-family: var(--mono);
            font-size: 22px;
            font-weight: 500;
            line-height: 1.1;
            font-variant-numeric: tabular-nums;
        }

        .stat__value.is-zero {
            color: var(--faint);
        }

        .stat__label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--faint);
        }

        /* Status chips */
        .chip {
            display: grid;
            flex-shrink: 0;
            place-items: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--subtle);
            color: var(--muted);
        }

        .chip .i {
            width: 14px;
            height: 14px;
            stroke-width: 2.5;
        }

        .chip-lg {
            width: 44px;
            height: 44px;
        }

        .chip-lg .i {
            width: 20px;
            height: 20px;
            stroke-width: 2;
        }

        .tone-success { --tone: var(--success); --tone-bg: var(--success-bg); --tone-line: var(--success-line); }
        .tone-warning { --tone: var(--warning); --tone-bg: var(--warning-bg); --tone-line: var(--warning-line); }
        .tone-error { --tone: var(--error); --tone-bg: var(--error-bg); --tone-line: var(--error-line); }

        .tone-success.chip,
        .tone-warning.chip,
        .tone-error.chip {
            background: var(--tone-bg);
            color: var(--tone);
            box-shadow: inset 0 0 0 1px var(--tone-line);
        }

        .tone-success.dot,
        .tone-warning.dot,
        .tone-error.dot {
            background: var(--tone);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            height: 22px;
            padding: 0 8px;
            border: 1px solid var(--tone-line, var(--border));
            border-radius: 999px;
            background: var(--tone-bg, var(--subtle));
            color: var(--tone, var(--muted));
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* List */
        .list-head {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 2px 10px;
        }

        .list-head__title {
            font-size: 14px;
            font-weight: 600;
        }

        .list-head__count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 20px;
            padding: 0 7px;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: var(--surface);
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            font-variant-numeric: tabular-nums;
        }

        .list {
            overflow: hidden;
        }

        .list>*+* {
            border-top: 1px solid var(--border);
        }

        .row {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 56px;
            padding: 10px 14px 10px 16px;
        }

        .row__name {
            flex: 1;
            min-width: 0;
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .row__meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .time {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--faint);
            font-family: var(--mono);
            font-size: 12px;
        }

        .time .i {
            width: 13px;
            height: 13px;
        }

        a.row {
            transition: background-color .15s;
        }

        a.row:hover {
            background: var(--subtle);
        }

        .run-hint {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--faint);
            font-size: 13px;
            font-weight: 500;
            transition: color .15s;
        }

        a.row:hover .run-hint {
            color: var(--text);
        }

        /* Expandable result */
        details>summary {
            list-style: none;
            cursor: pointer;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        details:not([open])>summary:hover {
            background: var(--subtle);
        }

        details[open]>summary:hover .caret {
            color: var(--text);
        }

        .caret {
            color: var(--faint);
            transition: transform .2s;
        }

        details[open] .caret {
            transform: rotate(180deg);
        }

        .detail {
            padding: 0 16px 16px 54px;
        }

        .detail--table {
            padding: 0;
        }

        .alert {
            padding: 10px 12px;
            border: 1px solid var(--error-line);
            border-radius: var(--radius-sm);
            background: var(--error-bg);
            color: #991b1b;
            font-family: var(--mono);
            font-size: 12.5px;
            overflow-wrap: anywhere;
        }

        .note {
            color: var(--muted);
        }

        /* Table */
        .table-wrap {
            overflow-x: auto;
            border-top: 1px solid var(--border);
        }

        th:first-child,
        td:first-child {
            padding-left: 16px;
        }

        th:last-child,
        td:last-child {
            padding-right: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            font-variant-numeric: tabular-nums;
        }

        th,
        td {
            padding: 8px 12px;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--subtle);
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:hover td {
            background: var(--bg);
        }

        td {
            color: var(--text-soft);
        }

        .col-index {
            width: 1%;
            color: var(--faint);
            font-family: var(--mono);
        }

        td.is-diff {
            color: var(--error);
            font-weight: 600;
        }

        .is-null {
            color: var(--faint);
        }

        .empty {
            padding: 40px 20px;
            color: var(--muted);
            text-align: center;
        }

        code {
            padding: 1px 5px;
            border-radius: 4px;
            background: var(--subtle);
            font-family: var(--mono);
            font-size: 12.5px;
        }

        /* Footer */
        footer {
            padding: 20px 0;
            color: var(--faint);
            font-size: 12px;
            text-align: center;
        }

        footer a {
            color: var(--muted);
        }

        footer a:hover {
            color: var(--text);
        }

        @media (max-width: 640px) {
            .container {
                padding: 0 14px;
            }

            main {
                padding-top: 20px;
            }

            .summary {
                padding: 18px;
            }

            .stats {
                width: 100%;
                justify-content: space-between;
                padding-top: 16px;
                border-top: 1px solid var(--border);
            }

            .btn-label,
            .time,
            .run-hint span {
                display: none;
            }

            .btn:has(.btn-label) {
                width: 34px;
                padding: 0;
            }

            .row {
                flex-wrap: wrap;
            }

            .detail:not(.detail--table) {
                padding-left: 16px;
            }
        }
    </style>
</head>

<body>
    <svg width="0" height="0" style="position: absolute" aria-hidden="true">
        <symbol id="i-app" viewBox="20 20 472 472">
            <rect x="20" y="20" width="472" height="472" rx="42" fill="#249658" />
            <g fill="#fff">
                <rect x="154" y="154" width="92" height="92" rx="10" />
                <rect x="266" y="154" width="92" height="92" rx="10" />
                <rect x="154" y="266" width="92" height="92" rx="10" />
                <rect x="266" y="266" width="92" height="92" rx="10" />
            </g>
        </symbol>
        <symbol id="i-pulse" viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2" /></symbol>
        <symbol id="i-check" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5" /></symbol>
        <symbol id="i-alert" viewBox="0 0 24 24">
            <path d="M12 9v4" />
            <path d="M12 17h.01" />
            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
        </symbol>
        <symbol id="i-x" viewBox="0 0 24 24">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </symbol>
        <symbol id="i-play" viewBox="0 0 24 24"><path d="M6 3v18l14-9z" /></symbol>
        <symbol id="i-back" viewBox="0 0 24 24">
            <path d="m12 19-7-7 7-7" />
            <path d="M19 12H5" />
        </symbol>
        <symbol id="i-rerun" viewBox="0 0 24 24">
            <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8" />
            <path d="M21 3v5h-5" />
        </symbol>
        <symbol id="i-right" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6" /></symbol>
        <symbol id="i-down" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6" /></symbol>
        <symbol id="i-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3 2" />
        </symbol>
    </svg>

    <header class="topbar">
        <div class="topbar__inner container">
            <a href="{{ $dashboard->backUrl() }}" class="brand">
                <svg class="brand__mark" aria-hidden="true"><use href="#i-app" /></svg>
                Health
            </a>

            <div class="topbar__actions">
                @if ($dashboard->hasResults())
                    <a href="{{ $dashboard->backUrl() }}" class="btn btn-outline" title="Back to checks">
                        <svg class="i"><use href="#i-back" /></svg>
                        <span class="btn-label">All checks</span>
                    </a>
                @endif
                @if ($dashboard->hasChecks())
                    <a href="{{ $dashboard->runAllUrl() }}" class="btn btn-dark" title="Run all checks">
                        <svg class="i"><use href="#i-play" /></svg>
                        <span class="btn-label">Run all checks</span>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="card summary">
                <div class="summary__main">
                    <span class="chip chip-lg tone-{{ $dashboard->summary()['tone'] }}">
                        <svg class="i"><use href="#i-{{ $dashboard->summary()['icon'] }}" /></svg>
                    </span>
                    <div>
                        <h1 class="summary__title">{{ $dashboard->summary()['title'] }}</h1>
                        <p class="summary__text">{{ $dashboard->summary()['text'] }}</p>
                    </div>
                </div>

                @if ($dashboard->hasResults())
                    <div class="stats">
                        @foreach ($dashboard->stats() as $stat)
                            <div>
                                <div @class(['stat__value', 'is-zero' => $stat['value'] === 0])>
                                    {{ $stat['value'] }}
                                </div>
                                <div class="stat__label">
                                    <span class="dot tone-{{ $stat['tone'] }}"></span>{{ $stat['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            @if ($dashboard->hasChecks())
                <div class="list-head">
                    <h2 class="list-head__title">{{ $dashboard->listTitle() }}</h2>
                    <span class="list-head__count">{{ $dashboard->listCount() }}</span>
                </div>

                <div class="card list">
                    @if ($dashboard->hasResults())
                        @foreach ($dashboard->results() as $result)
                            @if ($result['expandable'])
                                <details open>
                                    <summary class="row">
                                        @include('health::partials.result-row', ['result' => $result])
                                        <svg class="i caret"><use href="#i-down" /></svg>
                                    </summary>

                                    <div class="detail detail--{{ $result['view'] }}">
                                        @if ($result['view'] === 'error')
                                            <div class="alert">{{ $result['message'] }}</div>
                                        @elseif ($result['view'] === 'table')
                                            <div class="table-wrap">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="col-index">#</th>
                                                            @foreach ($result['headers'] as $header)
                                                                <th>{{ $header }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($result['rows'] as $row)
                                                            <tr>
                                                                <td class="col-index">{{ $row['number'] }}</td>
                                                                @foreach ($row['cells'] as $cell)
                                                                    <td @class(['is-diff' => $cell['isDiff']])>
                                                                        @if ($cell['isNull'])
                                                                            <span class="is-null">—</span>
                                                                        @else
                                                                            {{ $cell['value'] }}
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="note">No data to display.</p>
                                        @endif
                                    </div>
                                </details>
                            @else
                                <div class="row">
                                    @include('health::partials.result-row', ['result' => $result])
                                </div>
                            @endif
                        @endforeach
                    @else
                        @foreach ($dashboard->checks() as $check)
                            <a href="{{ $check['url'] }}" class="row">
                                <span class="chip"
                                    ><svg class="i"><use href="#i-pulse" /></svg
                                ></span>
                                <span class="row__name">{{ $check['name'] }}</span>
                                <span class="run-hint"
                                    ><span>Run</span><svg class="i"><use href="#i-right" /></svg
                                ></span>
                            </a>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </main>

    <footer>
        &copy; {{ $dashboard->year() }} &middot;
        <a href="https://snawbar.com" target="_blank" rel="noopener">Snawbar</a>
    </footer>
</body>
</html>
