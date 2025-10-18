<?php
namespace Controllers;

use Core\Controller;
use Models\SaleItem;
use Models\Product;
use Core\Database;

class SaleItemController extends Controller {
    private SaleItem $model;

    public function __construct(){ $this->model = new SaleItem(); }

    public function index(){
        $sale_id = (int)($_GET['sale_id'] ?? 0);
        // Listar ítems de una venta específica
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            SELECT si.*, p.name AS product_name 
            FROM sale_items si 
            JOIN products p ON p.id = si.product_id
            WHERE si.sale_id = ?
            ORDER BY si.id DESC
        ");
        $stmt->execute([$sale_id]);
        $items = $stmt->fetchAll();

        $this->render('sale_items/index', compact('items','sale_id'));
    }

    public function create(){
        $sale_id = (int)($_GET['sale_id'] ?? 0);
        // Productos para combo
        $products = (new Product())->all();
        $this->render('sale_items/create', compact('sale_id','products'));
    }

    public function store(){
        // Calcular subtotal si no viene
        if (!isset($_POST['subtotal']) || $_POST['subtotal'] === '') {
            $_POST['subtotal'] = (float)$_POST['qty'] * (float)$_POST['unit_price'];
        }
        $this->model->create($_POST);
        $this->recalcSale((int)$_POST['sale_id']);
        $this->redirect($this->baseUrl() . '/sale_items?sale_id='.(int)$_POST['sale_id']);
    }

    public function edit(){
        $id = (int)($_GET['id'] ?? 0);
        $saleItem = $this->model->find($id);
        if (!$saleItem) { echo "<p>Item no encontrado</p>"; return; }
        $products = (new Product())->all();
        $this->render('sale_items/edit', ['item' => $saleItem, 'products'=>$products]);
    }

    public function update(){
        $id = (int)$_POST['id'];
        if (!isset($_POST['subtotal']) || $_POST['subtotal'] === '') {
            $_POST['subtotal'] = (float)$_POST['qty'] * (float)$_POST['unit_price'];
        }
        $this->model->update($id, $_POST);
        $this->recalcSale((int)$_POST['sale_id']);
        $this->redirect($this->baseUrl() . '/sale_items?sale_id='.(int)$_POST['sale_id']);
    }

    public function destroy(){
        $id = (int)$_POST['id'];
        $saleItem = $this->model->find($id);
        $sale_id = $saleItem ? (int)$saleItem['sale_id'] : 0;
        $this->model->delete($id);
        if ($sale_id) $this->recalcSale($sale_id);
        $this->redirect($this->baseUrl() . '/sale_items?sale_id='.$sale_id);
    }

    private function recalcSale(int $sale_id): void {
        $pdo = Database::pdo();
        $total = (float)$pdo->query("SELECT COALESCE(SUM(subtotal),0) AS t FROM sale_items WHERE sale_id = {$sale_id}")
                            ->fetch()['t'];
        // mantenemos amount_paid; recalculamos balance_due
        $stmt = $pdo->prepare("SELECT amount_paid FROM sales WHERE id = ?");
        $stmt->execute([$sale_id]);
        $row = $stmt->fetch();
        $amount_paid = $row ? (float)$row['amount_paid'] : 0.0;

        $balance_due = max(0, $total - $amount_paid);

        $upd = $pdo->prepare("UPDATE sales SET total=?, balance_due=? WHERE id=?");
        $upd->execute([$total, $balance_due, $sale_id]);
    }
}
