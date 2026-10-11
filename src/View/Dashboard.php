<?php

namespace Snawbar\Health\View;

class Dashboard
{
    private const ICONS = ['database', 'shield-halved', 'chart-line', 'server', 'gear', 'scale-balanced', 'boxes-stacked', 'file-invoice'];

    private const TONES = ['primary', 'success', 'orange', 'purple', 'slate'];

    private const STATUS_ICONS = [
        'success' => 'circle-check',
        'warning' => 'triangle-exclamation',
        'error' => 'circle-xmark',
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

    public function title(): string
    {
        return $this->hasResults() ? 'Results' : 'Checks';
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

    public function stats(): array
    {
        $total = [
            'label' => 'Total',
            'value' => $this->hasResults() ? count($this->results) : count($this->checks),
            'tone' => 'total',
        ];

        if (! $this->hasResults()) {
            return [$total];
        }

        $stats = [
            $total,
            ['label' => 'Passed', 'value' => $this->countByStatus('success'), 'tone' => 'success'],
            ['label' => 'Issues', 'value' => $this->countByStatus('warning'), 'tone' => 'warning'],
            ['label' => 'Errors', 'value' => $this->countByStatus('error'), 'tone' => 'error'],
        ];

        return array_values(array_filter($stats, fn ($stat) => $stat['tone'] !== 'error' || $stat['value'] > 0));
    }

    public function checks(): array
    {
        return collect($this->checks)
            ->values()
            ->map(fn ($check, $index) => [
                'name' => $check['name'],
                'url' => $this->runUrl($check['class']),
                'icon' => self::ICONS[$index % count(self::ICONS)],
                'tone' => self::TONES[$index % count(self::TONES)],
                'delay' => $this->animationDelay($index),
            ])
            ->all();
    }

    public function results(): array
    {
        return collect($this->results)
            ->map(fn ($result, $class) => $this->presentResult($class, $result))
            ->values()
            ->map(fn ($result, $index) => $result + ['delay' => $this->animationDelay($index)])
            ->all();
    }

    private function presentResult(string $class, array $result): array
    {
        $status = $result['status'];
        $data = $this->normalizeData($result['data']);
        $headers = $this->headers($data);

        return [
            'name' => $result['name'],
            'status' => $status,
            'icon' => self::STATUS_ICONS[$status] ?? self::STATUS_ICONS['error'],
            'label' => $this->statusLabel($status, (int) $result['count']),
            'time' => $result['execution_time'] . ' ms',
            'rerunUrl' => $this->runUrl($class),
            'message' => $result['message'],
            'view' => $this->bodyView($status, $data, $headers),
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
            'warning' => sprintf('%d %s', $count, $count === 1 ? 'issue' : 'issues'),
            default => 'Error',
        };
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

    private function animationDelay(int $index): string
    {
        return (min($index, 20) * 0.03) . 's';
    }
}
