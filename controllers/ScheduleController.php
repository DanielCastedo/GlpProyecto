<?php
namespace Controllers;

use Core\Controller;
use Core\Database;
use Models\Schedule;
use Models\Route;

class ScheduleController extends Controller {
    private Schedule $model;

    public function __construct(){
        $this->model = new Schedule();
    }

    public function index(){
        $pdo = Database::pdo();
        $query = "
            SELECT s.*, r.name AS route_name
            FROM schedules s
            JOIN routes r ON r.id = s.route_id
            ORDER BY r.name, s.day_of_week
        ";
        $items = $pdo->query($query)->fetchAll();
        $this->render('schedules/index', compact('items'));
    }

    public function create(){
        $routes = (new Route())->all();
        $this->render('schedules/create', compact('routes'));
    }

    public function store(){
        $this->model->create($_POST);
        $this->redirect($this->baseUrl() . '/schedules');
    }

    public function edit(){
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model->find($id);
        if (!$item) { echo "<p>Horario no encontrado</p>"; return; }
        $routes = (new Route())->all();
        $this->render('schedules/edit', compact('item','routes'));
    }

    public function update(){
        $id = (int)$_POST['id'];
        $this->model->update($id, $_POST);
        $this->redirect($this->baseUrl() . '/schedules');
    }

    public function destroy(){
        $id = (int)$_POST['id'];
        $this->model->delete($id);
        $this->redirect($this->baseUrl() . '/schedules');
    }
}
