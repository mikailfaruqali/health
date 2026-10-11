<?php

declare(strict_types=1);

namespace Snawbar\Health\Contracts;

interface HealthCheck
{
    public function name(): string;

    public function check(): array;

    public function haltOnError(): bool;
}
