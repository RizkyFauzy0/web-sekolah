<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);
        
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist: ' . $view);
        }
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['admin_id']);
    }

    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
    }

    protected function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
