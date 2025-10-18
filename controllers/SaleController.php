<?php

namespace Controllers;

use Core\Controller;
use Models\Sale;

class SaleController extends Controller
{
    private Sale $model;
    public function __construct()
    {
        $this->model = new Sale();
    }

    public function index()
    {
        $items = $this->model->all();
        $this->render('sales/index', compact('items'));
    }

    public function create()
    {
        $drivers = (new \Models\Driver())->all();
        $routes = (new \Models\Route())->all();
        $this->render('sales/create', compact('drivers', 'routes'));
    }

    public function store()
    {
        // Default numbers si no vienen
        $_POST['total'] = $_POST['total'] ?? 0;
        $_POST['amount_paid'] = $_POST['amount_paid'] ?? 0;
        $_POST['balance_due'] = $_POST['balance_due'] ?? ($_POST['total'] - $_POST['amount_paid']);

        // Estado según saldo
        $total = floatval($_POST['total']);
        $balance_due = floatval($_POST['balance_due']);
        $_POST['status'] = ($balance_due == 0 && $total > 0) ? 'paid' : 'pending';

        $id = $this->model->create($_POST);
        $this->redirect($this->baseUrl() . '/sales');
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) {
            echo "<p>Venta no encontrada</p>";
            return;
        }
        $drivers = (new \Models\Driver())->all();
        $routes = (new \Models\Route())->all();
        $this->render('sales/edit', compact('item', 'drivers', 'routes'));
    }

    public function update()
    {
        $id = (int)$_POST['id'];

        // Estado según saldo
        $total = floatval($_POST['total'] ?? 0);
        $amount_paid = floatval($_POST['amount_paid'] ?? 0);
        $balance_due = floatval($_POST['balance_due'] ?? ($total - $amount_paid));
        $_POST['status'] = ($balance_due == 0 && $total > 0) ? 'completado' : 'pending';

        $this->model->update($id, $_POST);
        $this->redirect($this->baseUrl() . '/sales');
    }

    public function destroy()
    {
        $id = (int)$_POST['id'];
        $this->model->delete($id);
        $this->redirect($this->baseUrl() . '/sales');
    }
}
