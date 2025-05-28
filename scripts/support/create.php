<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mongodb.php';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $ticket_message = trim($_POST['message']);
    
    if (!empty($username) && !empty($ticket_message)) {
        try {
            $manager = getMongoDBConnection();
            
            $document = [
                'username' => $username,
                'message' => $ticket_message,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => true,
                'comments' => []
            ];
            
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->insert($document);
            
            $result = $manager->executeBulkWrite('support_system.tickets', $bulk);
            
            if ($result->getInsertedCount() > 0) {
                $success = true;
                $message = "Ticket created successfully!";
            } else {
                $message = "Error: Failed to create ticket.";
            }
            
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Error: Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Support Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background-color: #27ae60; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold; }
        input, textarea { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { min-height: 120px; resize: vertical; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #27ae60; color: white; }
        .btn-secondary { background-color: #95a5a6; color: white; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .nav-links { margin-bottom: 2rem; }
        .nav-links a { display: inline-block; margin-right: 1rem; padding: 0.5rem 1rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-links">
            <a href="../user/">← Back to Homepage</a>
            <a href="index.php">← Back to Ticket List</a>
        </div>
        
        <div class="header">
            <h1>📝 Create Support Ticket</h1>
            <p>Describe your issue and we'll help you resolve it</p>
        </div>

        <?php if ($message): ?>
            <div class="message <?php echo $success ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="card">
                <h3>✅ Ticket Created Successfully!</h3>
                <p>Your support ticket has been created and our admin team will respond soon.</p>
                <div>
                    <a href="create.php" class="btn btn-primary">Create Another Ticket</a>
                    <a href="index.php" class="btn btn-secondary">View Ticket List</a>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <h3>Create New Ticket</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" required placeholder="Enter your username" 
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message">Ticket Message</label>
                        <textarea name="message" required placeholder="Describe your issue or question in detail..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Ticket</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html> 