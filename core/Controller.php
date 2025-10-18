<?php
namespace Core;

class Controller {
    protected function render(string $view, array $params = []) {
        extract($params);

        $config = require __DIR__ . '/../config/config.php';
        $base = rtrim($config['app']['base_url'] ?? '', '/');

        $viewFile   = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layout.php';

        // No aplicar layout para login ni registro
        if (in_array($view, ['auth/login', 'auth/register'])) {
            if (is_file($viewFile)) {
                include $viewFile;
            } else {
                echo "<p>View not found: {$view}</p>";
            }
            return;
        }

        // Si no es login ni registro, aplica layout general
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
