<?php
require_once '../config/mongodb.php';
$message = '';
$tickets = [];

try {
    $manager = getMongoDBConnection();
    // Get all active tickets
    $filter = ['status' => true];
    $options = ['sort' => ['created_at' => -1]];
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery(MONGODB_DATABASE . '.' . MONGODB_COLLECTION, $query);
    $tickets = $cursor->toArray();
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f5f7fa; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; background:#fff; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; }
        th { background-color: #34495e; color:white; text-align:left; }
        tr:hover { background-color: #f1f1f1; }
        .nav { margin-bottom:20px; }
        .nav a { display:inline-block; margin-right:15px; padding:10px 20px; background:#3498db; color:#fff; text-decoration:none; border-radius:4px; }
        .nav a:hover { background:#2980b9; }
        .message { padding:10px; background:#e0e0e0; margin-bottom:20px; }
    </style>
</head>
<body>
    <h1>🔧 Admin Panel</h1>

    <div class="nav">
        <a href="../user/">👤 User Dashboard</a>
    </div>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Active Support Tickets</h2>
    <?php if (empty($tickets)): ?>
        <p>No active tickets.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Created At</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $t): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($t->username); ?></td>
                        <td><?php echo htmlspecialchars($t->created_at); ?></td>
                        <td><?php 
                            $preview = (strlen($t->message) > 50) ? substr($t->message, 0, 47) . '...' : $t->message;
                            echo htmlspecialchars($preview);
                        ?></td>
                        <td>Active</td>
                        <td><a href="ticket_detail.php?id=<?php echo (string)$t->_id; ?>">View Details</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html> 