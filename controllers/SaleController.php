<?php
namespace Controllers;

use Core\Controller;
use Models\Sale;

class SaleController extends Controller {
    private Sale $model;
    public function __construct(){ $this->model = new Sale(); }

    public function index(){ 
        $items = $this->model->all(); 
        $this->render('sales/index', compact('items')); 
    }

    public function create(){ 
        $this->render('sales/create'); 
    }

    public function store(){ 
        // Default numbers si no vienen
        $_POST['total'] = $_POST['total'] ?? 0;
        $_POST['amount_paid'] = $_POST['amount_paid'] ?? 0;
        $_POST['balance_due'] = $_POST['balance_due'] ?? 0;
        $_POST['status'] = $_POST['status'] ?? 'pending';

        $id = $this->model->create($_POST); 
        $this->redirect($this->baseUrl() . '/sales/edit?id=' . $id);
    }

    public function edit(){ 
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id); 
        if (!$item) { echo "<p>Venta no encontrada</p>"; return; }
        $this->render('sales/edit', compact('item')); 
    }

    public function update(){ 
        $id = (int)$_POST['id'];
        $this->model->update($id, $_POST); 
        $this->redirect($this->baseUrl() . '/sales');
    }

    public function destroy(){ 
        $id = (int)$_POST['id']; 
        $this->model->delete($id); 
        $this->redirect($this->baseUrl() . '/sales');
    }
}
