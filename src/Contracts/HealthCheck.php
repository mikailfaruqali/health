<?php

namespace Snawbar\Health\Contracts;

interface HealthCheck
{
    public function name(): string;

    public function check(): array;
}
