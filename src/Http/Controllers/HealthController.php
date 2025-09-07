<?php

namespace Snawbar\Health\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HealthController extends Controller
{
    public function __invoke(Request $request)
    {
        $checks = $this->getAvailableChecks();
        $results = $this->runChecks($request, $checks);

        return view('health::dashboard', [
            'checks' => $checks,
            'results' => $results,
        ]);
    }

    private function runChecks(Request $request, array $checks): array
    {
        if (! $request->has('run')) {
            return [];
        }

        $runCheck = $request->get('run');

        return collect($checks)
            ->filter(fn ($check) => $this->shouldRunCheck($check, $runCheck))
            ->mapWithKeys(fn ($check) => [$check['class'] => $this->executeCheck($check['class'])])
            ->toArray();
    }

    private function shouldRunCheck(array $check, string $runCheck): bool
    {
        return $runCheck === 'all' || $check['class'] === $runCheck;
    }

    private function executeCheck(string $class): array
    {
        return (new $class)->check();
    }

    private function getAvailableChecks(): array
    {
        return collect(config('snawbar-health.checks', []))
            ->filter(fn ($class) => class_exists($class))
            ->map(fn ($class) => [
                'class' => $class,
                'name' => (new $class)->name(),
            ])
            ->values()
            ->toArray();
    }
}
