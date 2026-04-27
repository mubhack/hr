<?php require_once '../resources/views/layout/header.php'; ?>

<div class="fade-in">
    <h1>Leave Management</h1>

    <?php if ($data['message']): ?>
        <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid var(--success); padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <?= $data['message'] ?>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['role'] !== 'hr'): ?>
        <div class="card" style="margin-bottom: 3rem;">
            <h3>Apply for Leave</h3>
            <form method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Leave Type</label>
                        <select name="leave_type">
                            <option>Annual Leave</option>
                            <option>Sick Leave</option>
                            <option>Emergency Leave</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Start Date</label><input type="date" name="start_date" required></div>
                    <div class="form-group"><label>End Date</label><input type="date" name="end_date" required></div>
                </div>
                <div class="form-group"><label>Reason</label><textarea name="reason" rows="3"></textarea></div>
                <button type="submit" name="apply_leave" class="btn btn-primary">Apply Leave</button>
            </form>
        </div>
    <?php endif; ?>

    <div class="card table-container">
        <h3><?= ($_SESSION['role'] === 'hr') ? 'All Leave Requests' : 'Your Leave History' ?></h3>
        <table>
            <thead>
                <tr>
                    <?php if ($_SESSION['role'] === 'hr'): ?><th>Employee</th><?php endif; ?>
                    <th>Type</th>
                    <th>Dates</th>
                    <th>Status</th>
                    <?php if ($_SESSION['role'] === 'hr'): ?><th>Action</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['leaves'] as $leave): ?>
                    <tr>
                        <?php if ($_SESSION['role'] === 'hr'): ?><td><?= $leave['employee_name'] ?></td><?php endif; ?>
                        <td><?= $leave['leave_type'] ?></td>
                        <td><?= $leave['start_date'] ?> to <?= $leave['end_date'] ?></td>
                        <td>
                            <span class="badge <?= $leave['status'] === 'Approved' ? 'badge-success' : ($leave['status'] === 'Rejected' ? 'badge-expired' : 'badge-warning') ?>">
                                <?= $leave['status'] ?>
                            </span>
                        </td>
                        <?php if ($_SESSION['role'] === 'hr'): ?>
                            <td>
                                <form method="POST" style="display: flex; gap: 5px;">
                                    <input type="hidden" name="leave_id" value="<?= $leave['id'] ?>">
                                    <select name="status" style="padding: 2px 5px; width: auto;">
                                        <option value="Approved">Approve</option>
                                        <option value="Rejected">Reject</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-primary" style="padding: 2px 10px; font-size: 0.75rem;">Set</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../resources/views/layout/footer.php'; ?>