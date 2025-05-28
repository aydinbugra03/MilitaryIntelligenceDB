<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $supply_id = (int)$_POST['supply_id'];
        $quantity  = (int)$_POST['quantity'];

        // Check if supply exists
        $chk = $conn->prepare("SELECT COUNT(*) FROM Supply WHERE supply_id = ?");
        $chk->execute([$supply_id]);
        if ($chk->fetchColumn() == 0) {
            $message = "Warning: Supply ID not found.";
        } else {
            try {
                $stmt = $conn->prepare("CALL OrderSupply(?, ?)");
                $stmt->execute([$supply_id, $quantity]);
                $results = $stmt->fetchAll();
                $message = "Stored procedure executed successfully!";
            } catch (Exception $e) {
                $message = "Error: " . $e->getMessage();
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
    <title>Stored Procedure 5</title>
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
        <h1>Stored Procedure 5 (by: Bora Çelikörs): Processes a supply order, validates stock levels and adjusts pending quantities.</h1>
        
        <form method="POST">
            <div class="form-group">
                <input type="number" name="supply_id" placeholder="Parameter 1: Supply ID" required>
            </div>
            <div class="form-group">
                <input type="number" name="quantity" placeholder="Parameter 2: Order Quantity" required>
            </div>
            <button type="submit">Call Procedure</button>
        </form>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($results)): ?>
            <div class="results">
                <strong>Procedure Output:</strong><br>
                <?php foreach ($results as $row): ?>
                    <?php foreach ($row as $value): ?>
                        <?php echo htmlspecialchars((string)$value); ?><br>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="homepage-link">
            <a href="../user/">Go to homepage</a>
        </div>
    </div>
</body>
</html> 