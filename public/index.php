<?php
require __DIR__ . '/../bootstrap.php';

use Core\Router;
use Controllers\HomeController;
use Controllers\ProductController;
use Controllers\DriverController;
use Controllers\PaymentController;
use Controllers\TruckController;
use Controllers\RouteController;
use Controllers\SaleController;
use Controllers\SaleItemController;
use Controllers\ScheduleController;
use Controllers\PurchaseController;
use Controllers\PurchaseItemController;
use Controllers\InventoryMovementController;
use Controllers\AuthController;

session_start(); // Siempre iniciamos la sesión al principio

$router = new Router();

// ======================
//       RUTAS BASE
// ======================
$router->get('/', fn()=> (new HomeController())->index());

// ---------- Productos ----------
$router->get('/products', fn()=> (new ProductController())->index());
$router->get('/products/create', fn()=> (new ProductController())->create());
$router->post('/products/store', fn()=> (new ProductController())->store());
$router->get('/products/edit', fn()=> (new ProductController())->edit());
$router->post('/products/update', fn()=> (new ProductController())->update());
$router->post('/products/destroy', fn()=> (new ProductController())->destroy());

// ---------- Conductores ----------
$router->get('/drivers', fn()=> (new DriverController())->index());
$router->get('/drivers/create', fn()=> (new DriverController())->create());
$router->post('/drivers/store', fn()=> (new DriverController())->store());
$router->get('/drivers/edit', fn()=> (new DriverController())->edit());
$router->post('/drivers/update', fn()=> (new DriverController())->update());
$router->post('/drivers/destroy', fn()=> (new DriverController())->destroy());

// ---------- Camiones ----------
$router->get('/trucks', fn()=> (new TruckController())->index());
$router->get('/trucks/create', fn()=> (new TruckController())->create());
$router->post('/trucks/store', fn()=> (new TruckController())->store());
$router->get('/trucks/edit', fn()=> (new TruckController())->edit());
$router->post('/trucks/update', fn()=> (new TruckController())->update());
$router->post('/trucks/destroy', fn()=> (new TruckController())->destroy());

// ---------- Rutas de distribución ----------
$router->get('/routes', fn()=> (new RouteController())->index());
$router->get('/routes/create', fn()=> (new RouteController())->create());
$router->post('/routes/store', fn()=> (new RouteController())->store());
$router->get('/routes/edit', fn()=> (new RouteController())->edit());
$router->post('/routes/update', fn()=> (new RouteController())->update());
$router->post('/routes/destroy', fn()=> (new RouteController())->destroy());

// ---------- Ventas ----------
$router->get('/sales', fn()=> (new SaleController())->index());
$router->get('/sales/create', fn()=> (new SaleController())->create());
$router->post('/sales/store', fn()=> (new SaleController())->store());
$router->get('/sales/edit', fn()=> (new SaleController())->edit());
$router->post('/sales/update', fn()=> (new SaleController())->update());
$router->post('/sales/destroy', fn()=> (new SaleController())->destroy());

// ---------- Ítems de ventas ----------
$router->get('/sale_items', fn()=> (new SaleItemController())->index());
$router->get('/sale_items/create', fn()=> (new SaleItemController())->create());
$router->post('/sale_items/store', fn()=> (new SaleItemController())->store());
$router->get('/sale_items/edit', fn()=> (new SaleItemController())->edit());
$router->post('/sale_items/update', fn()=> (new SaleItemController())->update());
$router->post('/sale_items/destroy', fn()=> (new SaleItemController())->destroy());

// ---------- Pagos ----------
$router->get('/payments', fn()=> (new PaymentController())->index());
$router->get('/payments/create', fn()=> (new PaymentController())->create());
$router->post('/payments/store', fn()=> (new PaymentController())->store());
$router->get('/payments/edit', fn()=> (new PaymentController())->edit());
$router->post('/payments/update', fn()=> (new PaymentController())->update());
$router->post('/payments/destroy', fn()=> (new PaymentController())->destroy());

// ---------- Horarios ----------
$router->get('/sale_items/add_multiple', fn()=> (new SaleItemController())->add_multiple());
$router->post('/sale_items/store_multiple', fn()=> (new SaleItemController())->store_multiple());

// ---------- Horarios ----------
$router->get('/schedules', fn()=> (new ScheduleController())->index());
$router->get('/schedules/create', fn()=> (new ScheduleController())->create());
$router->post('/schedules/store', fn()=> (new ScheduleController())->store());
$router->get('/schedules/edit', fn()=> (new ScheduleController())->edit());
$router->post('/schedules/update', fn()=> (new ScheduleController())->update());
$router->post('/schedules/destroy', fn()=> (new ScheduleController())->destroy());

// ---------- Compras e ítems ----------
$router->get('/purchases', fn()=> (new PurchaseController())->index());
$router->get('/purchases/create', fn()=> (new PurchaseController())->create());
$router->post('/purchases/store', fn()=> (new PurchaseController())->store());
$router->get('/purchases/edit', fn()=> (new PurchaseController())->edit());
$router->post('/purchases/update', fn()=> (new PurchaseController())->update());
$router->post('/purchases/destroy', fn()=> (new PurchaseController())->destroy());
$router->post('/purchases/confirm', fn()=> (new PurchaseController())->confirm());
$router->post('/purchase_items/store', fn()=> (new PurchaseItemController())->store());
$router->post('/purchase_items/destroy', fn()=> (new PurchaseItemController())->destroy());

// ---------- Movimientos de inventario ----------
$router->get('/inventory_movements', fn()=> (new InventoryMovementController())->index());
$router->get('/inventory_movements/create', fn()=> (new InventoryMovementController())->create());
$router->post('/inventory_movements/store', fn()=> (new InventoryMovementController())->store());
$router->get('/inventory_movements/edit', fn()=> (new InventoryMovementController())->edit());
$router->post('/inventory_movements/update', fn()=> (new InventoryMovementController())->update());
$router->post('/inventory_movements/destroy', fn()=> (new InventoryMovementController())->destroy());

// ---------- Autenticación (Login / Logout / Perfil) ----------
$router->get('/login', fn()=> (new AuthController())->loginForm());
$router->post('/login', fn()=> (new AuthController())->login());
$router->get('/logout', fn()=> (new AuthController())->logout());
$router->get('/profile', fn()=> (new AuthController())->profile());
$router->post('/profile/update', fn()=> (new AuthController())->updateProfile());

// =============================
//   🔧 Ajuste de ruta base
// =============================
$config = require __DIR__ . '/../config/config.php';
$basePath = rtrim($config['app']['base_url'], '/'); // Ej: /glpnuevo/public

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si la URL contiene el base path (/glpnuevo/public), lo removemos
if (str_starts_with($requestUri, $basePath)) {
    $_SERVER['REQUEST_URI'] = substr($requestUri, strlen($basePath));
}

// =============================
//   🔒 Middleware de sesión
// =============================
$publicRoutes = ['/login'];
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si el usuario no ha iniciado sesión, redirige al login
if (!in_array($current, $publicRoutes) && empty($_SESSION['user'])) {
    header('Location: ' . $basePath . '/login');
    exit;
}

// Finalmente, despachamos las rutas
$router->dispatch();
