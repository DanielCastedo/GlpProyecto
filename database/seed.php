<?php
require __DIR__ . '/../bootstrap.php';
use Core\Database;

$pdo = Database::pdo();

$pdo->prepare("INSERT IGNORE INTO users (name,email,password_hash,role) VALUES (?,?,?,?)")
    ->execute(['Admin','admin@example.com', password_hash('admin123', PASSWORD_BCRYPT), 'admin']);

$products = [
  ['Garrafa 10kg','GLP-10', 10, 25.00],
  ['Garrafa 20kg','GLP-20', 20, 45.00],
];
$stmt = $pdo->prepare("INSERT IGNORE INTO products (name,sku,cylinder_weight_kg,price) VALUES (?,?,?,?)");
foreach ($products as $p) $stmt->execute($p);

$pdo->exec("INSERT IGNORE INTO trucks (id, plate, model, capacity_units) VALUES (1,'SCZ-1234','Volvo FL',120)");
$pdo->exec("INSERT IGNORE INTO drivers (id, name, phone, license, truck_id) VALUES (1,'Juan Pérez','70000000','B-12345',1)");

$pdo->exec("INSERT IGNORE INTO routes (id, name, description) VALUES (1,'Ruta San José Centro','Distribución céntrica')");
$pdo->exec("INSERT IGNORE INTO schedules (route_id, day_of_week, start_time, end_time) VALUES (1,2,'08:00:00','12:00:00')");

$pdo->exec("INSERT INTO purchases (date,supplier,driver_id,truck_id,total,status) VALUES (CURDATE(),'YPFB',1,1,0,'confirmed')");
$purchaseId = (int)$pdo->lastInsertId();
$pi = $pdo->prepare("INSERT INTO purchase_items (purchase_id,product_id,qty,unit_cost,subtotal) VALUES (?,?,?,?,?)");
$pi->execute([$purchaseId,1,50,18.00,900.00]);
$pi->execute([$purchaseId,2,30,32.00,960.00]);
$pdo->prepare("UPDATE purchases SET total=(SELECT SUM(subtotal) FROM purchase_items WHERE purchase_id=?) WHERE id=?")->execute([$purchaseId,$purchaseId]);

$im = $pdo->prepare("INSERT INTO inventory_movements (product_id,date,type,qty,ref_table,ref_id) VALUES (?,?,?,?,?,?)");
$im->execute([1,date('Y-m-d'),'purchase',50,'purchases',$purchaseId]);
$im->execute([2,date('Y-m-d'),'purchase',30,'purchases',$purchaseId]);

$pdo->exec("INSERT INTO sales (date,customer_name,customer_phone,driver_id,route_id,total,amount_paid,balance_due,status) VALUES (CURDATE(),'Cliente Demo','78000000',1,1,0,0,0,'pending')");
$saleId = (int)$pdo->lastInsertId();
$si = $pdo->prepare("INSERT INTO sale_items (sale_id,product_id,qty,unit_price,subtotal) VALUES (?,?,?,?,?)");
$si->execute([$saleId,1,5,25.00,125.00]);
$si->execute([$saleId,2,2,45.00,90.00]);
$pdo->prepare("UPDATE sales SET total=(SELECT SUM(subtotal) FROM sale_items WHERE sale_id=?), amount_paid=100.00, balance_due = (SELECT SUM(subtotal) FROM sale_items WHERE sale_id=?)-100.00 WHERE id=?")
    ->execute([$saleId,$saleId,$saleId]);

$im->execute([1,date('Y-m-d'),'sale',-5,'sales',$saleId]);
$im->execute([2,date('Y-m-d'),'sale',-2,'sales',$saleId]);

echo "Seeders executed.\n";
