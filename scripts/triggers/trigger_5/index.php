<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../config/mysql.php';

$message = '';

try {
    $conn = getMySQLConnection();
    
    // Create Agent_Activity_Log table if it doesn't exist
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
    } catch (Exception $e) {
        // Table might already exist
    }
    
    // Create triggers if they don't exist
    try {
        $conn->exec("DROP TRIGGER IF EXISTS agent_activity_logging");
        $trigger_sql = "
        CREATE TRIGGER agent_activity_logging
        AFTER UPDATE ON Agents
        FOR EACH ROW
        BEGIN
            IF NEW.`rank` != OLD.`rank` THEN
                INSERT INTO Agent_Activity_Log (agent_id, old_rank, new_rank, activity_date, activity_type, activity_description)
                VALUES (NEW.agent_id, OLD.`rank`, NEW.`rank`, NOW(), 'RANK_CHANGE', 
                    CONCAT('Agent rank changed from ', OLD.`rank`, ' to ', NEW.`rank`));
            END IF;
        END";
        $conn->exec($trigger_sql);
        
        $conn->exec("DROP TRIGGER IF EXISTS agent_report_logging");
        $trigger_sql2 = "
        CREATE TRIGGER agent_report_logging
        AFTER INSERT ON Intelligence_Reports
        FOR EACH ROW
        BEGIN
            INSERT INTO Agent_Activity_Log (agent_id, old_rank, new_rank, activity_date, activity_type, activity_description)
            VALUES (NEW.agent_id, '', '', NOW(), 'REPORT_CREATED', 
                CONCAT('Agent created intelligence report: ', NEW.title));
        END";
        $conn->exec($trigger_sql2);
    } catch (Exception $e) {
        // Trigger creation might fail if table doesn't exist
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'case1':
                // Case 1: Agent Promotion
                $stmt = $conn->prepare("UPDATE Agents SET `rank` = 'Captain' WHERE agent_id = 1");
                $stmt->execute();
                $message = "Case 1 executed: Agent promoted to Captain. Trigger logged rank change!";
                break;
                
            case 'case2':
                // Case 2: Create Intelligence Report
                $title = "Field Activity Report";
                $content = "Routine field activity completed.";
                
                $stmt = $conn->query("SELECT MAX(report_id) as max_id FROM Intelligence_Reports");
                $result = $stmt->fetch();
                $next_id = ($result['max_id'] ?? 0) + 1;
                
                $stmt = $conn->prepare("INSERT INTO Intelligence_Reports (report_id, title, content, date_created, classification_level, agent_id) VALUES (?, ?, ?, NOW(), 'Confidential', 2)");
                $stmt->execute([$next_id, $title, $content]);
                
                $message = "Case 2 executed: Intelligence report created. Trigger logged agent activity!";
                break;
                
            case 'case3':
                // Case 3: Multiple Activity Simulation
                $stmt = $conn->prepare("UPDATE Agents SET `rank` = 'Major' WHERE agent_id = 3");
                $stmt->execute();
                
                $title = "Post-Promotion Report";
                $content = "Report following promotion.";
                
                $stmt = $conn->query("SELECT MAX(report_id) as max_id FROM Intelligence_Reports");
                $result = $stmt->fetch();
                $next_id = ($result['max_id'] ?? 0) + 1;
                
                $stmt = $conn->prepare("INSERT INTO Intelligence_Reports (report_id, title, content, date_created, classification_level, agent_id) VALUES (?, ?, ?, NOW(), 'Secret', 3)");
                $stmt->execute([$next_id, $title, $content]);
                
                $message = "Case 3 executed: Multiple activities simulated. Trigger logged both promotion and report!";
                break;
        }
    }
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigger 5</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f9f9f9;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
        }
        h1 { 
            font-size: 16px; 
            margin-bottom: 20px;
            color: #333;
        }
        .test-buttons {
            margin: 20px 0;
        }
        button { 
            padding: 8px 16px; 
            margin: 5px; 
            border: 1px solid #ccc;
            background: #f0f0f0;
            cursor: pointer;
        }
        button:hover {
            background: #e0e0e0;
        }
        .message {
            margin: 20px 0;
            padding: 10px;
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            color: #2d5a2d;
        }
        .homepage-link {
            margin-top: 30px;
            text-decoration: underline;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trigger 5 (by: Taylan Irak): Logs agent activities including rank changes and intelligence report creation to the Agent_Activity_Log table.</h1>
        
        <div class="test-buttons">
            <form method="POST" style="display: inline;">
                <input type="hidden" name="action" value="case1">
                <button type="submit">Case 1</button>
            </form>
            
            <form method="POST" style="display: inline;">
                <input type="hidden" name="action" value="case2">
                <button type="submit">Case 2</button>
            </form>
            
            <form method="POST" style="display: inline;">
                <input type="hidden" name="action" value="case3">
                <button type="submit">Case 3</button>
            </form>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="homepage-link">
            <a href="../../user/">Go to homepage</a>
        </div>
    </div>
</body>
</html> 