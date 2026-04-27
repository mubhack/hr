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
    <h1>Dashboard</h1>

    <?php if ($_SESSION['role'] === 'hr'): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div class="card">
                <h3 style="margin:0">Total Employees</h3>
                <p style="font-size: 2rem; font-weight: 800; color: var(--primary)"><?= $data['emp_count'] ?></p>
            </div>
            <div class="card">
                <h3 style="margin:0">Pending Leaves</h3>
                <p style="font-size: 2rem; font-weight: 800; color: var(--warning)"><?= $data['pending_leaves'] ?></p>
            </div>
            <div class="card">
                <h3 style="margin:0">Expired Docs</h3>
                <p style="font-size: 2rem; font-weight: 800; color: var(--danger)"><?= $data['expired_docs'] ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="card" style="margin-bottom: 2rem;">
            <h2>Welcome, <?= $data['employee']['name'] ?? $_SESSION['username'] ?></h2>
            <p>Designation: <?= $data['employee']['designation'] ?? 'N/A' ?></p>
        </div>

        <?php if ($data['employee']): ?>
            <div class="card">
                <h3>Your Document Status</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Expiry Date</th>
                                <th>Status/Alert</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Passport</td>
                                <td><?= $data['employee']['passport_expiry_date'] ?></td>
                                <td><span class="badge <?= getExpiryClass($data['employee']['passport_expiry_date']) ?>">Alert</span></td>
                            </tr>
                            <tr>
                                <td>Visa</td>
                                <td><?= $data['employee']['visa_expiry'] ?></td>
                                <td><span class="badge <?= getExpiryClass($data['employee']['visa_expiry']) ?>">Alert</span></td>
                            </tr>
                            <tr>
                                <td>Insurance (ILOE)</td>
                                <td><?= $data['employee']['iloe_insurance_exp'] ?></td>
                                <td><span class="badge <?= getExpiryClass($data['employee']['iloe_insurance_exp']) ?>">Alert</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require_once '../resources/views/layout/footer.php'; ?>