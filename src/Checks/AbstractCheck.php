<?php

namespace Snawbar\Health\Checks;

use Exception;
use Snawbar\Health\Contracts\HealthCheck;
use Throwable;

abstract class AbstractCheck implements HealthCheck
{
    protected $data = [];

    protected $status = 'pending';

    protected $message = '';

    protected $executionTime = 0;

    abstract public function name(): string;

    abstract protected function run();

    public function check(): array
    {
        $start = microtime(TRUE);

        try {
            $this->executeRun();
            $this->evaluateStatus();
            $this->message = $this->getMessage();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        $this->executionTime = $this->calculateExecutionTime($start);

        return $this->buildResult();
    }

    protected function executeRun(): void
    {
        $this->data = $this->run();
    }

    protected function evaluateStatus(): void
    {
        $this->status = $this->isDataEmpty() ? 'success' : 'warning';
    }

    protected function handleException(Throwable $throwable): void
    {
        $this->status = 'error';
        $this->message = $throwable->getMessage();
        $this->data = [];
    }

    protected function calculateExecutionTime(float $start): float
    {
        return round((microtime(TRUE) - $start) * 1000, 2);
    }

    protected function buildResult(): array
    {
        return [
            'name' => $this->name(),
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'count' => $this->getDataCount(),
            'execution_time' => $this->executionTime,
        ];
    }

    protected function isDataEmpty(): bool
    {
        return blank($this->data) || $this->getDataCount() === 0;
    }

    protected function getDataCount(): int
    {
        return is_countable($this->data) ? count($this->data) : 0;
    }

    protected function getMessage(): string
    {
        return $this->isDataEmpty()
            ? 'All checks passed successfully'
            : sprintf('Found %d issue(s)', $this->getDataCount());
    }
}
