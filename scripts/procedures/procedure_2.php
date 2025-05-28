<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mysql.php';

$message = '';
$agent_info = [];
$reports = [];
$summary = [];

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $agent_id = (int)$_POST['agent_id'];

        // Check if agent exists
        $check = $conn->prepare("SELECT COUNT(*) FROM Agents WHERE agent_id = ?");
        $check->execute([$agent_id]);
        if ($check->fetchColumn() == 0) {
            $message = "Warning: Agent ID not found.";
        } else {
            // Execute the stored procedure
            try {
                $stmt = $conn->prepare("CALL GetAgentReports(?)");
                $stmt->execute([$agent_id]);
                
                // Get first result set (agent info)
                $agent_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Move to next result set (reports)
                $stmt->nextRowset();
                $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Move to next result set (summary)
                $stmt->nextRowset();
                $summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                $stmt->closeCursor();
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
    <title>Stored Procedure 2</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f9f9f9;
        }
        .container { 
            max-width: 800px; 
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
        .section {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background: #fff;
        }
        .section h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
        <h1>Stored Procedure 2 (by: Toprak Aktepe): Returns all intelligence reports for the specified agent.</h1>
        
        <form method="POST">
            <div class="form-group">
                <input type="number" name="agent_id" placeholder="Parameter 1: Agent ID" required>
            </div>
            <button type="submit">Call Procedure</button>
        </form>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($agent_info) || !empty($reports) || !empty($summary)): ?>
            <div class="results">
                <strong>Procedure Output:</strong>
                
                <?php if (!empty($agent_info)): ?>
                    <div class="section">
                        <h3>Agent Information:</h3>
                        <?php foreach ($agent_info as $row): ?>
                            <?php foreach ($row as $key => $value): ?>
                                <?php echo htmlspecialchars($key . ': ' . $value); ?><br>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($reports)): ?>
                    <div class="section">
                        <h3>Intelligence Reports:</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>Date Created</th>
                                    <th>Title</th>
                                    <th>Classification Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reports as $report): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($report['report_id']); ?></td>
                                        <td><?php echo htmlspecialchars($report['date_created']); ?></td>
                                        <td><?php echo htmlspecialchars($report['title']); ?></td>
                                        <td><?php echo htmlspecialchars($report['classification_level']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <?php if (!empty($summary)): ?>
                    <div class="section">
                        <h3>Summary Statistics:</h3>
                        <?php foreach ($summary as $row): ?>
                            <?php foreach ($row as $key => $value): ?>
                                <?php echo htmlspecialchars($key . ': ' . $value); ?><br>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="homepage-link">
            <a href="../user/">Go to homepage</a>
        </div>
    </div>
</body>
</html> 