<?php

class User extends Model
{
    public function getByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function create($username, $password, $role, $employee_id = null)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, employee_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $password, $role, $employee_id]);
    }
}
