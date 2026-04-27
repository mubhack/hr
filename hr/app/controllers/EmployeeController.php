<?php

require_once '../app/middleware/AuthMiddleware.php';

class EmployeeController extends Controller
{
    public function index()
    {
        AuthMiddleware::isAdmin();
        $empModel = $this->model('Employee');

        $message = '';
        if (isset($_GET['delete'])) {
            $empModel->delete($_GET['delete']);
            $message = "Employee deleted.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                $_POST['name'],
                $_POST['designation'],
                $_POST['gender'],
                $_POST['salary'],
                $_POST['date_of_joining'],
                $_POST['nationality'],
                $_POST['passport_no'],
                $_POST['passport_issue_date'],
                $_POST['passport_expiry_date'],
                $_POST['labour_card'],
                $_POST['eid_no'],
                $_POST['visa_stamping'],
                $_POST['visa_expiry'],
                $_POST['iloe_insurance_exp'],
                $_POST['medical_insurance_exp'],
                $_POST['bank_acct'],
                $_POST['mob_no'],
                $_POST['email_id'],
                isset($_POST['resigned']) ? 1 : 0,
                isset($_POST['terminated']) ? 1 : 0,
                $_POST['esob']
            ];

            if (!empty($_POST['id'])) {
                $empModel->update($_POST['id'], $data);
                $message = "Employee updated.";
            } else {
                $id = $empModel->create($data);
                $userModel = $this->model('User');
                $username = strtolower(str_replace(' ', '', $_POST['name'])) . $id;
                $password = password_hash('welcome123', PASSWORD_DEFAULT);
                $userModel->create($username, $password, 'employee', $id);
                $message = "Employee added. Username: $username";
            }
        }

        $this->view('employees/index', [
            'employees' => $empModel->getAll(),
            'message' => $message
        ]);
    }
}
