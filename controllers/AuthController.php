<?php
namespace Controllers;

use Core\Controller;
use Models\User;

class AuthController extends Controller {
    private User $userModel;

    public function __construct(){
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Mostrar formulario de login
    public function loginForm(){
        if (!empty($_SESSION['user'])) {
            $this->redirect($this->baseUrl() . '/');
            exit;
        }
        $this->render('auth/login');
    }

    // Procesar login
    public function login(){
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            $this->redirect($this->baseUrl() . '/');
        } else {
            $error = "Credenciales inválidas";
            $this->render('auth/login', compact('error'));
        }
    }

    // Cerrar sesión
    public function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        $this->redirect($this->baseUrl() . '/login');
    }

    // Perfil de usuario
    public function profile(){
        if (empty($_SESSION['user'])) {
            $this->redirect($this->baseUrl() . '/login');
            return;
        }

        $user = $this->userModel->find($_SESSION['user']['id']);
        $this->render('auth/profile', compact('user'));
    }

    // Actualizar perfil
    public function updateProfile(){
        if (empty($_SESSION['user'])) {
            $this->redirect($this->baseUrl() . '/login');
            return;
        }

        $id = $_SESSION['user']['id'];
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email']
        ];

        if (!empty($_POST['password'])) {
            $data['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        // Actualizar sesión con nuevos datos
        $_SESSION['user']['name'] = $data['name'];
        $_SESSION['user']['email'] = $data['email'];

        $this->redirect($this->baseUrl() . '/profile');
    }
}
