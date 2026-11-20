<?php
/**
 * Standalone Migration Runner
 * Run this file directly if you can't run artisan commands
 * 
 * Usage: php migrate.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->call('migrate', [
    '--force' => true,
    '--step' => true,
]);

echo "\n";
echo "Migration completed with status: " . $status . "\n";
echo "\n";

if ($status === 0) {
    echo "✓ Success! All migrations have been run.\n";
    echo "\n";
    echo "You can now access: http://localhost:8000/account\n";
} else {
    echo "✗ Migration failed. Please check the error messages above.\n";
}

echo "\n";
