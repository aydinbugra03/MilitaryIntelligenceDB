<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $operator_id = $_POST['operator_id'];
        $drone_id = $_POST['drone_id'];
        
        // Execute the stored procedure
        try {
            $stmt = $conn->prepare("CALL AssignOperatorToDrone(?, ?, ?)");
            $stmt->execute([$operator_id, $drone_id, null]);
            // Consume and close any result set the procedure might have returned
            $stmt->fetchAll();
            $stmt->closeCursor();

            $message = "Stored procedure executed successfully!";

            // Fetch current operator assignments for all drones
            $stmt2 = $conn->query("SELECT drone_id, op_id AS operator_id FROM Drones ORDER BY drone_id");
            $droneAssignments = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
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
    <title>Stored Procedure 1</title>
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
        <h1>Stored Procedure 1 (by: Buğra Aydın): Assigns an operator to a drone after validation.</h1>
        
        <form method="POST">
            <div class="form-group">
                <input type="number" name="operator_id" placeholder="Parameter 1: Operator ID" required>
            </div>
            <div class="form-group">
                <input type="number" name="drone_id" placeholder="Parameter 2: Drone ID" required>
            </div>
            <button type="submit">Call Procedure</button>
        </form>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($droneAssignments)): ?>
            <div class="results">
                <strong>Current Drone Assignments:</strong><br>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr><th>Drone ID</th><th>Operator ID</th></tr>
                    <?php foreach ($droneAssignments as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['drone_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['operator_id']); ?></td>
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