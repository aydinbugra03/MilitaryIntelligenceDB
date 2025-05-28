<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$tests = [];

try {
    $conn = getMySQLConnection();
    
    // Test 1: Check Operator table structure
    try {
        $stmt = $conn->query("SELECT op_id, `rank` FROM Operator LIMIT 1");
        $result = $stmt->fetch();
        $tests['Operator Table'] = $result ? '✅ OK' : '⚠️ No data';
    } catch (Exception $e) {
        $tests['Operator Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 2: Check Agents table structure
    try {
        $stmt = $conn->query("SELECT agent_id, name, `rank` FROM Agents LIMIT 1");
        $result = $stmt->fetch();
        $tests['Agents Table'] = $result ? '✅ OK' : '⚠️ No data';
    } catch (Exception $e) {
        $tests['Agents Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 3: Check Drones table structure
    try {
        $stmt = $conn->query("SELECT drone_id, model, op_id FROM Drones LIMIT 1");
        $result = $stmt->fetch();
        $tests['Drones Table'] = $result ? '✅ OK' : '⚠️ No data';
    } catch (Exception $e) {
        $tests['Drones Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 4: Check Intelligence_Reports table structure
    try {
        $stmt = $conn->query("SELECT report_id, title, date_created, agent_id FROM Intelligence_Reports LIMIT 1");
        $result = $stmt->fetch();
        $tests['Intelligence_Reports Table'] = $result ? '✅ OK' : '⚠️ No data';
    } catch (Exception $e) {
        $tests['Intelligence_Reports Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 5: Check Supply table structure
    try {
        $stmt = $conn->query("SELECT supply_id, sup_name, type, quantity FROM Supply LIMIT 1");
        $result = $stmt->fetch();
        $tests['Supply Table'] = $result ? '✅ OK' : '⚠️ No data';
    } catch (Exception $e) {
        $tests['Supply Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 6: Check DroneStatus table (for triggers)
    try {
        $stmt = $conn->query("SELECT id, drone_id, old_operator_id, new_operator_id FROM DroneStatus LIMIT 1");
        $result = $stmt->fetch();
        $tests['DroneStatus Table'] = $result ? '✅ OK' : '⚠️ No data (normal for new setup)';
    } catch (Exception $e) {
        $tests['DroneStatus Table'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 7: Test JOIN query (Drones with Operators)
    try {
        $stmt = $conn->query("SELECT d.drone_id, d.model, d.op_id, o.`rank` FROM Drones d JOIN Operator o ON d.op_id = o.op_id LIMIT 1");
        $result = $stmt->fetch();
        $tests['Drones-Operator JOIN'] = $result ? '✅ OK' : '⚠️ No matching data';
    } catch (Exception $e) {
        $tests['Drones-Operator JOIN'] = '❌ Error: ' . $e->getMessage();
    }
    
    // Test 8: Test JOIN query (Intelligence_Reports with Agents)
    try {
        $stmt = $conn->query("SELECT ir.report_id, ir.title, a.name, a.`rank` FROM Intelligence_Reports ir JOIN Agents a ON ir.agent_id = a.agent_id LIMIT 1");
        $result = $stmt->fetch();
        $tests['Reports-Agents JOIN'] = $result ? '✅ OK' : '⚠️ No matching data';
    } catch (Exception $e) {
        $tests['Reports-Agents JOIN'] = '❌ Error: ' . $e->getMessage();
    }
    
    $message = "Database structure tests completed!";
    
} catch (Exception $e) {
    $message = "Connection Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Structure Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #2c3e50; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .test-item { padding: 1rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #3498db; background-color: #f8f9fa; }
        .success { border-left-color: #27ae60; }
        .warning { border-left-color: #f39c12; }
        .error { border-left-color: #e74c3c; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>Database Structure Test</h1>
            <p>Testing database tables and column structures</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>🔍 Database Structure Tests</h3>
            
            <?php foreach ($tests as $testName => $result): ?>
                <?php 
                $class = 'test-item';
                if (strpos($result, '✅') !== false) $class .= ' success';
                elseif (strpos($result, '⚠️') !== false) $class .= ' warning';
                elseif (strpos($result, '❌') !== false) $class .= ' error';
                ?>
                <div class="<?php echo $class; ?>">
                    <strong><?php echo htmlspecialchars($testName); ?>:</strong> 
                    <?php echo htmlspecialchars($result); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="card">
            <h3>📝 Test Results Summary</h3>
            <p>
                ✅ = Test passed successfully<br>
                ⚠️ = Test passed but no data found (normal for new setup)<br>
                ❌ = Test failed with error
            </p>
            <p>If you see any ❌ errors above, those indicate database structure issues that need to be fixed.</p>
        </div>
    </div>
</body>
</html> 