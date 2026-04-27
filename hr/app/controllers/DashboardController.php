<?php

require_once '../app/middleware/AuthMiddleware.php';

class DashboardController extends Controller
{
    public function index()
    {
        AuthMiddleware::check();

        $empModel = $this->model('Employee');
        $leaveModel = $this->model('Leave');

        $data = [
            'emp_count' => $empModel->getCount(),
            'pending_leaves' => $leaveModel->getPendingCount(),
            'expired_docs' => $empModel->getExpiredCount(date('Y-m-d')),
            'employee' => null
        ];

        if ($_SESSION['role'] !== 'hr') {
            $data['employee'] = $empModel->getById($_SESSION['employee_id']);
        }

        $this->view('dashboard/index', $data);
    }
}
