<?php

namespace Controllers;

use Core\Controller;
use Core\Database;
use Models\Payment;

class PaymentController extends Controller
{
    private Payment $model;

    public function __construct()
    {
        $this->model = new Payment();
    }

    // Lista pagos (opcionalmente filtrados por venta)
    public function index()
    {
        $sale_id = isset($_GET['sale_id']) ? (int)$_GET['sale_id'] : null;

        if ($sale_id) {
            $pdo = Database::pdo();
            $stmt = $pdo->prepare("
                SELECT p.*, s.customer_name 
                FROM payments p 
                JOIN sales s ON s.id = p.sale_id
                WHERE p.sale_id = ?
                ORDER BY p.date DESC, p.id DESC
            ");
            $stmt->execute([$sale_id]);
            $items = $stmt->fetchAll();
        } else {
            $pdo = Database::pdo();
            $items = $pdo->query("
                SELECT p.*, s.customer_name 
                FROM payments p 
                LEFT JOIN sales s ON s.id = p.sale_id
                ORDER BY p.date DESC, p.id DESC
            ")->fetchAll();
        }

        $this->render('payments/index', compact('items', 'sale_id'));
    }

    public function create()
    {
        $sale_id = (int)($_GET['sale_id'] ?? 0);
        $venta = [];
        if ($sale_id) {
            $pdo = Database::pdo();
            $venta = $pdo->query("SELECT total, amount_paid, balance_due FROM sales WHERE id = $sale_id")->fetch();
        }
        $this->render('payments/create', compact('sale_id', 'venta'));
    }

    public function store()
    {
        // Validaciones mínimas
        $_POST['date'] = $_POST['date'] ?? date('Y-m-d');
        $_POST['method'] = $_POST['method'] ?? 'cash';

        $this->model->create($_POST);

        $sale_id = (int)$_POST['sale_id'];
        $this->recalcSalePaid($sale_id);

        $this->redirect($this->baseUrl() . '/payments?sale_id=' . $sale_id);
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) {
            echo "<p>Pago no encontrado</p>";
            return;
        }
        $this->render('payments/edit', compact('item'));
    }

    public function update()
    {
        $id = (int)$_POST['id'];
        $ok = $this->model->update($id, $_POST);

        // Obtener sale_id para recalcular
        $pay = $this->model->find($id);
        $sale_id = $pay ? (int)$pay['sale_id'] : (int)($_POST['sale_id'] ?? 0);
        if ($sale_id) $this->recalcSalePaid($sale_id);

        $this->redirect($this->baseUrl() . '/payments?sale_id=' . $sale_id);
    }

    public function destroy()
    {
        $id = (int)$_POST['id'];
        $pay = $this->model->find($id);
        $sale_id = $pay ? (int)$pay['sale_id'] : 0;

        $this->model->delete($id);

        if ($sale_id) $this->recalcSalePaid($sale_id);
        $this->redirect($this->baseUrl() . '/payments?sale_id=' . $sale_id);
    }

    /**
     * Recalcula amount_paid y balance_due en sales:
     * amount_paid = SUM(payments.amount)
     * balance_due = GREATEST(total - amount_paid, 0)
     */
    private function recalcSalePaid(int $sale_id): void
    {
        $pdo = Database::pdo();

        // Calcula el total pagado
        $sum = $pdo->prepare("SELECT COALESCE(SUM(amount),0) AS paid FROM payments WHERE sale_id = ?");
        $sum->execute([$sale_id]);
        $paid = (float)($sum->fetch()['paid'] ?? 0);

        // Obtiene el total de la venta
        $st = $pdo->prepare("SELECT total FROM sales WHERE id = ?");
        $st->execute([$sale_id]);
        $total = (float)($st->fetch()['total'] ?? 0);

        $balance = max(0, $total - $paid);

        // Determina el estado de la venta
        $status = ($balance == 0 && $total > 0) ? 'paid' : 'pending';

        // Actualiza la venta con el nuevo estado
        $upd = $pdo->prepare("UPDATE sales SET amount_paid = ?, balance_due = ?, status = ? WHERE id = ?");
        $upd->execute([$paid, $balance, $status, $sale_id]);
    }
}
