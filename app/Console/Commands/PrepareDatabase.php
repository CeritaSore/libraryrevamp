<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('app:prepare-database {--database= : The database connection to use}')]
#[Description('Prepare database schemas (e.g. PostgreSQL custom schemas) before running migrations')]
class PrepareDatabase extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $connection = (string) ($this->option('database') ?: config('database.default'));
        $driver = (string) config("database.connections.{$connection}.driver");

        if ($driver !== 'pgsql') {
            $this->components->info("Database connection [{$connection}] uses driver [{$driver}]. No PostgreSQL schema setup required.");

            return self::SUCCESS;
        }

        $searchPath = (string) config("database.connections.{$connection}.search_path", 'public');
        $schemas = array_map('trim', explode(',', $searchPath));

        foreach ($schemas as $schema) {
            if ($schema === '' || $schema === 'public' || $schema === '"$user"') {
                continue;
            }

            // Remove any quotes for validation and safety
            $cleanSchema = trim($schema, '"\'');

            if (! preg_match('/^[a-zA-Z0-9_]+$/', $cleanSchema)) {
                $this->components->error("Invalid schema name: [{$cleanSchema}]");

                return self::FAILURE;
            }

            try {
                DB::connection($connection)->statement(
                    "CREATE SCHEMA IF NOT EXISTS \"{$cleanSchema}\""
                );
                $this->components->info("PostgreSQL schema [{$cleanSchema}] successfully ensured.");
            } catch (\Throwable $e) {
                $this->components->error("Failed to prepare schema [{$cleanSchema}]: {$e->getMessage()}");

                return self::FAILURE;
            }
        }

        return self::SUCCESS;
    }
}
