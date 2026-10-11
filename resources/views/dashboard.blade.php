<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#101924" />
    <title>Health</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        :root {
            --sn-radius: 6px;
            --sn-primary-rgb: 9, 105, 218;
            --sn-primary: #0969da;
            --sn-primary-hover: #0860ca;
            --sn-success-rgb: 26, 127, 55;
            --sn-warning-rgb: 154, 103, 0;
            --sn-danger-rgb: 209, 36, 47;
            --sn-orange-rgb: 213, 107, 58;
            --sn-purple-rgb: 153, 97, 214;
            --sn-slate-rgb: 100, 116, 139;

            --sn-bg: #f5f6fa;
            --sn-surface: #fff;
            --sn-surface-soft: #f5f6fa;
            --sn-border: #dbdfea;
            --sn-line: #e5e9f2;
            --sn-heading: #364a63;
            --sn-text: #526484;
            --sn-muted: #8094ae;
            --sn-shadow: 0 10px 26px -18px rgba(15, 23, 42, .45);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --sn-primary-rgb: 88, 166, 255;
                --sn-primary: #58a6ff;
                --sn-primary-hover: #79b8ff;
                --sn-success-rgb: 63, 185, 80;
                --sn-warning-rgb: 210, 153, 34;
                --sn-danger-rgb: 248, 81, 73;

                --sn-bg: #101924;
                --sn-surface: #141c26;
                --sn-surface-soft: #1b2532;
                --sn-border: #3d444d;
                --sn-line: #2a323c;
                --sn-heading: #fff;
                --sn-text: #b6c6e3;
                --sn-muted: #8094ae;
                --sn-shadow: 0 10px 26px -14px rgba(0, 0, 0, .8);
            }
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--sn-bg);
            color: var(--sn-text);
            font-family: 'Vazirmatn', system-ui, -apple-system, 'Segoe UI', sans-serif;
            font-size: 14px;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            color: var(--sn-heading);
        }

        /* Header — mirrors the suite's flat "dnav" bar */
        .hd-nav {
            position: sticky;
            top: 0;
            z-index: 20;
            background: var(--sn-surface);
            border-bottom: 1px solid var(--sn-line);
        }

        .hd-nav__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            height: 56px;
            padding: 0 16px;
        }

        .hd-nav__start,
        .hd-nav__end {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .hd-nav__heading {
            font-size: 17px;
            font-weight: 600;
            color: var(--sn-heading);
            white-space: nowrap;
        }

        .hd-nav__sub {
            color: var(--sn-muted);
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 36px;
            padding: 0 14px;
            border: 1px solid transparent;
            border-radius: var(--sn-radius);
            font: inherit;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .btn-primary {
            background: var(--sn-primary);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--sn-primary-hover);
        }

        .btn-light {
            background: var(--sn-surface-soft);
            border-color: var(--sn-line);
            color: var(--sn-text);
        }

        .btn-light:hover {
            color: var(--sn-heading);
            border-color: var(--sn-border);
        }

        .btn-icon {
            width: 36px;
            padding: 0;
        }

        .btn-soft {
            background: rgba(var(--sn-primary-rgb), .1);
            color: var(--sn-primary);
        }

        .btn-soft:hover {
            background: rgba(var(--sn-primary-rgb), .18);
        }

        /* Layout */
        .hd-content {
            flex: 1;
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px 16px 32px;
        }

        .hd-list-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .hd-list-head__title {
            font-size: 20px;
            font-weight: 500;
        }

        /* Summary chips */
        .hd-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .hd-stat {
            --tone: var(--sn-slate-rgb);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 32px;
            padding: 0 12px;
            border: 1px solid var(--sn-line);
            border-radius: var(--sn-radius);
            background: var(--sn-surface);
            color: var(--sn-muted);
            font-size: 13px;
        }

        .hd-stat strong {
            color: rgb(var(--tone));
            font-size: 15px;
            font-weight: 600;
        }

        .hd-stat.is-success {
            --tone: var(--sn-success-rgb);
        }

        .hd-stat.is-warning {
            --tone: var(--sn-warning-rgb);
        }

        .hd-stat.is-error {
            --tone: var(--sn-danger-rgb);
        }

        .hd-stat.is-total strong {
            color: var(--sn-heading);
        }

        /* Cards */
        .card {
            border: 1px solid var(--sn-border);
            border-radius: var(--sn-radius);
            background: var(--sn-surface);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .hd-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .hd-check {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
        }

        .hd-check:hover {
            border-color: color-mix(in srgb, var(--sn-primary) 40%, var(--sn-border));
            box-shadow: var(--sn-shadow);
        }

        .hd-check__title {
            flex: 1;
            min-width: 0;
            color: var(--sn-heading);
            font-size: 15px;
            font-weight: 500;
            line-height: 1.4;
        }

        .hd-check__chevron {
            color: var(--sn-muted);
            font-size: 13px;
            transition: color .15s ease, transform .2s ease;
        }

        .hd-check:hover .hd-check__chevron {
            color: var(--sn-primary);
            transform: translateX(3px);
        }

        /* Tinted icon tile — same as suite's accounting index */
        .icon-tile {
            --tone: var(--sn-primary-rgb);
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: var(--sn-radius);
            background: rgba(var(--tone), .12);
            color: rgb(var(--tone));
            font-size: 18px;
        }

        .icon-tile.sm {
            width: 36px;
            height: 36px;
            font-size: 15px;
        }

        .tone-primary { --tone: var(--sn-primary-rgb); }
        .tone-success { --tone: var(--sn-success-rgb); }
        .tone-warning { --tone: var(--sn-warning-rgb); }
        .tone-error { --tone: var(--sn-danger-rgb); }
        .tone-orange { --tone: var(--sn-orange-rgb); }
        .tone-purple { --tone: var(--sn-purple-rgb); }
        .tone-slate { --tone: var(--sn-slate-rgb); }

        /* Results */
        .hd-results {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hd-result__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid var(--sn-line);
        }

        .hd-result__title {
            flex: 1;
            min-width: 0;
        }

        .hd-result__name {
            color: var(--sn-heading);
            font-size: 15px;
            font-weight: 500;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .hd-result__meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px 10px;
            margin-top: 2px;
            color: var(--sn-muted);
            font-size: 12px;
        }

        .hd-result__body {
            padding: 14px 16px;
        }

        .badge {
            --tone: var(--sn-slate-rgb);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 1px 8px;
            border-radius: var(--sn-radius);
            background: rgba(var(--tone), .12);
            color: rgb(var(--tone));
            font-size: 12px;
            font-weight: 500;
        }

        .alert {
            --tone: var(--sn-danger-rgb);
            display: flex;
            gap: 10px;
            padding: 10px 14px;
            border: 1px solid rgba(var(--tone), .3);
            border-radius: var(--sn-radius);
            background: rgba(var(--tone), .08);
            color: rgb(var(--tone));
            overflow-wrap: anywhere;
        }

        .alert i {
            margin-top: 4px;
        }

        .hd-empty {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgb(var(--sn-success-rgb));
            font-weight: 500;
        }

        /* Table — suite datatable style */
        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--sn-border);
            border-radius: var(--sn-radius);
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            padding: 8px 10px;
            text-align: start;
            vertical-align: middle;
            border-bottom: 1px solid var(--sn-line);
            white-space: nowrap;
        }

        th {
            background: var(--sn-surface-soft);
            color: var(--sn-heading);
            font-weight: 500;
            text-transform: capitalize;
            border-bottom-color: var(--sn-border);
        }

        th.col-index,
        td.col-index {
            width: 1%;
            color: var(--sn-muted);
            text-align: center;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:hover td {
            background: rgba(var(--sn-primary-rgb), .04);
        }

        td.is-diff {
            color: rgb(var(--sn-danger-rgb));
            font-weight: 600;
        }

        td .is-null {
            color: var(--sn-muted);
        }

        /* Footer */
        .hd-footer {
            padding: 14px 16px;
            border-top: 1px solid var(--sn-line);
            background: var(--sn-surface);
            color: var(--sn-muted);
            font-size: 13px;
            text-align: center;
        }

        .hd-footer a {
            color: var(--sn-primary);
        }

        .hd-footer a:hover {
            text-decoration: underline;
        }

        .fade-in {
            animation: fadeIn .3s ease-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .fade-in {
                animation: none;
            }
        }

        @media (max-width: 576px) {
            .hd-nav__sub,
            .btn .btn-label {
                display: none;
            }

            .btn:has(.btn-label) {
                width: 36px;
                padding: 0;
            }

            .hd-grid {
                grid-template-columns: 1fr;
            }

            .hd-result__head {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <header class="hd-nav">
        <div class="hd-nav__inner">
            <div class="hd-nav__start">
                <span class="icon-tile sm tone-primary"><i class="fa-solid fa-heart-pulse"></i></span>
                <span class="hd-nav__heading">Health</span>
                <span class="hd-nav__sub">System diagnostics</span>
            </div>
            <div class="hd-nav__end">
                @if ($dashboard->hasResults())
                    <a href="{{ $dashboard->backUrl() }}" class="btn btn-light" title="Back to checks">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="btn-label">Back</span>
                    </a>
                @endif
                <a href="{{ $dashboard->runAllUrl() }}" class="btn btn-primary" title="Run all checks">
                    <i class="fa-solid fa-play"></i>
                    <span class="btn-label">Run all</span>
                </a>
            </div>
        </div>
    </header>

    <main class="hd-content">
        <div class="hd-list-head">
            <h1 class="hd-list-head__title">{{ $dashboard->title() }}</h1>

            <div class="hd-stats">
                @foreach ($dashboard->stats() as $stat)
                    <span class="hd-stat is-{{ $stat['tone'] }}"><strong>{{ $stat['value'] }}</strong> {{ $stat['label'] }}</span>
                @endforeach
            </div>
        </div>

        @if ($dashboard->hasResults())
            <div class="hd-results">
                @foreach ($dashboard->results() as $result)
                    <section class="card fade-in" style="animation-delay: {{ $result['delay'] }}">
                        <div class="hd-result__head">
                            <span class="icon-tile sm tone-{{ $result['status'] }}"
                                ><i class="fa-solid fa-{{ $result['icon'] }}"></i
                            ></span>

                            <div class="hd-result__title">
                                <h2 class="hd-result__name">{{ $result['name'] }}</h2>
                                <div class="hd-result__meta">
                                    <span class="badge tone-{{ $result['status'] }}">{{ $result['label'] }}</span>
                                    <span><i class="fa-regular fa-clock"></i> {{ $result['time'] }}</span>
                                </div>
                            </div>

                            <a href="{{ $result['rerunUrl'] }}" class="btn btn-soft btn-icon" title="Re-run">
                                <i class="fa-solid fa-rotate-right"></i>
                            </a>
                        </div>

                        <div class="hd-result__body">
                            @if ($result['view'] === 'error')
                                <div class="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <span>{{ $result['message'] }}</span>
                                </div>
                            @elseif ($result['view'] === 'passed')
                                <div class="hd-empty">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>All checks passed successfully</span>
                                </div>
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
                                <span class="hd-result__meta">No data to display</span>
                            @endif
                        </div>
                    </section>
                @endforeach
            </div>
        @elseif ($dashboard->hasChecks())
            <div class="hd-grid">
                @foreach ($dashboard->checks() as $check)
                    <a
                        href="{{ $check['url'] }}"
                        class="card hd-check fade-in"
                        style="animation-delay: {{ $check['delay'] }}"
                    >
                        <span class="icon-tile tone-{{ $check['tone'] }}">
                            <i class="fa-solid fa-{{ $check['icon'] }}"></i>
                        </span>
                        <span class="hd-check__title">{{ $check['name'] }}</span>
                        <i class="fa-solid fa-chevron-right hd-check__chevron"></i>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card hd-result__body">
                <span class="hd-result__meta">No checks registered. Add check classes to <code>config/snawbar-health.php</code>.</span>
            </div>
        @endif
    </main>

    <footer class="hd-footer">
        &copy; {{ $dashboard->year() }} Health &middot;
        <a href="https://snawbar.com" target="_blank" rel="noopener">Snawbar</a>
    </footer>
</body>
</html>
