<?php
namespace Controllers;

use Core\Controller;
use Core\Database;
use Models\Purchase;
use Models\PurchaseItem;
use Models\Product;
use Models\Driver;
use Models\Truck;

class PurchaseController extends Controller {
    private Purchase $purchaseModel;
    private PurchaseItem $itemModel;

    public function __construct() {
        $this->purchaseModel = new Purchase();
        $this->itemModel = new PurchaseItem();
    }

    public function index() {
        $items = $this->purchaseModel->allWithRelations();
        $this->render('purchases/index', compact('items'));
    }

    public function create() {
        $drivers = (new Driver())->all();
        $trucks = (new Truck())->all();
        $products = (new Product())->all();
        $this->render('purchases/create', compact('drivers','trucks','products'));
    }

    public function store() {
        $id = $this->purchaseModel->create([
            'date' => $_POST['date'] ?? date('Y-m-d'),
            'supplier' => $_POST['supplier'] ?? null,
            'driver_id' => $_POST['driver_id'] ?? null,
            'truck_id' => $_POST['truck_id'] ?? null,
            'total' => 0,
            'status' => $_POST['status'] ?? 'confirmed'
        ]);
        $this->redirect($this->baseUrl() . "/purchases/edit?id=$id");
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $purchase = $this->purchaseModel->find($id);
        if (!$purchase) { echo "<p>Compra no encontrada</p>"; return; }

        $items = $this->itemModel->itemsByPurchase($id);
        $drivers = (new Driver())->all();
        $trucks = (new Truck())->all();
        $products = (new Product())->all();

        $this->render('purchases/edit', compact('purchase','items','drivers','trucks','products'));
    }

    public function update() {
        $id = (int)$_POST['id'];
        $this->purchaseModel->update($id, $_POST);
        $this->redirect($this->baseUrl() . '/purchases');
    }

    public function destroy() {
        $id = (int)$_POST['id'];
        $this->purchaseModel->delete($id);
        $this->redirect($this->baseUrl() . '/purchases');
    }

    // CONFIRMAR compra: genera movimientos de inventario
    public function confirm() {
        $pdo = Database::pdo();
        $id = (int)($_POST['id'] ?? 0);
        $purchase = $this->purchaseModel->find($id);
        if (!$purchase) return;

        $items = $this->itemModel->itemsByPurchase($id);
        foreach ($items as $item) {
            $pdo->prepare("INSERT INTO inventory_movements (product_id, date, type, qty, ref_table, ref_id)
                VALUES (?, ?, 'purchase', ?, 'purchases', ?)")
                ->execute([$item['product_id'], $purchase['date'], $item['qty'], $id]);
        }

        $pdo->prepare("UPDATE purchases SET status='confirmed' WHERE id=?")->execute([$id]);
        $this->redirect($this->baseUrl() . '/purchases');
    }
}
