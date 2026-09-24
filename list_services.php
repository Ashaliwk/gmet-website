<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$services = App\Models\backend\Services::all()->toArray();
echo json_encode($services, JSON_PRETTY_PRINT);
?>
