<?php

require_once '../app/middleware/AuthMiddleware.php';

class LeaveController extends Controller
{
    public function index()
    {
        AuthMiddleware::check();
        $leaveModel = $this->model('Leave');
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['apply_leave'])) {
                $leaveModel->create([$_SESSION['employee_id'], $_POST['leave_type'], $_POST['start_date'], $_POST['end_date'], $_POST['reason']]);
                $message = "Leave application submitted.";
            }
            if (isset($_POST['update_status']) && $_SESSION['role'] === 'hr') {
                $leaveModel->updateStatus($_POST['leave_id'], $_POST['status']);
                $message = "Status updated.";
            }
        }

        $leaves = ($_SESSION['role'] === 'hr') ? $leaveModel->getAll() : $leaveModel->getByEmployee($_SESSION['employee_id']);

        $this->view('leaves/index', [
            'leaves' => $leaves,
            'message' => $message
        ]);
    }
}
