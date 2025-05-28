<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../config/mysql.php';

$message = '';

try {
    $conn = getMySQLConnection();
    
    // Create Supply_Audit table if it doesn't exist
    try {
        $conn->exec("CREATE TABLE IF NOT EXISTS Supply_Audit (
            id INT AUTO_INCREMENT PRIMARY KEY,
            supply_id INT,
            old_quantity INT,
            new_quantity INT,
            audit_date DATETIME,
            audit_message TEXT
        )");
    } catch (Exception $e) {
        // Table might already exist
    }
    
    // Create trigger if it doesn't exist
    try {
        $conn->exec("DROP TRIGGER IF EXISTS supply_inventory_management");
        $trigger_sql = "
        CREATE TRIGGER supply_inventory_management
        AFTER UPDATE ON Supply
        FOR EACH ROW
        BEGIN
            IF NEW.quantity != OLD.quantity THEN
                INSERT INTO Supply_Audit (supply_id, old_quantity, new_quantity, audit_date, audit_message)
                VALUES (NEW.supply_id, OLD.quantity, NEW.quantity, NOW(), 
                    CONCAT('Quantity changed from ', OLD.quantity, ' to ', NEW.quantity));
                
                IF NEW.quantity <= 50 THEN
                    INSERT INTO Supply_Audit (supply_id, old_quantity, new_quantity, audit_date, audit_message)
                    VALUES (NEW.supply_id, OLD.quantity, NEW.quantity, NOW(), 
                        'LOW STOCK ALERT: Quantity below threshold!');
                END IF;
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
                // Case 1: Normal stock reduction
                $stmt = $conn->prepare("UPDATE Supply SET quantity = 150 WHERE supply_id = 1");
                $stmt->execute();
                $message = "Case 1 executed: Normal stock reduction logged. Trigger tracked inventory change!";
                break;
                
            case 'case2':
                // Case 2: Low stock alert
                $stmt = $conn->prepare("UPDATE Supply SET quantity = 25 WHERE supply_id = 1");
                $stmt->execute();
                $message = "Case 2 executed: Low stock alert triggered. Trigger generated warning notification!";
                break;
                
            case 'case3':
                // Case 3: Stock increase
                $stmt = $conn->prepare("UPDATE Supply SET quantity = 200 WHERE supply_id = 2");
                $stmt->execute();
                $message = "Case 3 executed: Stock increased. Trigger logged inventory update!";
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
    <title>Trigger 4</title>
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
        <h1>Trigger 4 (by: Bora Çelikörs): Manages supply inventory changes and generates low-stock alerts when quantities fall below threshold.</h1>
        
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