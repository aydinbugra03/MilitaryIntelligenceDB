<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../config/mysql.php';

$message = '';

try {
    $conn = getMySQLConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'case1':
                // Case 1: Create Top Secret Report
                $title = "Operation Phoenix - Top Secret";
                $content = "Classified military operation details.";
                $classification = "Top Secret";
                $agent_id = 1;
                
                $stmt = $conn->query("SELECT MAX(report_id) as max_id FROM Intelligence_Reports");
                $result = $stmt->fetch();
                $next_id = ($result['max_id'] ?? 0) + 1;
                
                $stmt = $conn->prepare("INSERT INTO Intelligence_Reports (report_id, title, content, date_created, classification_level, agent_id) VALUES (?, ?, ?, NOW(), ?, ?)");
                $stmt->execute([$next_id, $title, $content, $classification, $agent_id]);
                
                $message = "Case 1 executed: Top Secret report created. Trigger processed high-security classification!";
                break;
                
            case 'case2':
                // Case 2: Create Classified Report
                $title = "Routine Patrol Report - Classified";
                $content = "Standard patrol findings.";
                $classification = "Classified";
                $agent_id = 2;
                
                $stmt = $conn->query("SELECT MAX(report_id) as max_id FROM Intelligence_Reports");
                $result = $stmt->fetch();
                $next_id = ($result['max_id'] ?? 0) + 1;
                
                $stmt = $conn->prepare("INSERT INTO Intelligence_Reports (report_id, title, content, date_created, classification_level, agent_id) VALUES (?, ?, ?, NOW(), ?, ?)");
                $stmt->execute([$next_id, $title, $content, $classification, $agent_id]);
                
                $message = "Case 2 executed: Classified report created. Trigger handled standard classification!";
                break;
                
            case 'case3':
                // Case 3: Create Unclassified Report
                $title = "Public Information Bulletin";
                $content = "General information update.";
                $classification = "Unclassified";
                $agent_id = 3;
                
                $stmt = $conn->query("SELECT MAX(report_id) as max_id FROM Intelligence_Reports");
                $result = $stmt->fetch();
                $next_id = ($result['max_id'] ?? 0) + 1;
                
                $stmt = $conn->prepare("INSERT INTO Intelligence_Reports (report_id, title, content, date_created, classification_level, agent_id) VALUES (?, ?, ?, NOW(), ?, ?)");
                $stmt->execute([$next_id, $title, $content, $classification, $agent_id]);
                
                $message = "Case 3 executed: Unclassified report created. Trigger processed low-security classification!";
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
    <title>Trigger 2</title>
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
        <h1>Trigger 2 (by: Toprak Aktepe): Automatically handles classification levels when new intelligence reports are created.</h1>
        
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