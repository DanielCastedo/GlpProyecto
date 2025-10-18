<?php
namespace Controllers;

use Core\Controller;
use Models\PurchaseItem;
use Models\Purchase;
use Models\Product;

class PurchaseItemController extends Controller {
    private PurchaseItem $model;

    public function __construct() { $this->model = new PurchaseItem(); }

    public function store() {
        $data = $_POST;
        $data['subtotal'] = $data['qty'] * $data['unit_cost'];
        $this->model->create($data);

        // recalcular total
        (new Purchase())->recalculateTotal((int)$data['purchase_id']);
        $this->redirect($this->baseUrl() . '/purchases/edit?id=' . $data['purchase_id']);
    }

    public function destroy() {
        $id = (int)$_POST['id'];
        $purchaseId = (int)$_POST['purchase_id'];
        $this->model->delete($id);
        (new Purchase())->recalculateTotal($purchaseId);
        $this->redirect($this->baseUrl() . '/purchases/edit?id=' . $purchaseId);
    }
}
