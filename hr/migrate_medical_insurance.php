<?php
// Database migration script - Run this once to add medical_insurance_exp column

$host = 'localhost';
$db   = 'hr_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if column already exists
    $stmt = $pdo->query("SHOW COLUMNS FROM employees LIKE 'medical_insurance_exp'");
    $exists = $stmt->fetch();

    if (!$exists) {
        // Add the column
        $pdo->exec("ALTER TABLE employees ADD COLUMN `medical_insurance_exp` DATE AFTER `iloe_insurance_exp`");
        echo "✅ Success! Column 'medical_insurance_exp' has been added to the employees table.";
    } else {
        echo "ℹ️ Column 'medical_insurance_exp' already exists.";
    }
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
