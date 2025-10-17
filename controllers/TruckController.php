<?php
namespace Controllers;
use Core\Controller;
use Models\Truck;

class TruckController extends Controller {
    private Truck $model;
    public function __construct() { $this->model = new Truck(); }
    public function index() { $items = $this->model->all(); $this->render('trucks/index', compact('items')); }
    public function create() { $this->render('trucks/create'); }
    public function store() { $this->model->create($_POST); $this->redirect($this->baseUrl() . '/trucks'); }
    public function edit() { $item = $this->model->find((int)($_GET['id'] ?? 0)); $this->render('trucks/edit', compact('item')); }
    public function update() { $this->model->update((int)$_POST['id'], $_POST); $this->redirect($this->baseUrl() . '/trucks'); }
    public function destroy() { $this->model->delete((int)$_POST['id']); $this->redirect($this->baseUrl() . '/trucks'); }
}
