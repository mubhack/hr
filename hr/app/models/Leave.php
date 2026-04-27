<?php

class Leave extends Model
{
    public function getAll()
    {
        return $this->db->query("SELECT l.*, e.name as employee_name FROM leaves l JOIN employees e ON l.employee_id = e.id ORDER BY applied_at DESC")->fetchAll();
    }

    public function getByEmployee($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM leaves WHERE employee_id = ? ORDER BY applied_at DESC");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO leaves (employee_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute($data);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE leaves SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function getPendingCount()
    {
        return $this->db->query("SELECT COUNT(*) FROM leaves WHERE status = 'Pending'")->fetchColumn();
    }
}
