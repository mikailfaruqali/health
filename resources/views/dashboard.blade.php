<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: #f8fafc;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding-bottom: 60px;
        }

        /* Modern card design */
        .card {
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* Status badges */
        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fed7aa;
            color: #9a3412;
        }

        .badge-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Smooth animations */
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Action button styles */
        .btn-primary {
            background: #6366f1;
            color: white;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #475569;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Check card styles */
        .check-card {
            position: relative;
            overflow: hidden;
        }

        .check-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #e2e8f0;
            transition: background 0.3s;
        }

        .check-card:hover::before {
            background: #6366f1;
        }

        /* Status indicator dot */
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-dot.success {
            background: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .status-dot.warning {
            background: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        }

        .status-dot.error {
            background: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        /* Fixed footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e2e8f0;
            z-index: 30;
        }

        /* Mobile Card View for Tables */
        @media (max-width: 768px) {
            .responsive-table {
                display: none;
            }

            .mobile-cards {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .responsive-table {
                display: table;
            }

            .mobile-cards {
                display: none;
            }
        }

        /* Desktop table with horizontal scroll as fallback */
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-card-item {
            background: #f8fafc;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
        }

        .mobile-card-item:last-child {
            margin-bottom: 0;
        }

        .mobile-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .mobile-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main-content">
        <div class="container mx-auto px-4 py-6 lg:py-8 max-w-7xl">
            <!-- Header -->
            <div class="card rounded-2xl p-4 sm:p-6 lg:p-8 mb-6 fade-in">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-xl bg-indigo-100 flex items-center justify-center mr-3 sm:mr-4">
                                <i class="fas fa-heartbeat text-indigo-600 text-lg sm:text-xl lg:text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">
                                    Health Dashboard
                                </h1>
                                <p class="text-gray-500 text-xs sm:text-sm mt-1">System diagnostics and monitoring</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center gap-4 sm:gap-6">
                        <div class="text-center">
                            <div class="text-xl sm:text-2xl font-bold text-gray-900">{{ count($checks) }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide">Total</div>
                        </div>
                        <div class="h-10 sm:h-12 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-xl sm:text-2xl font-bold text-green-600">
                                @if (!empty($results))
                                    {{ collect($results)->where('status', 'success')->count() }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide">Passed</div>
                        </div>
                        <div class="h-10 sm:h-12 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-xl sm:text-2xl font-bold text-amber-600">
                                @if (!empty($results))
                                    {{ collect($results)->where('status', 'warning')->count() }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide">Issues</div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="?run=all"
                            class="btn-primary px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-medium text-center text-sm sm:text-base">
                            <i class="fas fa-play-circle mr-2"></i>
                            Run All Checks
                        </a>
                        @if (!empty($results))
                            <a href="{{ url()->current() }}"
                                class="btn-secondary px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-medium text-center text-sm sm:text-base">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Checks
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Checks Grid or Results -->
            @if (empty($results))
                <!-- Available Checks -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4">
                    @foreach ($checks as $index => $check)
                        <a href="?run={{ $check['class'] }}" class="check-card card rounded-xl p-4 sm:p-6 fade-in"
                            style="animation-delay: {{ $index * 0.05 }}s">
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <i
                                        class="fas fa-{{ $index % 5 == 0 ? 'database' : ($index % 5 == 1 ? 'shield-alt' : ($index % 5 == 2 ? 'chart-line' : ($index % 5 == 3 ? 'server' : 'cog'))) }} text-gray-600"></i>
                                </div>
                                <i class="fas fa-arrow-right text-gray-400 text-sm"></i>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">{{ $check['name'] }}</h3>
                            <p class="text-xs text-gray-500">Click to run check</p>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Results -->
                <div class="space-y-4">
                    @foreach ($results as $result)
                        <div class="card rounded-xl overflow-hidden fade-in">
                            <!-- Result Header - Fully Responsive -->
                            <div
                                class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100 {{ $result['status'] === 'success' ? 'bg-green-50' : ($result['status'] === 'warning' ? 'bg-amber-50' : 'bg-red-50') }}">
                                <div class="flex flex-col gap-3">
                                    <!-- Top Row: Name and Status -->
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center flex-1">
                                            <span class="status-dot {{ $result['status'] }} mr-3 flex-shrink-0"></span>
                                            <h3 class="font-semibold text-gray-900 text-sm sm:text-base break-words">
                                                {{ $result['name'] }}</h3>
                                        </div>
                                        <a href="?run={{ array_search($result, $results) }}"
                                            class="text-indigo-600 hover:text-indigo-700 text-xs sm:text-sm font-medium flex-shrink-0 ml-2">
                                            <i class="fas fa-sync-alt mr-1"></i>
                                            <span class="hidden sm:inline">Re-run</span>
                                            <span class="sm:hidden">Retry</span>
                                        </a>
                                    </div>

                                    <!-- Bottom Row: Badges -->
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span
                                            class="text-xs px-2 py-1 rounded-full {{ $result['status'] === 'success' ? 'badge-success' : ($result['status'] === 'warning' ? 'badge-warning' : 'badge-error') }}">
                                            @if ($result['status'] === 'success')
                                                <i class="fas fa-check mr-1"></i>Passed
                                            @elseif($result['status'] === 'warning')
                                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $result['count'] }}
                                                {{ $result['count'] == 1 ? 'Issue' : 'Issues' }}
                                            @else
                                                <i class="fas fa-times mr-1"></i>Error
                                            @endif
                                        </span>
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                                            <i class="fas fa-clock mr-1"></i>{{ $result['execution_time'] }}ms
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Result Body -->
                            <div class="p-4 sm:p-6">
                                @if ($result['status'] === 'error')
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4">
                                        <div class="flex">
                                            <i
                                                class="fas fa-exclamation-circle text-red-500 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <p class="text-red-700 text-xs sm:text-sm break-words">
                                                {{ $result['message'] }}</p>
                                        </div>
                                    </div>
                                @elseif(empty($result['data']) || (is_countable($result['data']) && count($result['data']) === 0))
                                    <div class="flex items-center text-green-600">
                                        <i class="fas fa-check-circle mr-3 text-lg sm:text-xl flex-shrink-0"></i>
                                        <p class="font-medium text-sm sm:text-base">All checks passed successfully!</p>
                                    </div>
                                @else
                                    @php
                                        $data = $result['data'];
                                        
                                        if (is_object($data) && method_exists($data, 'toArray')) {
                                            $data = $data->toArray();
                                        }

                                        $firstItem = !empty($data) ? reset($data) : null;
                                        $headers = $firstItem ? array_keys((array) $firstItem) : [];
                                    @endphp

                                    @if (!empty($headers))
                                        <!-- Desktop Table View -->
                                        <div class="table-container hidden md:block">
                                            <table class="responsive-table w-full text-sm">
                                                <thead>
                                                    <tr class="border-b border-gray-200">
                                                        @foreach ($headers as $header)
                                                            <th
                                                                class="text-left py-3 px-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                {{ str_replace('_', ' ', $header) }}
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-100">
                                                    @foreach ($data as $row)
                                                        <tr class="hover:bg-gray-50 transition">
                                                            @foreach ((array) $row as $key => $value)
                                                                <td
                                                                    class="py-3 px-3 {{ str_contains($key, 'difference') && $value != 0 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                                                    {{ $value }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Mobile Card View -->
                                        <div class="mobile-cards md:hidden">
                                            <div class="space-y-3">
                                                @foreach ($data as $index => $row)
                                                    <div class="mobile-card-item">
                                                        <div class="flex items-center justify-between mb-2">
                                                            <span class="text-xs font-semibold text-gray-700">Item
                                                                #{{ $loop->iteration }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ((array) $row as $key => $value)
                                                                <div class="flex flex-col">
                                                                    <div class="mobile-label">
                                                                        {{ str_replace('_', ' ', $key) }}</div>
                                                                    <div
                                                                        class="mobile-value {{ str_contains($key, 'difference') && $value != 0 ? 'text-red-600 font-semibold' : '' }}">
                                                                        {{ $value ?: '-' }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-gray-500">No data to display</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Fixed Footer - Fully Responsive -->
    <footer class="footer">
        <div class="px-4 py-3">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex flex-col sm:flex-row items-center justify-center sm:justify-between gap-2 text-center sm:text-left">
                    <p class="text-xs sm:text-sm text-gray-600">
                        <span class="hidden sm:inline">Health Dashboard</span>
                        <span class="sm:hidden">Dashboard</span>
                        &copy; {{ date('Y') }}
                        <span class="hidden sm:inline">•</span>
                        <span class="sm:hidden">-</span>
                        Made with <i class="fas fa-heart text-red-500 text-xs"></i> by Snawbar
                    </p>
                    <a href="https://snawbar.com" target="_blank"
                        class="text-xs sm:text-sm text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center">
                        snawbar.com <i class="fas fa-external-link-alt text-xs ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
