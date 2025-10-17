<?php
namespace Controllers;
use Core\Controller;
use Models\Product;

class ProductController extends Controller {
    private Product $model;
    public function __construct() { $this->model = new Product(); }
    public function index() { $items = $this->model->all(); $this->render('products/index', compact('items')); }
    public function create() { $this->render('products/create'); }
    public function store() { $this->model->create($_POST); $this->redirect($this->baseUrl() . '/products'); }
    public function edit() { $item = $this->model->find((int)($_GET['id'] ?? 0)); $this->render('products/edit', compact('item')); }
    public function update() { $this->model->update((int)$_POST['id'], $_POST); $this->redirect($this->baseUrl() . '/products'); }
    public function destroy() { $this->model->delete((int)$_POST['id']); $this->redirect($this->baseUrl() . '/products'); }
}
