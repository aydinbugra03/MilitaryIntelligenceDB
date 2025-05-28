<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../config/mysql.php';

$message = '';

try {
    $conn = getMySQLConnection();
    
    // Create VehicleStatusLog table if it doesn't exist
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS VehicleStatusLog (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vehicle_id INT,
            old_status VARCHAR(50),
            new_status VARCHAR(50),
            change_date DATETIME,
            change_reason TEXT
        )");
    } catch (Exception $e) {
        // Table might already exist
    }
    
    // Create trigger if it doesn't exist
    try {
        $conn->exec("DROP TRIGGER IF EXISTS vehicle_status_update");
        $trigger_sql = "
        CREATE TRIGGER vehicle_status_update
        AFTER UPDATE ON Vehicles
        FOR EACH ROW
        BEGIN
            IF NEW.operational_status != OLD.operational_status THEN
                INSERT INTO VehicleStatusLog (vehicle_id, old_status, new_status, change_date, change_reason)
                VALUES (NEW.vehicle_id, OLD.operational_status, NEW.operational_status, NOW(), 
                    CONCAT('Status changed from ', OLD.operational_status, ' to ', NEW.operational_status));
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
                // Case 1: Active to Maintenance
                $stmt = $conn->prepare("UPDATE Vehicles SET operational_status = 'Maintenance' WHERE vehicle_id = 1");
                $stmt->execute();
                $message = "Case 1 executed: Vehicle moved to maintenance status. Trigger logged the change!";
                break;
                
            case 'case2':
                // Case 2: Maintenance to Repair
                $stmt = $conn->prepare("UPDATE Vehicles SET operational_status = 'Repair' WHERE vehicle_id = 1");
                $stmt->execute();
                $message = "Case 2 executed: Vehicle status escalated to repair. Trigger tracked the escalation!";
                break;
                
            case 'case3':
                // Case 3: Repair back to Active
                $stmt = $conn->prepare("UPDATE Vehicles SET operational_status = 'Active' WHERE vehicle_id = 1");
                $stmt->execute();
                $message = "Case 3 executed: Vehicle returned to active duty. Trigger confirmed operational status!";
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
    <title>Trigger 3</title>
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
        <h1>Trigger 3 (by: Görkem Subaşı): Tracks vehicle operational status changes and logs all transitions to the VehicleStatusLog table.</h1>
        
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