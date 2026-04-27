<?php require_once '../resources/views/layout/header.php'; ?>

<div style="max-width: 400px; margin: 100px auto;">
    <div class="card fade-in">
        <h2 style="text-align: center;">Welcome Back</h2>
        <?php if ($data['error']): ?>
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); padding: 10px; border-radius: 5px; margin-bottom: 20px; color: #ff8080;">
                <?= $data['error'] ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            <p style="text-align: center; margin-top: 20px; color: var(--text-muted); font-size: 0.875rem;">
                Don't have an account? <a href="<?= BASE_URL ?>auth/register" style="color: var(--primary); text-decoration: none;">Register here</a>
            </p>
        </form>
    </div>
</div>

<?php require_once '../resources/views/layout/footer.php'; ?>