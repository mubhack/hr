<?php

class AuthController extends Controller
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->getByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['employee_id'] = $user['employee_id'];
                $this->redirect('dashboard');
            } else {
                $error = "Invalid username or password.";
            }
        }

        $this->view('auth/login', ['error' => $error]);
    }

    public function register()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $error = "Passwords do not match.";
            } else {
                if ($userModel->getByUsername($_POST['username'])) {
                    $error = "Username already exists.";
                } else {
                    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $role = $_POST['role'];
                    $emp_id = null;

                    if ($role === 'employee') {
                        $empModel = $this->model('Employee');
                        $emp_id = $empModel->create([$_POST['username'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 0, 0, 0]);
                    }

                    $userModel->create($_POST['username'], $hashed, $role, $emp_id);
                    $success = "Registration successful! You can now login.";
                }
            }
        }

        $this->view('auth/register', ['error' => $error, 'success' => $success]);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('auth/login');
    }
}
