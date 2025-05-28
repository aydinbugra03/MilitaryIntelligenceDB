<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vehicle_id = $_POST['vehicle_id'];
        $new_status = trim($_POST['new_status']);
        
        // Allowed status values
        $allowedStatus = ['Active','Maintenance','Repair','Reserved'];
        if (!in_array(ucfirst(strtolower($new_status)), $allowedStatus, true)) {
            $message = "Warning: Status must be one of: " . implode(', ', $allowedStatus);
        } else {
            // Check vehicle exists
            $chk = $conn->prepare("SELECT COUNT(*) FROM Vehicles WHERE vehicle_id = ?");
            $chk->execute([$vehicle_id]);
            if ($chk->fetchColumn() == 0) {
                $message = "Warning: Vehicle ID not found.";
            } else {
                $new_status = ucfirst(strtolower($new_status));
                try {
                    $stmt = $conn->prepare("CALL UpdateVehicleStatus(?, ?)");
                    $stmt->execute([$vehicle_id, $new_status]);
                    $stmt->fetchAll();
                    $stmt->closeCursor();
                    $message = "Stored procedure executed successfully!";

                    // Fetch current vehicle statuses
                    $vehStmt = $conn->query("SELECT vehicle_id, operational_status FROM Vehicles ORDER BY vehicle_id");
                    $vehicles = $vehStmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    if ($e->getCode() === '42000' && strpos($e->getMessage(), 'UpdateVehicleStatus') !== false) {
                        $message = "Error: Stored procedure 'UpdateVehicleStatus' not found in database.";
                    } else {
                        $message = "Error: " . $e->getMessage();
                    }
                }
            }
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
    <title>Stored Procedure 4</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        input, select { 
            width: 100%;
            padding: 8px; 
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button { 
            padding: 8px 16px; 
            border: 1px solid #ccc;
            background: #f0f0f0;
            cursor: pointer;
            margin-top: 10px;
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
        .results {
            margin: 20px 0;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
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
        <h1>Stored Procedure 4 (by: Görkem Subaşı): Updates a vehicle\'s operational status and records the change in the audit log.</h1>
        
        <form method="POST">
            <div class="form-group">
                <input type="number" name="vehicle_id" placeholder="Parameter 1: Vehicle ID" required>
            </div>
            <div class="form-group">
                <input type="text" name="new_status" placeholder="Parameter 2: New Status" required>
            </div>
            <button type="submit">Call Procedure</button>
        </form>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($vehicles)): ?>
            <div class="results">
                <strong>Current Vehicle Statuses:</strong><br>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr><th>Vehicle ID</th><th>Status</th></tr>
                    <?php foreach ($vehicles as $v): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($v['vehicle_id']); ?></td>
                            <td><?php echo htmlspecialchars($v['operational_status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>

        <div class="homepage-link">
            <a href="../user/">Go to homepage</a>
        </div>
    </div>
</body>
</html> 