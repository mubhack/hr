<?php require_once '../resources/views/layout/header.php'; ?>

<div style="max-width: 400px; margin: 60px auto;">
    <div class="card fade-in">
        <h2 style="text-align: center;">Join HR portal</h2>

        <?php if ($data['error']): ?>
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); padding: 10px; border-radius: 5px; margin-bottom: 20px; color: #ff8080;">
                <?= $data['error'] ?>
            </div>
        <?php endif; ?>

        <?php if ($data['success']): ?>
            <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid var(--success); padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <?= $data['success'] ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Choose a username">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="employee">Employee</option>
                    <option value="hr">HR Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>
            <p style="text-align: center; margin-top: 20px; color: var(--text-muted); font-size: 0.875rem;">
                Already have an account? <a href="<?= BASE_URL ?>auth/login" style="color: var(--primary); text-decoration: none;">Login here</a>
            </p>
        </form>
    </div>
</div>

<?php require_once '../resources/views/layout/footer.php'; ?>