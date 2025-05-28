<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mongodb.php';

$message = '';
$ticket = null;

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$ticket_id = $_GET['id'];

try {
    $manager = getMongoDBConnection();
    
    // Handle comment submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'add_comment') {
            $comment = trim($_POST['comment']);
            $username = trim($_POST['username']);
            
            if (!empty($comment) && !empty($username)) {
                $filter = ['_id' => new MongoDB\BSON\ObjectId($ticket_id)];
                $update = [
                    '$push' => [
                        'comments' => [
                            'username' => $username,
                            'comment' => $comment,
                            'timestamp' => date('Y-m-d H:i:s')
                        ]
                    ]
                ];
                
                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter, $update);
                $result = $manager->executeBulkWrite('support_system.tickets', $bulk);
                
                if ($result->getModifiedCount() > 0) {
                    $message = "Comment added successfully!";
                } else {
                    $message = "Error: Failed to add comment.";
                }
            } else {
                $message = "Error: Please fill in all fields.";
            }
        }
    }
    
    // Get ticket details
    $filter = ['_id' => new MongoDB\BSON\ObjectId($ticket_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('support_system.tickets', $query);
    $tickets = $cursor->toArray();
    
    if (!empty($tickets)) {
        $ticket = $tickets[0];
    } else {
        header('Location: index.php');
        exit;
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
    <title>Ticket Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #3498db; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold; }
        input, textarea { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { min-height: 80px; resize: vertical; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #3498db; color: white; }
        .btn-success { background-color: #27ae60; color: white; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .ticket-info { background-color: #f8f9fa; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; }
        .comment-item { border: 1px solid #ddd; padding: 1rem; margin: 0.5rem 0; border-radius: 4px; background-color: #f8f9fa; }
        .comment-meta { font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; }
        .status-badge { padding: 0.25rem 0.5rem; border-radius: 3px; font-size: 0.9rem; font-weight: bold; }
        .status-active { background-color: #27ae60; color: white; }
        .status-resolved { background-color: #95a5a6; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Back to Ticket List</a>
        
        <div class="header">
            <h1>🎫 Ticket Details</h1>
            <p>View and manage your support ticket</p>
        </div>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') === 0 ? 'error' : 'success'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($ticket): ?>
            <div class="card">
                <h3>Ticket Information</h3>
                <div class="ticket-info">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($ticket->username); ?></p>
                    <p><strong>Created:</strong> <?php echo htmlspecialchars($ticket->created_at); ?></p>
                    <p><strong>Status:</strong> 
                        <span class="status-badge <?php echo $ticket->status ? 'status-active' : 'status-resolved'; ?>">
                            <?php echo $ticket->status ? 'Active' : 'Resolved'; ?>
                        </span>
                    </p>
                    <p><strong>Message:</strong></p>
                    <div style="background: white; padding: 1rem; border-radius: 4px; border: 1px solid #ddd;">
                        <?php echo nl2br(htmlspecialchars($ticket->message)); ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Comments (<?php echo count($ticket->comments ?? []); ?>)</h3>
                
                <?php if (!empty($ticket->comments)): ?>
                    <?php foreach ($ticket->comments as $comment): ?>
                        <div class="comment-item">
                            <div class="comment-meta">
                                <strong><?php echo htmlspecialchars($comment->username); ?></strong> - 
                                <?php echo htmlspecialchars($comment->timestamp); ?>
                            </div>
                            <div><?php echo nl2br(htmlspecialchars($comment->comment)); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #666; text-align: center; padding: 1rem;">No comments yet.</p>
                <?php endif; ?>
            </div>

            <?php if ($ticket->status): ?>
                <div class="card">
                    <h3>Add Comment</h3>
                    <form method="POST">
                        <input type="hidden" name="action" value="add_comment">
                        <div class="form-group">
                            <label for="username">Your Username</label>
                            <input type="text" name="username" required placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" required placeholder="Add your comment or additional information..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Comment</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="card">
                    <p style="text-align: center; color: #666;">This ticket has been resolved. No new comments can be added.</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html> 