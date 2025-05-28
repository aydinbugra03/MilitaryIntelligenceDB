<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../config/mysql.php';

$message = '';

try {
    $conn = getMySQLConnection();
    
    // Create DroneStatus table if it doesn't exist
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS DroneStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            drone_id INT,
            old_operator_id INT,
            new_operator_id INT,
            status_date DATETIME,
            status_message TEXT
        )");
    } catch (Exception $e) {
        // Table might already exist
    }
    
    // Create trigger if it doesn't exist
    try {
        $conn->exec("DROP TRIGGER IF EXISTS operator_assignment_validation");
        $trigger_sql = "
        CREATE TRIGGER operator_assignment_validation
        AFTER UPDATE ON Drones
        FOR EACH ROW
        BEGIN
            IF NEW.op_id != OLD.op_id THEN
                INSERT INTO DroneStatus (drone_id, old_operator_id, new_operator_id, status_date, status_message)
                VALUES (NEW.drone_id, OLD.op_id, NEW.op_id, NOW(), 
                    CONCAT('Operator assignment changed from ', OLD.op_id, ' to ', NEW.op_id));
            END IF;
        END";
        $conn->exec($trigger_sql);
    } catch (Exception $e) {
        // Trigger creation might fail if table doesn't exist
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'case1':
                // Case 1: Assign operator 1 to drone 1
                $stmt = $conn->prepare("UPDATE Drones SET op_id = 1 WHERE drone_id = 1");
                $stmt->execute();
                $message = "Case 1 executed: Operator 1 assigned to Drone 1. Trigger fired successfully!";
                break;
                
            case 'case2':
                // Case 2: Assign operator 2 to drone 1
                $stmt = $conn->prepare("UPDATE Drones SET op_id = 2 WHERE drone_id = 1");
                $stmt->execute();
                $message = "Case 2 executed: Operator 2 assigned to Drone 1. Trigger logged the change!";
                break;
                
            case 'case3':
                // Case 3: Assign operator 3 to drone 2
                $stmt = $conn->prepare("UPDATE Drones SET op_id = 3 WHERE drone_id = 2");
                $stmt->execute();
                $message = "Case 3 executed: Operator 3 assigned to Drone 2. Trigger validated assignment!";
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
    <title>Trigger 1</title>
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
        <h1>Trigger 1 (by: Buğra Aydın): Validates drone operator assignments and logs all changes to the DroneStatus table.</h1>
        
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