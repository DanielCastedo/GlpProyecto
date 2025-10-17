<?php
namespace Controllers;
use Core\Controller;
use Models\Route;

class RouteController extends Controller {
    private Route $model;
    public function __construct() { $this->model = new Route(); }
    public function index() { $items = $this->model->all(); $this->render('routes/index', compact('items')); }
    public function create() { $this->render('routes/create'); }
    public function store() { $this->model->create($_POST); $this->redirect($this->baseUrl() . '/routes'); }
    public function edit() { $item = $this->model->find((int)($_GET['id'] ?? 0)); $this->render('routes/edit', compact('item')); }
    public function update() { $this->model->update((int)$_POST['id'], $_POST); $this->redirect($this->baseUrl() . '/routes'); }
    public function destroy() { $this->model->delete((int)$_POST['id']); $this->redirect($this->baseUrl() . '/routes'); }
}
