<?php
// bootstrap.php — Autoload + DB bootstrap (sin router)
spl_autoload_register(function ($class) {
    $map = [
        'Core\\'        => __DIR__ . '/core/',
        'Controllers\\' => __DIR__ . '/controllers/',
        'Models\\'      => __DIR__ . '/models/',
    ];
    foreach ($map as $prefix => $dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) continue;
        $relative = substr($class, $len);
        $file = $dir . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($file)) { require $file; return; }
    }
});
// Probar conexión
Core\Database::pdo();
