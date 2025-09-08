<?php

namespace Snawbar\Health\Commands;

use Illuminate\Console\Command;

class HealthCommand extends Command
{
    protected $signature = 'app:health';

    protected $description = 'Run health checks for your application';

    private int $passedCount = 0;

    private int $failedCount = 0;

    private int $errorCount = 0;

    public function handle(): void
    {
        foreach (config('health.checks', []) as $checkClass) {
            $instance = new $checkClass;
            $this->processResult($instance->name(), $instance->check());
        }

        $this->printSummary();
    }

    private function processResult(string $name, array $result): void
    {
        match ($result['status']) {
            'success' => $this->markPassed($name, $result['time']),
            'warning' => $this->markFailed($name, $result['time']),
            default => $this->markError($name),
        };
    }

    private function markPassed(string $name, float $time): void
    {
        $this->components->info(sprintf('✓ %s PASSED in %.2f ms', $name, $time));
        $this->passedCount++;
    }

    private function markFailed(string $name, float $time): void
    {
        $this->components->warn(sprintf('⚠ %s FAILED in %.2f ms', $name, $time));
        $this->failedCount++;
    }

    private function markError(string $name): void
    {
        $this->components->error(sprintf('✗ %s ERROR', $name));
        $this->errorCount++;
    }

    private function printSummary(): void
    {
        $this->components->info(sprintf(
            'Health Check Summary: %d passed, %d failed, %d errors.',
            $this->passedCount,
            $this->failedCount,
            $this->errorCount
        ));
    }
}
