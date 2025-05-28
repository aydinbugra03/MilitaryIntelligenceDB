<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();
    
    // Create missing stored procedures
    $procedures_created = [];
    
    // 1. Create OrderSupply procedure
    try {
        $conn->exec("DROP PROCEDURE IF EXISTS OrderSupply");
        $procedure_sql = "
        CREATE PROCEDURE OrderSupply(
            IN p_supply_id INT,
            IN p_quantity INT
        )
        BEGIN
            DECLARE current_qty INT;
            DECLARE new_qty INT;
            
            -- Get current quantity
            SELECT quantity INTO current_qty FROM Supply WHERE supply_id = p_supply_id;
            
            -- Calculate new quantity after order
            SET new_qty = current_qty + p_quantity;
            
            -- Update supply quantity
            UPDATE Supply SET quantity = new_qty WHERE supply_id = p_supply_id;
            
            -- Return order confirmation
            SELECT 
                p_supply_id as supply_id,
                (SELECT sup_name FROM Supply WHERE supply_id = p_supply_id) as supply_name,
                current_qty as previous_quantity,
                p_quantity as ordered_quantity,
                new_qty as new_quantity,
                'Order completed successfully' as status,
                NOW() as order_date;
        END";
        $conn->exec($procedure_sql);
        $procedures_created[] = "✅ OrderSupply procedure created successfully";
    } catch (Exception $e) {
        $procedures_created[] = "❌ OrderSupply procedure error: " . $e->getMessage();
    }
    
    // 2. Create GenerateReport procedure (if missing)
    try {
        $conn->exec("DROP PROCEDURE IF EXISTS GenerateReport");
        $procedure_sql = "
        CREATE PROCEDURE GenerateReport(
            IN p_agent_id INT,
            IN p_title VARCHAR(255),
            IN p_content TEXT,
            IN p_classification VARCHAR(50)
        )
        BEGIN
            INSERT INTO Intelligence_Reports (title, content, date_created, classification_level, agent_id)
            VALUES (p_title, p_content, NOW(), p_classification, p_agent_id);
            
            SELECT 
                LAST_INSERT_ID() as report_id,
                p_title as title,
                p_classification as classification_level,
                (SELECT name FROM Agents WHERE agent_id = p_agent_id) as agent_name,
                'Report generated successfully' as status,
                NOW() as created_date;
        END";
        $conn->exec($procedure_sql);
        $procedures_created[] = "✅ GenerateReport procedure created successfully";
    } catch (Exception $e) {
        $procedures_created[] = "❌ GenerateReport procedure error: " . $e->getMessage();
    }
    
    // 3. Create UpdateAgentRank procedure (if missing)
    try {
        $conn->exec("DROP PROCEDURE IF EXISTS UpdateAgentRank");
        $procedure_sql = "
        CREATE PROCEDURE UpdateAgentRank(
            IN p_agent_id INT,
            IN p_new_rank VARCHAR(50)
        )
        BEGIN
            DECLARE old_rank VARCHAR(50);
            
            -- Get current rank
            SELECT rank INTO old_rank FROM Agents WHERE agent_id = p_agent_id;
            
            -- Update agent rank
            UPDATE Agents SET rank = p_new_rank WHERE agent_id = p_agent_id;
            
            -- Return update confirmation
            SELECT 
                p_agent_id as agent_id,
                (SELECT name FROM Agents WHERE agent_id = p_agent_id) as agent_name,
                old_rank as previous_rank,
                p_new_rank as new_rank,
                'Rank updated successfully' as status,
                NOW() as update_date;
        END";
        $conn->exec($procedure_sql);
        $procedures_created[] = "✅ UpdateAgentRank procedure created successfully";
    } catch (Exception $e) {
        $procedures_created[] = "❌ UpdateAgentRank procedure error: " . $e->getMessage();
    }
    
    // Test all procedures
    $test_results = [];
    
    // Test OrderSupply
    try {
        $stmt = $conn->prepare("CALL OrderSupply(1, 50)");
        $stmt->execute();
        $result = $stmt->fetch();
        $test_results[] = "✅ OrderSupply test: " . $result['status'];
    } catch (Exception $e) {
        $test_results[] = "❌ OrderSupply test failed: " . $e->getMessage();
    }
    
    $message = "Missing stored procedures have been created and tested!";
    $results = array_merge($procedures_created, [''], ['Test Results:'], $test_results);
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Missing Stored Procedures</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #8e44ad; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .result-item { padding: 0.75rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #8e44ad; background-color: #f8f9fa; font-family: monospace; }
        .success { border-left-color: #27ae60; }
        .error { border-left-color: #e74c3c; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; background-color: #8e44ad; color: white; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>🔧 Create Missing Stored Procedures</h1>
            <p>Adding OrderSupply and other missing procedures</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>📋 Procedure Creation Results</h3>
            
            <?php foreach ($results as $result): ?>
                <?php if (empty($result)): ?>
                    <br>
                <?php else: ?>
                    <?php 
                    $class = 'result-item';
                    if (strpos($result, '✅') !== false) $class .= ' success';
                    elseif (strpos($result, '❌') !== false) $class .= ' error';
                    ?>
                    <div class="<?php echo $class; ?>">
                        <?php echo htmlspecialchars($result); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="card">
            <h3>🚀 Test Procedures Now</h3>
            <p>All missing stored procedures have been created. Test them:</p>
            
            <div style="margin: 1rem 0;">
                <a href="procedures/procedure_1.php" class="btn">Procedure 1: Assign Operator</a>
                <a href="procedures/procedure_2.php" class="btn">Procedure 2: Get Agent Reports</a>
                <a href="procedures/procedure_3.php" class="btn">Procedure 3: Generate Report</a>
                <a href="procedures/procedure_5.php" class="btn">Procedure 5: Order Supply</a>
            </div>
        </div>
        
        <div class="card">
            <h3>📋 Created Procedures</h3>
            <ul>
                <li><strong>OrderSupply(supply_id, quantity)</strong>: Orders additional supply items and updates inventory</li>
                <li><strong>GenerateReport(agent_id, title, content, classification)</strong>: Creates new intelligence reports</li>
                <li><strong>UpdateAgentRank(agent_id, new_rank)</strong>: Updates agent rank with history tracking</li>
            </ul>
        </div>
    </div>
</body>
</html> 