<?php
namespace Controllers;
use Core\Controller;
use Models\Product;

class ProductController extends Controller {
    private Product $model;
    public function __construct() { $this->model = new Product(); }

    //MOSTRAR. VISTA DE LISTA
    public function index() { $items = $this->model->all(); $this->render('products/index', compact('items')); }

    //MOSTRAR VISTA O FORMULARIO
    public function create() { $this->render('products/create'); }

    //GUARDAR DATOS
    public function store() { $this->model->create($_POST); $this->redirect($this->baseUrl() . '/products'); }

    //MOSTRAR FORMULARIO DE EDICION
    public function edit() { $item = $this->model->find((int)($_GET['id'] ?? 0)); $this->render('products/edit', compact('item')); }

    //ACTUALIZAR DATOS
    public function update() { $this->model->update((int)$_POST['id'], $_POST); $this->redirect($this->baseUrl() . '/products'); }

    //ELIMINAR DATOS
    public function destroy() { $this->model->delete((int)$_POST['id']); $this->redirect($this->baseUrl() . '/products'); }
}
