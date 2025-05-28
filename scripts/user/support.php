<?php
require_once '../config/mongodb.php';

$message = '';
$users = [];

try {
    $manager = getMongoDBConnection();
    
    // Get users with at least one active ticket
    $query  = new MongoDB\Driver\Query(['status' => true]);
    $cursor = $manager->executeQuery(MONGODB_DATABASE . '.' . MONGODB_COLLECTION, $query);

    // Collect unique usernames
    foreach ($cursor as $doc) {
        if (isset($doc->username)) {
            $users[] = $doc->username;
        }
    }
    $users = array_unique($users);
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $ticket = [
            'username' => $_POST['username'],
            'message' => $_POST['message'],
            'created_at' => date('Y-m-d H:i:s'),
            'status' => true,
            'comments' => []
        ];
        
        $manager = getMongoDBConnection();
        $bulk    = new MongoDB\Driver\BulkWrite;
        $bulk->insert($ticket);
        $manager->executeBulkWrite(MONGODB_DATABASE . '.' . MONGODB_COLLECTION, $bulk);
        
        $message = "Ticket created successfully!";
    } catch (Exception $e) {
        $message = "Error creating ticket: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Support Ticket System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-group { margin: 15px 0; }
        .message { padding: 10px; margin: 10px 0; background: #f0f0f0; }
        select, input, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        textarea { height: 100px; }
    </style>
</head>
<body>
    <h1>Support Ticket System</h1>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Create New Ticket</h2>
    <form method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea name="message" required></textarea>
        </div>
        <button type="submit">Create Ticket</button>
    </form>

    <?php if (!empty($users)): ?>
        <h2>View Existing Tickets</h2>
        <form action="view_tickets.php" method="GET">
            <div class="form-group">
                <label>Select Username:</label>
                <select name="username">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo htmlspecialchars($user); ?>">
                            <?php echo htmlspecialchars($user); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">View Tickets</button>
        </form>
    <?php endif; ?>

    <p><a href="index.php">Back to Homepage</a></p>
</body>
</html> 