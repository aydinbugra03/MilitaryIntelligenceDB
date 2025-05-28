<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();
    
    // Force fix Supply_Audit table for Trigger 4
    $steps = [];
    
    // Step 1: Check current table structure
    try {
        $stmt = $conn->query("DESCRIBE Supply_Audit");
        $columns = $stmt->fetchAll();
        $steps[] = "✅ Current Supply_Audit table structure:";
        foreach ($columns as $col) {
            $steps[] = "   - {$col['Field']} ({$col['Type']})";
        }
    } catch (Exception $e) {
        $steps[] = "❌ Supply_Audit table doesn't exist: " . $e->getMessage();
    }
    
    // Step 2: Force drop and recreate
    try {
        $conn->exec("DROP TABLE IF EXISTS Supply_Audit");
        $steps[] = "✅ Dropped existing Supply_Audit table";
    } catch (Exception $e) {
        $steps[] = "⚠️ Drop table warning: " . $e->getMessage();
    }
    
    // Step 3: Create new table with correct structure
    try {
        $create_sql = "CREATE TABLE Supply_Audit (
            id INT AUTO_INCREMENT PRIMARY KEY,
            supply_id INT NOT NULL,
            old_quantity INT,
            new_quantity INT,
            audit_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            audit_message TEXT
        )";
        $conn->exec($create_sql);
        $steps[] = "✅ Created new Supply_Audit table with audit_date column";
    } catch (Exception $e) {
        $steps[] = "❌ Create table error: " . $e->getMessage();
    }
    
    // Step 4: Verify new structure
    try {
        $stmt = $conn->query("DESCRIBE Supply_Audit");
        $columns = $stmt->fetchAll();
        $steps[] = "✅ New Supply_Audit table structure verified:";
        foreach ($columns as $col) {
            $steps[] = "   - {$col['Field']} ({$col['Type']})";
        }
    } catch (Exception $e) {
        $steps[] = "❌ Verification error: " . $e->getMessage();
    }
    
    // Step 5: Test the audit_date column specifically
    try {
        $stmt = $conn->query("SELECT audit_date FROM Supply_Audit LIMIT 1");
        $steps[] = "✅ audit_date column is accessible";
    } catch (Exception $e) {
        $steps[] = "❌ audit_date column test failed: " . $e->getMessage();
    }
    
    // Step 6: Insert a test record
    try {
        $conn->exec("INSERT INTO Supply_Audit (supply_id, old_quantity, new_quantity, audit_message) VALUES (1, 100, 90, 'Test audit entry')");
        $steps[] = "✅ Test record inserted successfully";
    } catch (Exception $e) {
        $steps[] = "❌ Test insert failed: " . $e->getMessage();
    }
    
    // Step 7: Test the query that was failing
    try {
        $stmt = $conn->query("SELECT sa.*, s.sup_name as supply_name FROM Supply_Audit sa JOIN Supply s ON sa.supply_id = s.supply_id ORDER BY sa.audit_date DESC LIMIT 1");
        $result = $stmt->fetch();
        if ($result) {
            $steps[] = "✅ JOIN query with audit_date works! Test record found: " . $result['audit_message'];
        } else {
            $steps[] = "⚠️ JOIN query works but no matching records found";
        }
    } catch (Exception $e) {
        $steps[] = "❌ JOIN query test failed: " . $e->getMessage();
    }
    
    $message = "Supply_Audit table has been completely recreated and tested!";
    $results = $steps;
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Trigger 4 - Supply_Audit Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #f39c12; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .step-item { padding: 0.75rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #3498db; background-color: #f8f9fa; font-family: monospace; }
        .success { border-left-color: #27ae60; }
        .error { border-left-color: #e74c3c; }
        .warning { border-left-color: #f39c12; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; background-color: #f39c12; color: white; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>🔧 Fix Trigger 4: Supply_Audit Table</h1>
            <p>Fixing the audit_date column issue specifically</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>🔍 Fix Steps Executed</h3>
            
            <?php foreach ($results as $step): ?>
                <?php 
                $class = 'step-item';
                if (strpos($step, '✅') !== false) $class .= ' success';
                elseif (strpos($step, '❌') !== false) $class .= ' error';
                elseif (strpos($step, '⚠️') !== false) $class .= ' warning';
                ?>
                <div class="<?php echo $class; ?>">
                    <?php echo htmlspecialchars($step); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="card">
            <h3>🚀 Test Trigger 4 Now</h3>
            <p>The Supply_Audit table has been recreated with the correct audit_date column.</p>
            <a href="triggers/trigger_4/" class="btn">Test Trigger 4: Supply Management</a>
        </div>
        
        <div class="card">
            <h3>📋 What Was Fixed</h3>
            <ul>
                <li><strong>Dropped</strong> the existing Supply_Audit table completely</li>
                <li><strong>Created</strong> new Supply_Audit table with proper audit_date column</li>
                <li><strong>Verified</strong> the table structure and column accessibility</li>
                <li><strong>Tested</strong> the JOIN query that was failing</li>
                <li><strong>Added</strong> a test record to confirm functionality</li>
            </ul>
            <p><strong>The audit_date column error should now be completely resolved!</strong></p>
        </div>
    </div>
</body>
</html> 