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
use Controllers\InventoryMovementController;

$router = new Router();
$router->get('/', fn()=> (new HomeController())->index());

$router->get('/products', fn()=> (new ProductController())->index());
$router->get('/products/create', fn()=> (new ProductController())->create());
$router->post('/products/store', fn()=> (new ProductController())->store());
$router->get('/products/edit', fn()=> (new ProductController())->edit());
$router->post('/products/update', fn()=> (new ProductController())->update());
$router->post('/products/destroy', fn()=> (new ProductController())->destroy());

$router->get('/drivers', fn()=> (new DriverController())->index());
$router->get('/drivers/create', fn()=> (new DriverController())->create());
$router->post('/drivers/store', fn()=> (new DriverController())->store());
$router->get('/drivers/edit', fn()=> (new DriverController())->edit());
$router->post('/drivers/update', fn()=> (new DriverController())->update());
$router->post('/drivers/destroy', fn()=> (new DriverController())->destroy());

$router->get('/trucks', fn()=> (new TruckController())->index());
$router->get('/trucks/create', fn()=> (new TruckController())->create());
$router->post('/trucks/store', fn()=> (new TruckController())->store());
$router->get('/trucks/edit', fn()=> (new TruckController())->edit());
$router->post('/trucks/update', fn()=> (new TruckController())->update());
$router->post('/trucks/destroy', fn()=> (new TruckController())->destroy());

$router->get('/routes', fn()=> (new RouteController())->index());
$router->get('/routes/create', fn()=> (new RouteController())->create());
$router->post('/routes/store', fn()=> (new RouteController())->store());
$router->get('/routes/edit', fn()=> (new RouteController())->edit());
$router->post('/routes/update', fn()=> (new RouteController())->update());
$router->post('/routes/destroy', fn()=> (new RouteController())->destroy());

// Ventas
$router->get('/sales', fn()=> (new SaleController())->index());
$router->get('/sales/create', fn()=> (new SaleController())->create());
$router->post('/sales/store', fn()=> (new SaleController())->store());
$router->get('/sales/edit', fn()=> (new SaleController())->edit());
$router->post('/sales/update', fn()=> (new SaleController())->update());
$router->post('/sales/destroy', fn()=> (new SaleController())->destroy());

// Ítems de ventas
$router->get('/sale_items', fn()=> (new SaleItemController())->index());           
$router->get('/sale_items/create', fn()=> (new SaleItemController())->create());   
$router->post('/sale_items/store', fn()=> (new SaleItemController())->store());
$router->get('/sale_items/edit', fn()=> (new SaleItemController())->edit());        
$router->post('/sale_items/update', fn()=> (new SaleItemController())->update());
$router->post('/sale_items/destroy', fn()=> (new SaleItemController())->destroy());


// Pagos
$router->get('/payments', fn()=> (new PaymentController())->index());           // opcional ?sale_id=#
$router->get('/payments/create', fn()=> (new PaymentController())->create());   // opcional ?sale_id=#
$router->post('/payments/store', fn()=> (new PaymentController())->store());
$router->get('/payments/edit', fn()=> (new PaymentController())->edit());       // ?id=#
$router->post('/payments/update', fn()=> (new PaymentController())->update());
$router->post('/payments/destroy', fn()=> (new PaymentController())->destroy());


$router->get('/inventory_movements', fn()=> (new InventoryMovementController())->index());
$router->get('/inventory_movements/create', fn()=> (new InventoryMovementController())->create());
$router->post('/inventory_movements/store', fn()=> (new InventoryMovementController())->store());
$router->get('/inventory_movements/edit', fn()=> (new InventoryMovementController())->edit());
$router->post('/inventory_movements/update', fn()=> (new InventoryMovementController())->update());
$router->post('/inventory_movements/destroy', fn()=> (new InventoryMovementController())->destroy());

$router->dispatch();
