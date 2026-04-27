<?php

class Employee extends Model
{
    public function getAll()
    {
        return $this->db->query("SELECT * FROM employees ORDER BY id DESC")->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO employees (`name`, `designation`, `gender`, `salary`, `date_of_joining`, `nationality`, `passport_no`, `passport_issue_date`, `passport_expiry_date`, `labour_card`, `eid_no`, `visa_stamping`, `visa_expiry`, `iloe_insurance_exp`, `medical_insurance_exp`, `bank_acct`, `mob_no`, `email_id`, `resigned`, `terminated`, `esob`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $data[] = $id;
        $sql = "UPDATE employees SET `name`=?, `designation`=?, `gender`=?, `salary`=?, `date_of_joining`=?, `nationality`=?, `passport_no`=?, `passport_issue_date`=?, `passport_expiry_date`=?, `labour_card`=?, `eid_no`=?, `visa_stamping`=?, `visa_expiry`=?, `iloe_insurance_exp`=?, `medical_insurance_exp`=?, `bank_acct`=?, `mob_no`=?, `email_id`=?, `resigned`=?, `terminated`=?, `esob`=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM employees WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getExpiredCount($today)
    {
        return $this->db->query("SELECT COUNT(*) FROM employees WHERE passport_expiry_date < '$today' OR visa_expiry < '$today' OR iloe_insurance_exp < '$today' OR medical_insurance_exp < '$today'")->fetchColumn();
    }

    public function getCount()
    {
        return $this->db->query("SELECT COUNT(*) FROM employees")->fetchColumn();
    }
}
