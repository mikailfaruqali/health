<?php

namespace Snawbar\Health\View;

class Dashboard
{
    private const STATUS_ICONS = [
        'success' => 'check',
        'warning' => 'alert',
        'error' => 'x',
    ];

    private array $checks;

    private array $results;

    public function __construct(array $checks, array $results)
    {
        $this->checks = $checks;
        $this->results = $results;
    }

    public function hasResults(): bool
    {
        return filled($this->results);
    }

    public function hasChecks(): bool
    {
        return filled($this->checks);
    }

    public function backUrl(): string
    {
        return url()->current();
    }

    public function runAllUrl(): string
    {
        return $this->runUrl('all');
    }

    public function year(): string
    {
        return date('Y');
    }

    public function listTitle(): string
    {
        return $this->hasResults() ? 'Results' : 'Checks';
    }

    public function listCount(): int
    {
        return $this->hasResults() ? count($this->results) : count($this->checks);
    }

    public function summary(): array
    {
        $passed = $this->countByStatus('success');
        $issues = $this->countByStatus('warning');
        $errors = $this->countByStatus('error');

        return match (TRUE) {
            ! $this->hasResults() => [
                'tone' => 'idle',
                'icon' => 'pulse',
                'title' => $this->hasChecks() ? $this->plural(count($this->checks), 'check') . ' configured' : 'No checks configured',
                'text' => $this->hasChecks() ? 'Run every check at once, or pick a single one below.' : 'Register check classes in config/snawbar-health.php.',
            ],
            $errors > 0 => [
                'tone' => 'error',
                'icon' => 'x',
                'title' => $this->plural($errors, 'check') . ' failed to run',
                'text' => $this->breakdown($passed),
            ],
            $issues > 0 => [
                'tone' => 'warning',
                'icon' => 'alert',
                'title' => $this->plural($issues, 'check') . ' need attention',
                'text' => $this->breakdown($passed),
            ],
            default => [
                'tone' => 'success',
                'icon' => 'check',
                'title' => 'All checks passed',
                'text' => sprintf('%s completed with no issues found.', $this->plural($passed, 'check')),
            ],
        };
    }

    public function stats(): array
    {
        if (! $this->hasResults()) {
            return [];
        }

        return [
            ['label' => 'Passed', 'value' => $this->countByStatus('success'), 'tone' => 'success'],
            ['label' => 'Issues', 'value' => $this->countByStatus('warning'), 'tone' => 'warning'],
            ['label' => 'Errors', 'value' => $this->countByStatus('error'), 'tone' => 'error'],
        ];
    }

    public function checks(): array
    {
        return collect($this->checks)
            ->map(fn ($check) => [
                'name' => $check['name'],
                'url' => $this->runUrl($check['class']),
            ])
            ->values()
            ->all();
    }

    public function results(): array
    {
        return collect($this->results)
            ->map(fn ($result, $class) => $this->presentResult($class, $result))
            ->values()
            ->all();
    }

    private function presentResult(string $class, array $result): array
    {
        $status = $result['status'];
        $data = $this->normalizeData($result['data']);
        $headers = $this->headers($data);
        $view = $this->bodyView($status, $data, $headers);

        return [
            'name' => $result['name'],
            'status' => $status,
            'icon' => self::STATUS_ICONS[$status] ?? self::STATUS_ICONS['error'],
            'label' => $this->statusLabel($status, (int) $result['count']),
            'time' => $result['execution_time'] . ' ms',
            'rerunUrl' => $this->runUrl($class),
            'message' => $result['message'],
            'view' => $view,
            'expandable' => $view !== 'passed',
            'headers' => array_map(fn ($header) => str_replace('_', ' ', $header), $headers),
            'rows' => $this->rows($data),
        ];
    }

    private function bodyView(string $status, array $data, array $headers): string
    {
        return match (TRUE) {
            $status === 'error' => 'error',
            blank($data) => 'passed',
            filled($headers) => 'table',
            default => 'no-data',
        };
    }

    private function statusLabel(string $status, int $count): string
    {
        return match ($status) {
            'success' => 'Passed',
            'warning' => $this->plural($count, 'issue'),
            default => 'Error',
        };
    }

    private function breakdown(int $passed): string
    {
        return sprintf('%d of %d checks passed. Expand a check below to see what was found.', $passed, count($this->results));
    }

    private function plural(int $count, string $word): string
    {
        return sprintf('%d %s', $count, $count === 1 ? $word : $word . 's');
    }

    private function normalizeData($data): array
    {
        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        return is_iterable($data) ? collect($data)->all() : [];
    }

    private function headers(array $data): array
    {
        $first = reset($data);

        return $first ? array_keys((array) $first) : [];
    }

    private function rows(array $data): array
    {
        return collect($data)
            ->values()
            ->map(fn ($row, $index) => [
                'number' => $index + 1,
                'cells' => $this->cells((array) $row),
            ])
            ->all();
    }

    private function cells(array $row): array
    {
        return collect($row)
            ->map(fn ($value, $key) => [
                'value' => is_scalar($value) || is_null($value) ? $value : json_encode($value),
                'isNull' => is_null($value) || $value === '',
                'isDiff' => str_contains((string) $key, 'difference') && $value != 0,
            ])
            ->values()
            ->all();
    }

    private function countByStatus(string $status): int
    {
        return collect($this->results)->where('status', $status)->count();
    }

    private function runUrl(string $check): string
    {
        return '?run=' . urlencode($check);
    }
}
