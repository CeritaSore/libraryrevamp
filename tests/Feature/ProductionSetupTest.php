<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

test('health check endpoint /up responds with success', function () {
    $response = $this->get('/up');

    $response->assertOk();
});

test('trusted proxies properly resolves https scheme from reverse proxy headers', function () {
    $response = $this->withHeaders([
        'X-Forwarded-Proto' => 'https',
    ])->get('/');

    expect(request()->isSecure())->toBeTrue();
});

test('prepare-database command skips non-pgsql driver with success status', function () {
    Config::set('database.default', 'sqlite');

    $exitCode = Artisan::call('app:prepare-database');

    expect($exitCode)->toBe(0);
});

test('prepare-database command rejects invalid schema names', function () {
    Config::set('database.default', 'pgsql');
    Config::set('database.connections.pgsql.driver', 'pgsql');
    Config::set('database.connections.pgsql.search_path', 'invalid schema; DROP TABLE users;--');

    $exitCode = Artisan::call('app:prepare-database');

    expect($exitCode)->toBe(1);
});

test('prepare-database command executes create schema if not exists for valid schema', function () {
    Config::set('database.default', 'pgsql');
    Config::set('database.connections.pgsql.driver', 'pgsql');
    Config::set('database.connections.pgsql.search_path', 'libraryrevamp,public');

    DB::shouldReceive('connection')
        ->with('pgsql')
        ->once()
        ->andReturnSelf();

    DB::shouldReceive('statement')
        ->with('CREATE SCHEMA IF NOT EXISTS "libraryrevamp"')
        ->once()
        ->andReturnTrue();

    $exitCode = Artisan::call('app:prepare-database');

    expect($exitCode)->toBe(0);
});
