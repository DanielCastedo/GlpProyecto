<?php

namespace Controllers;

use Core\Controller;
use Models\Driver;

class DriverController extends Controller
{
    private Driver $model;
    public function __construct()
    {
        $this->model = new Driver();
    }
    public function index()
    {
        $items = $this->model->all();
        $this->render('drivers/index', compact('items'));
    }
    public function create()
    {
        $trucks = (new \Models\Truck())->all();
        $this->render('drivers/create', compact('trucks'));
    }
    public function store()
    {
        $this->model->create($_POST);
        $this->redirect($this->baseUrl() . '/drivers');
    }
    public function edit()
    {
        $item = $this->model->find((int)($_GET['id'] ?? 0));
        $this->render('drivers/edit', compact('item'));
    }
    public function update()
    {
        $this->model->update((int)$_POST['id'], $_POST);
        $this->redirect($this->baseUrl() . '/drivers');
    }
    public function destroy()
    {
        $this->model->delete((int)$_POST['id']);
        $this->redirect($this->baseUrl() . '/drivers');
    }
}
