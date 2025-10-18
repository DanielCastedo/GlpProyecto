<?php
namespace Controllers;

use Core\Controller;
use Core\Database;
use Models\InventoryMovement;
use Models\Product;

class InventoryMovementController extends Controller {
    private InventoryMovement $model;

    public function __construct(){ $this->model = new InventoryMovement(); }

    public function index(){
        $pdo = Database::pdo();
        $product_id = isset($_GET['product_id']) && $_GET['product_id'] !== '' ? (int)$_GET['product_id'] : null;

        if ($product_id) {
            $stmt = $pdo->prepare("
                SELECT im.*, p.name AS product_name
                FROM inventory_movements im
                JOIN products p ON p.id = im.product_id
                WHERE im.product_id = ?
                ORDER BY im.date DESC, im.id DESC
            ");
            $stmt->execute([$product_id]);
            $items = $stmt->fetchAll();
        } else {
            $items = $pdo->query("
                SELECT im.*, p.name AS product_name
                FROM inventory_movements im
                JOIN products p ON p.id = im.product_id
                ORDER BY im.date DESC, im.id DESC
            ")->fetchAll();
        }

        // Para filtro y para mostrar stock rápido
        $products = (new Product())->all();
        $stock = $pdo->query("
            SELECT product_id, SUM(qty) AS stock_qty 
            FROM inventory_movements 
            GROUP BY product_id
        ")->fetchAll();

        // Hash de stock por product_id
        $stockByProduct = [];
        foreach ($stock as $s) $stockByProduct[(int)$s['product_id']] = (int)$s['stock_qty'];

        $this->render('inventory_movements/index', compact('items','products','product_id','stockByProduct'));
    }

    public function create(){
        $products = (new Product())->all();
        $this->render('inventory_movements/create', compact('products'));
    }

    public function store(){
        $_POST['date'] = $_POST['date'] ?? date('Y-m-d');
        $_POST['type'] = $_POST['type'] ?? 'adjustment';
        $_POST['qty']  = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;

        // Normalización de signo
        if ($_POST['type'] === 'purchase' && $_POST['qty'] < 0) $_POST['qty'] = -$_POST['qty'];
        if ($_POST['type'] === 'sale'     && $_POST['qty'] > 0)  $_POST['qty'] = -$_POST['qty'];

        $this->model->create($_POST);
        $redir = $this->baseUrl() . '/inventory_movements';
        if (!empty($_POST['product_id'])) $redir .= '?product_id=' . (int)$_POST['product_id'];
        $this->redirect($redir);
    }

    public function edit(){
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) { echo "<p>Movimiento no encontrado</p>"; return; }
        $products = (new Product())->all();
        $this->render('inventory_movements/edit', compact('item','products'));
    }

    public function update(){
        $id = (int)$_POST['id'];
        $_POST['type'] = $_POST['type'] ?? 'adjustment';
        $_POST['qty']  = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;

        // Normalización de signo
        if ($_POST['type'] === 'purchase' && $_POST['qty'] < 0) $_POST['qty'] = -$_POST['qty'];
        if ($_POST['type'] === 'sale'     && $_POST['qty'] > 0)  $_POST['qty'] = -$_POST['qty'];

        $this->model->update($id, $_POST);

        $redir = $this->baseUrl() . '/inventory_movements';
        if (!empty($_POST['product_id'])) $redir .= '?product_id=' . (int)$_POST['product_id'];
        $this->redirect($redir);
    }

    public function destroy(){
        $id = (int)$_POST['id'];
        $im = $this->model->find($id);
        $this->model->delete($id);

        $redir = $this->baseUrl() . '/inventory_movements';
        if ($im && !empty($im['product_id'])) $redir .= '?product_id=' . (int)$im['product_id'];
        $this->redirect($redir);
    }
}
