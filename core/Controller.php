<?php
namespace Core;

class Controller {
    protected function render(string $view, array $params = []) {
        extract($params);

        $config = require __DIR__ . '/../config/config.php';
        $base = rtrim($config['app']['base_url'] ?? '', '/');

        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layout.php';

        // Si la vista es el login, no aplicar layout
        if ($view === 'auth/login') {
            if (is_file($viewFile)) {
                include $viewFile;
            } else {
                echo "<p>View not found: {$view}</p>";
            }
            return;
        }

        ob_start();
        if (is_file($viewFile)) {
            include $viewFile;
        } else {
            echo "<p>View not found: {$view}</p>";
        }
        $content = ob_get_clean();
        include $layoutFile;
    }

    protected function redirect(string $url) {
        header("Location: {$url}");
        exit;
    }

    protected function baseUrl(): string {
        $c = require __DIR__ . '/../config/config.php';
        return rtrim($c['app']['base_url'] ?? '', '/');
    }
}
