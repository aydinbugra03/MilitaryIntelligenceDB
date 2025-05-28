<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mysql.php';

$message = '';
$results = [];

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $agent_id = $_POST['agent_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $classification = trim($_POST['classification']);
        
        // Allowed classification levels
        $allowedLevels = ['Top Secret', 'Secret', 'Classified', 'Confidential', 'Unclassified'];
        if (!in_array($classification, $allowedLevels, true)) {
            $message = "Warning: Classification level must be one of: " . implode(', ', $allowedLevels);
        } else {
            // Execute the stored procedure
            try {
                $stmt = $conn->prepare("CALL GenerateIntelligenceReport(?, ?, ?, ?)");
                $stmt->execute([$agent_id, $title, $classification, $content]);
                $stmt->fetchAll();
                $stmt->closeCursor();
                $message = "Stored procedure executed successfully!";

                // Fetch all reports for this agent
                $repStmt = $conn->prepare("SELECT report_id, date_created, title, classification_level FROM Intelligence_Reports WHERE agent_id = ? ORDER BY date_created DESC");
                $repStmt->execute([$agent_id]);
                $agentReports = $repStmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Stored Procedure 3</title>
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
        input, select, textarea { 
            width: 100%;
            padding: 8px; 
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        textarea {
            height: 80px;
            resize: vertical;
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
        <h1>Stored Procedure 3 (by: Taylan Irak): Generates a new intelligence report and performs basic validation before saving.</h1>
        
        <form method="POST">
            <div class="form-group">
                <input type="number" name="agent_id" placeholder="Parameter 1: Agent ID" required>
            </div>
            <div class="form-group">
                <input type="text" name="title" placeholder="Parameter 2: Report Title" required>
            </div>
            <div class="form-group">
                <textarea name="content" placeholder="Parameter 3: Report Content" required></textarea>
            </div>
            <div class="form-group">
                <input type="text" name="classification" placeholder="Parameter 4: Classification Level" required>
            </div>
            <button type="submit">Call Procedure</button>
        </form>

        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($agentReports)): ?>
            <div class="results">
                <strong>All Reports for Agent #<?php echo htmlspecialchars($agent_id); ?>:</strong><br>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr><th>ID</th><th>Date</th><th>Title</th><th>Classification</th></tr>
                    <?php foreach ($agentReports as $r): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['report_id']); ?></td>
                            <td><?php echo htmlspecialchars($r['date_created']); ?></td>
                            <td><?php echo htmlspecialchars($r['title']); ?></td>
                            <td><?php echo htmlspecialchars($r['classification_level']); ?></td>
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