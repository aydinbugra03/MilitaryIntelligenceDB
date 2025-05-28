<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../config/mongodb.php';

$message = '';
$tickets = [];
$selected_user = '';

try {
    $manager = getMongoDBConnection();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        
        if ($action === 'filter_user') {
            $selected_user = $_POST['username'];
            
            // Get tickets for selected user
            $filter = ['username' => $selected_user, 'status' => true];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $manager->executeQuery('support_system.tickets', $query);
            $tickets = $cursor->toArray();
        }
    }
    
    // Get all users who have active tickets
    $pipeline = [
        ['$match' => ['status' => true]],
        ['$group' => ['_id' => '$username']],
        ['$sort' => ['_id' => 1]]
    ];
    $command = new MongoDB\Driver\Command([
        'aggregate' => 'tickets',
        'pipeline' => $pipeline,
        'cursor' => new stdClass,
    ]);
    $cursor = $manager->executeCommand('support_system', $command);
    $users_with_tickets = $cursor->toArray();
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background-color: #9b59b6; color: white; padding: 2rem; text-align: center; border-radius: 10px; margin-bottom: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold; }
        select, input { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; margin: 0.5rem; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #9b59b6; color: white; }
        .btn-success { background-color: #27ae60; color: white; }
        .message { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .back-link { display: inline-block; margin-bottom: 2rem; padding: 0.75rem 1.5rem; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 4px; }
        .ticket-item { border: 1px solid #ddd; padding: 1rem; margin: 0.5rem 0; border-radius: 4px; background-color: #f8f9fa; }
        .ticket-meta { font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; }
        .no-tickets { text-align: center; color: #666; padding: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <a href="../user/" class="back-link">← Back to Dashboard</a>
        
        <div class="header">
            <h1>🎫 Support Ticket System</h1>
            <p>Create and manage your support tickets</p>
        </div>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') === 0 ? 'error' : 'success'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>Select User</h3>
            <?php if (empty($users_with_tickets)): ?>
                <div class="no-tickets">
                    <p>No active tickets found in the system.</p>
                    <a href="create.php" class="btn btn-success">Create New Ticket</a>
                </div>
            <?php else: ?>
                <form method="POST">
                    <input type="hidden" name="action" value="filter_user">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <select name="username" required>
                            <option value="">Select a username</option>
                            <?php foreach ($users_with_tickets as $user): ?>
                                <option value="<?php echo htmlspecialchars($user->_id); ?>" 
                                        <?php echo $selected_user === $user->_id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user->_id); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">View Tickets</button>
                </form>
                
                <div style="margin-top: 1rem;">
                    <a href="create.php" class="btn btn-success">Create New Ticket</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($tickets)): ?>
            <div class="card">
                <h3>Active Tickets for <?php echo htmlspecialchars($selected_user); ?></h3>
                <?php foreach ($tickets as $ticket): ?>
                    <div class="ticket-item">
                        <div class="ticket-meta">
                            Created: <?php echo htmlspecialchars($ticket->created_at); ?> | 
                            Status: <?php echo $ticket->status ? 'Active' : 'Resolved'; ?>
                        </div>
                        <div>
                            <strong>Message:</strong> <?php echo htmlspecialchars(substr($ticket->message, 0, 100)); ?>
                            <?php if (strlen($ticket->message) > 100): ?>...<?php endif; ?>
                        </div>
                        <div style="margin-top: 0.5rem;">
                            <a href="detail.php?id=<?php echo $ticket->_id; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html> 