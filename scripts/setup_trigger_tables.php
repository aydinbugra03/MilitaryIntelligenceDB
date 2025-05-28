<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();
    
    // Create all trigger-related tables
    $tables_created = [];
    
    // 1. DroneStatus table for Trigger 1
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS DroneStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            drone_id INT,
            old_operator_id INT,
            new_operator_id INT,
            status_date DATETIME,
            status_message TEXT
        )");
        $tables_created[] = "✅ DroneStatus table created/verified";
    } catch (Exception $e) {
        $tables_created[] = "❌ DroneStatus table error: " . $e->getMessage();
    }
    
    // 2. VehicleStatusLog table for Trigger 3
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS VehicleStatusLog (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vehicle_id INT,
            old_status VARCHAR(50),
            new_status VARCHAR(50),
            change_date DATETIME,
            change_reason TEXT
        )");
        $tables_created[] = "✅ VehicleStatusLog table created/verified";
    } catch (Exception $e) {
        $tables_created[] = "❌ VehicleStatusLog table error: " . $e->getMessage();
    }
    
    // 3. Supply_Audit table for Trigger 4
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS Supply_Audit (
            id INT AUTO_INCREMENT PRIMARY KEY,
            supply_id INT,
            old_quantity INT,
            new_quantity INT,
            audit_date DATETIME,
            audit_message TEXT
        )");
        $tables_created[] = "✅ Supply_Audit table created/verified";
    } catch (Exception $e) {
        $tables_created[] = "❌ Supply_Audit table error: " . $e->getMessage();
    }
    
    // 4. Agent_Activity_Log table for Trigger 5
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS Agent_Activity_Log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            agent_id INT,
            old_rank VARCHAR(50),
            new_rank VARCHAR(50),
            activity_date DATETIME,
            activity_type VARCHAR(50),
            activity_description TEXT
        )");
        $tables_created[] = "✅ Agent_Activity_Log table created/verified";
    } catch (Exception $e) {
        $tables_created[] = "❌ Agent_Activity_Log table error: " . $e->getMessage();
    }
    
    // Test if all main tables exist
    $main_tables = ['Operator', 'Agents', 'Drones', 'Intelligence_Reports', 'Supply', 'Vehicles'];
    foreach ($main_tables as $table) {
        try {
            $stmt = $conn->query("SELECT 1 FROM $table LIMIT 1");
            $tables_created[] = "✅ $table table exists";
        } catch (Exception $e) {
            $tables_created[] = "❌ $table table missing: " . $e->getMessage();
        }
    }
    
    $message = "Database setup completed! All trigger tables have been created.";
    $results = $tables_created;
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Trigger Tables</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #27ae60; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .result-item { padding: 1rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #3498db; background-color: #f8f9fa; }
        .success { border-left-color: #27ae60; }
        .error { border-left-color: #e74c3c; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; background-color: #3498db; color: white; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>Setup Trigger Tables</h1>
            <p>Creating all necessary tables for triggers and procedures</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>🔧 Table Creation Results</h3>
            
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
            <h3>🚀 Next Steps</h3>
            <p>Now that all tables are set up, you can test the triggers and procedures:</p>
            <a href="triggers/trigger_1/" class="btn">Test Trigger 1</a>
            <a href="triggers/trigger_3/" class="btn">Test Trigger 3</a>
            <a href="triggers/trigger_4/" class="btn">Test Trigger 4</a>
            <a href="triggers/trigger_5/" class="btn">Test Trigger 5</a>
            <br><br>
            <a href="procedures/procedure_1.php" class="btn">Test Procedure 1</a>
            <a href="procedures/procedure_2.php" class="btn">Test Procedure 2</a>
            <a href="procedures/procedure_3.php" class="btn">Test Procedure 3</a>
        </div>
    </div>
</body>
</html> 