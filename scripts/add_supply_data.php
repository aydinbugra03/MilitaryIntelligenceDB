<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();
    
    // Check if Supply table has data
    $stmt = $conn->query("SELECT COUNT(*) as count FROM Supply");
    $count = $stmt->fetch()['count'];
    
    if ($count == 0) {
        // Add test data to Supply table
        $supplies = [
            ['Ammunition', 'Weapons', 200],
            ['Medical Kits', 'Medical', 150],
            ['Communication Devices', 'Electronics', 75],
            ['Fuel Barrels', 'Fuel', 300],
            ['Food Rations', 'Food', 500]
        ];
        
        $stmt = $conn->prepare("INSERT INTO Supply (name, type, quantity) VALUES (?, ?, ?)");
        
        foreach ($supplies as $supply) {
            $stmt->execute($supply);
            $results[] = "✅ Added: {$supply[0]} ({$supply[1]}) - Quantity: {$supply[2]}";
        }
        
        $message = "Test data added to Supply table successfully!";
    } else {
        $message = "Supply table already has $count records.";
        
        // Show existing data
        $stmt = $conn->query("SELECT * FROM Supply ORDER BY supply_id");
        $existing = $stmt->fetchAll();
        
        foreach ($existing as $supply) {
            $results[] = "📦 ID: {$supply['supply_id']} - {$supply['name']} ({$supply['type']}) - Quantity: {$supply['quantity']}";
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
    <title>Add Supply Test Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #27ae60; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .result-item { padding: 0.75rem; margin: 0.5rem 0; border-radius: 4px; border-left: 4px solid #27ae60; background-color: #f8f9fa; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; background-color: #f39c12; color: white; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <a href="user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>📦 Supply Test Data</h1>
            <p>Adding test data to Supply table for Trigger 4 testing</p>
        </div>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>📋 Supply Data Status</h3>
            
            <?php foreach ($results as $result): ?>
                <div class="result-item">
                    <?php echo htmlspecialchars($result); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="card">
            <h3>🚀 Test Trigger 4 Now</h3>
            <p>Supply table is ready with test data. You can now test Trigger 4:</p>
            <a href="triggers/trigger_4/" class="btn">Test Trigger 4: Supply Management</a>
        </div>
    </div>
</body>
</html> 