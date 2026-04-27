<?php require_once '../resources/views/layout/header.php'; ?>

<?php
function getExpiryClass($date)
{
    if (!$date) return '';
    $expiry = new DateTime($date);
    $now = new DateTime();
    $diff = $now->diff($expiry);

    if ($expiry < $now) return 'badge-expired';
    if ($diff->days <= 30) return 'badge-warning';
    return 'badge-success';
}
?>

<div class="fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Employee Management</h1>
        <button onclick="resetForm(); document.getElementById('empForm').style.display='block'" class="btn btn-primary">Add New Employee</button>
    </div>

    <?php if ($data['message']): ?>
        <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid var(--success); padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <?= $data['message'] ?>
        </div>
    <?php endif; ?>

    <!-- Simple Add Form Overlay -->
    <div id="empForm" class="card" style="display: none; margin-bottom: 3rem; background: rgba(15, 23, 42, 0.95);">
        <h3>Employee Details</h3>
        <form method="POST">
            <input type="hidden" name="id" id="form_id">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group"><label>Full Name</label><input type="text" name="name" id="form_name" required></div>
                <div class="form-group"><label>Designation</label><input type="text" name="designation" id="form_designation"></div>
                <div class="form-group"><label>Gender</label><select name="gender" id="form_gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select></div>
                <div class="form-group"><label>Salary</label><input type="number" name="salary" id="form_salary"></div>
                <div class="form-group"><label>Date of Joining</label><input type="date" name="date_of_joining" id="form_doj"></div>
                <div class="form-group"><label>Nationality</label><input type="text" name="nationality" id="form_nat"></div>
                <div class="form-group"><label>Passport No.</label><input type="text" name="passport_no" id="form_pass"></div>
                <div class="form-group"><label>Passport Issue</label><input type="date" name="passport_issue_date" id="form_pass_issue"></div>
                <div class="form-group"><label>Passport Expiry</label><input type="date" name="passport_expiry_date" id="form_pass_exp"></div>
                <div class="form-group"><label>Labour Card</label><input type="text" name="labour_card" id="form_labour"></div>
                <div class="form-group"><label>EID NO.</label><input type="text" name="eid_no" id="form_eid"></div>
                <div class="form-group"><label>Visa Stamping</label><input type="date" name="visa_stamping" id="form_visa_stamp"></div>
                <div class="form-group"><label>Visa Expiry</label><input type="date" name="visa_expiry" id="form_visa_exp"></div>
                <div class="form-group"><label>ILOE Ins. Exp</label><input type="date" name="iloe_insurance_exp" id="form_iloe"></div>
                <div class="form-group"><label>Medical Ins. Exp</label><input type="date" name="medical_insurance_exp" id="form_medical"></div>
                <div class="form-group"><label>Bank Acct</label><input type="text" name="bank_acct" id="form_bank"></div>
                <div class="form-group"><label>Mob No.</label><input type="text" name="mob_no" id="form_mob"></div>
                <div class="form-group"><label>Email ID</label><input type="email" name="email_id" id="form_email"></div>
                <div class="form-group"><label>ESOB</label><input type="number" name="esob" id="form_esob" step="0.01"></div>
            </div>
            <div style="margin-top: 1rem;">
                <label><input type="checkbox" name="resigned" id="form_resigned"> Resigned</label>
                <label><input type="checkbox" name="terminated" id="form_terminated"> Terminated</label>
            </div>
            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" name="save_employee" class="btn btn-primary">Save Employee</button>
                <button type="button" onclick="document.getElementById('empForm').style.display='none'" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>

    <div class="card table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Passport Exp</th>
                    <th>Visa Exp</th>
                    <th>ILOE Exp</th>
                    <th>Medical Ins</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['employees'] as $emp): ?>
                    <tr>
                        <td><?= $emp['name'] ?></td>
                        <td><?= $emp['designation'] ?></td>
                        <td><span class="badge <?= getExpiryClass($emp['passport_expiry_date']) ?>"><?= $emp['passport_expiry_date'] ?></span></td>
                        <td><span class="badge <?= getExpiryClass($emp['visa_expiry']) ?>"><?= $emp['visa_expiry'] ?></span></td>
                        <td><span class="badge <?= getExpiryClass($emp['iloe_insurance_exp']) ?>"><?= $emp['iloe_insurance_exp'] ?></span></td>
                        <td><span class="badge <?= getExpiryClass($emp['medical_insurance_exp']) ?>"><?= $emp['medical_insurance_exp'] ?></span></td>
                        <td>
                            <?php if ($emp['resigned']) echo '<span class="badge badge-expired">Resigned</span>'; ?>
                            <?php if ($emp['terminated']) echo '<span class="badge badge-expired">Terminated</span>'; ?>
                            <?php if (!$emp['resigned'] && !$emp['terminated']) echo '<span class="badge badge-success">Active</span>'; ?>
                        </td>
                        <td>
                            <button onclick='editEmployee(<?= json_encode($emp) ?>)' class="btn btn-primary" style="padding: 2px 10px; font-size: 0.75rem;">Edit</button>
                            <a href="<?= BASE_URL ?>employee/index?delete=<?= $emp['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" style="padding: 2px 10px; font-size: 0.75rem;">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function editEmployee(emp) {
        document.getElementById('empForm').style.display = 'block';
        document.getElementById('form_id').value = emp.id;
        document.getElementById('form_name').value = emp.name;
        document.getElementById('form_designation').value = emp.designation;
        document.getElementById('form_gender').value = emp.gender;
        document.getElementById('form_salary').value = emp.salary;
        document.getElementById('form_doj').value = emp.date_of_joining;
        document.getElementById('form_nat').value = emp.nationality;
        document.getElementById('form_pass').value = emp.passport_no;
        document.getElementById('form_pass_issue').value = emp.passport_issue_date;
        document.getElementById('form_pass_exp').value = emp.passport_expiry_date;
        document.getElementById('form_labour').value = emp.labour_card;
        document.getElementById('form_eid').value = emp.eid_no;
        document.getElementById('form_visa_stamp').value = emp.visa_stamping;
        document.getElementById('form_visa_exp').value = emp.visa_expiry;
        document.getElementById('form_iloe').value = emp.iloe_insurance_exp;
        document.getElementById('form_medical').value = emp.medical_insurance_exp;
        document.getElementById('form_bank').value = emp.bank_acct;
        document.getElementById('form_mob').value = emp.mob_no;
        document.getElementById('form_email').value = emp.email_id;
        document.getElementById('form_esob').value = emp.esob;
        document.getElementById('form_resigned').checked = emp.resigned == 1;
        document.getElementById('form_terminated').checked = emp.terminated == 1;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function resetForm() {
        document.getElementById('form_id').value = '';
        document.querySelector('#empForm form').reset();
    }
</script>

<?php require_once '../resources/views/layout/footer.php'; ?>