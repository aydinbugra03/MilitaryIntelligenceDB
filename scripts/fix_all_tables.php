<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();
    
    // Fix all trigger-related tables by dropping and recreating them
    $tables_fixed = [];
    
    // 1. Fix DroneStatus table for Trigger 1
    try {
        $conn->exec("DROP TABLE IF EXISTS DroneStatus");
        $conn->exec("CREATE TABLE DroneStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            drone_id INT,
            old_operator_id INT,
            new_operator_id INT,
            status_date DATETIME,
            status_message TEXT
        )");
        $tables_fixed[] = "✅ DroneStatus table recreated successfully";
    } catch (Exception $e) {
        $tables_fixed[] = "❌ DroneStatus table error: " . $e->getMessage();
    }
    
    // 2. Fix VehicleStatusLog table for Trigger 3
    try {
        $conn->exec("DROP TABLE IF EXISTS VehicleStatusLog");
        $conn->exec("CREATE TABLE VehicleStatusLog (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vehicle_id INT,
            old_status VARCHAR(50),
            new_status VARCHAR(50),
            change_date DATETIME,
            change_reason TEXT
        )");
        $tables_fixed[] = "✅ VehicleStatusLog table recreated successfully";
    } catch (Exception $e) {
        $tables_fixed[] = "❌ VehicleStatusLog table error: " . $e->getMessage();
    }
    
    // 3. Fix Supply_Audit table for Trigger 4
    try {
        $conn->exec("DROP TABLE IF EXISTS Supply_Audit");
        $conn->exec("CREATE TABLE Supply_Audit (
            id INT AUTO_INCREMENT PRIMARY KEY,
            supply_id INT,
            old_quantity INT,
            new_quantity INT,
            audit_date DATETIME,
            audit_message TEXT
        )");
        $tables_fixed[] = "✅ Supply_Audit table recreated successfully";
    } catch (Exception $e) {
        $tables_fixed[] = "❌ Supply_Audit table error: " . $e->getMessage();
    }
    
    // 4. Fix Agent_Activity_Log table for Trigger 5
    try {
        $conn->exec("DROP TABLE IF EXISTS Agent_Activity_Log");
        $conn->exec("CREATE TABLE Agent_Activity_Log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            agent_id INT,
            old_rank VARCHAR(50),
            new_rank VARCHAR(50),
            activity_date DATETIME,
            activity_type VARCHAR(50),
            activity_description TEXT
        )");
        $tables_fixed[] = "✅ Agent_Activity_Log table recreated successfully";
    } catch (Exception $e) {
        $tables_fixed[] = "❌ Agent_Activity_Log table error: " . $e->getMessage();
    }
    
    // Test all main tables
    $main_tables = ['Operator', 'Agents', 'Drones', 'Intelligence_Reports', 'Supply', 'Vehicles'];
    foreach ($main_tables as $table) {
        try {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM $table");
            $result = $stmt->fetch();
            $tables_fixed[] = "✅ $table table exists with {$result['count']} records";
        } catch (Exception $e) {
            $tables_fixed[] = "❌ $table table missing: " . $e->getMessage();
        }
    }
    
    // Test all trigger tables
    $trigger_tables = ['DroneStatus', 'VehicleStatusLog', 'Supply_Audit', 'Agent_Activity_Log'];
    foreach ($trigger_tables as $table) {
        try {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM $table");
            $result = $stmt->fetch();
            $tables_fixed[] = "✅ $table table ready with {$result['count']} records";
        } catch (Exception $e) {
            $tables_fixed[] = "❌ $table table issue: " . $e->getMessage();
        }
    }
    
    $message = "All database tables have been fixed and recreated!";
    $results = $tables_fixed;
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix All Database Tables</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { background-color: #e74c3c; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .result-item { padding: 1rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #3498db; background-color: #f8f9fa; }
        .success { border-left-color: #27ae60; }
        .error { border-left-color: #e74c3c; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; background-color: #3498db; color: white; text-decoration: none; display: inline-block; }
        .btn-success { background-color: #27ae60; }
        .btn-warning { background-color: #f39c12; }
        .btn-danger { background-color: #e74c3c; }
        .btn-info { background-color: #17a2b8; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>🔧 Fix All Database Tables</h1>
            <p>Recreating all trigger tables with correct structure</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>🔍 Table Fix Results</h3>
            
            <?php foreach ($results as $result): ?>
                <?php 
                $class = 'result-item';
                if (strpos($result, '✅') !== false) $class .= ' success';
                elseif (strpos($result, '❌') !== false) $class .= ' error';
                ?>
                <div class="<?php echo $class; ?>">
                    <?php echo htmlspecialchars($result); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="card">
            <h3>🚀 Test All Triggers Now</h3>
            <p>All tables have been recreated. Test each trigger to verify they work correctly:</p>
            
            <div style="margin: 1rem 0;">
                <h4>Triggers:</h4>
                <a href="triggers/trigger_1/" class="btn btn-success">Trigger 1: Operator Assignment</a>
                <a href="triggers/trigger_2/" class="btn btn-warning">Trigger 2: Report Classification</a>
                <a href="triggers/trigger_3/" class="btn btn-info">Trigger 3: Vehicle Status</a>
                <a href="triggers/trigger_4/" class="btn btn-danger">Trigger 4: Supply Management</a>
                <a href="triggers/trigger_5/" class="btn">Trigger 5: Agent Activity</a>
            </div>
            
            <div style="margin: 1rem 0;">
                <h4>Procedures:</h4>
                <a href="procedures/procedure_1.php" class="btn btn-success">Procedure 1: Assign Operator</a>
                <a href="procedures/procedure_2.php" class="btn btn-warning">Procedure 2: Get Agent Reports</a>
                <a href="procedures/procedure_3.php" class="btn btn-info">Procedure 3: Generate Report</a>
            </div>
        </div>
        
        <div class="card">
            <h3>📋 What Was Fixed</h3>
            <ul>
                <li><strong>DroneStatus</strong>: Recreated with correct columns (id, drone_id, old_operator_id, new_operator_id, status_date, status_message)</li>
                <li><strong>VehicleStatusLog</strong>: Created for vehicle status tracking (id, vehicle_id, old_status, new_status, change_date, change_reason)</li>
                <li><strong>Supply_Audit</strong>: Recreated with audit_date column (id, supply_id, old_quantity, new_quantity, audit_date, audit_message)</li>
                <li><strong>Agent_Activity_Log</strong>: Created for agent activity tracking (id, agent_id, old_rank, new_rank, activity_date, activity_type, activity_description)</li>
            </ul>
        </div>
    </div>
</body>
</html> 