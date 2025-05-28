<?php
require_once '../config/mysql.php';

// Arrays of triggers & procedures (file paths & descriptions)
$triggers = [
    1 => ['name' => 'Drone Operator Assignment Validation', 'path' => '../triggers/trigger_1/index.php', 'member' => 'Buğra Aydın', 'desc' => 'Prevents a drone from being assigned to more than one operator and verifies the chosen operator holds the required licence.'],
    2 => ['name' => 'Intelligence Report Update Logging',     'path' => '../triggers/trigger_2/index.php', 'member' => 'Toprak Aktepe', 'desc' => 'Copies the old and new content of an intelligence report into the report_audit table every time the report is edited.'],
    3 => ['name' => 'Vehicle Status Management',                'path' => '../triggers/trigger_3/index.php', 'member' => 'Görkem Subaşı', 'desc' => 'Switches a vehicle\'s status between Available, Reserved and Maintenance automatically when reservations or returns occur.'],
    4 => ['name' => 'Supply Inventory Management',              'path' => '../triggers/trigger_4/index.php', 'member' => 'Bora Çelikörs', 'desc' => 'Decreases stock on issue, restores it on cancellation, and blocks transactions that would drive inventory below zero.'],
    5 => ['name' => 'Agent Activity Logging',                   'path' => '../triggers/trigger_5/index.php', 'member' => 'Taylan Irak', 'desc' => 'Writes a timestamped entry to agent_activity_log whenever an agent creates, updates or deletes mission-critical data.'],
];

$procedures = [
    1 => ['name' => 'AssignOperatorToDrone', 'path' => '../procedures/procedure_1.php', 'member' => 'Buğra Aydın', 'desc' => 'Creates an operator-drone assignment after confirming eligibility and marks the drone as Busy.'],
    2 => ['name' => 'GetAgentReports',               'path' => '../procedures/procedure_2.php', 'member' => 'Toprak Aktepe', 'desc' => 'List all reports written by an agent.'],
    3 => ['name' => 'GenerateIntelligenceReport',    'path' => '../procedures/procedure_3.php', 'member' => 'Taylan Irak', 'desc' => 'Generate consolidated intelligence report.'],
    4 => ['name' => 'ReserveVehicle',                'path' => '../procedures/procedure_4.php', 'member' => 'Görkem Subaşı', 'desc' => 'Update vehicle status via reservation.'],
    5 => ['name' => 'OrderSupply',                   'path' => '../procedures/procedure_5.php', 'member' => 'Bora Çelikörs', 'desc' => 'Create supply order and update quantities.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Homepage</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f5f7fa; }
        h1 { color: #2c3e50; }
        .section { margin-bottom: 40px; }
        .card { background: #fff; border-radius: 8px; padding: 20px; margin: 10px 0; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        .card a { text-decoration: none; color: #3498db; font-weight: bold; }
        .desc { font-size: 0.85rem; color: #34495e; margin-top:4px; }
        .member { font-size: 0.9rem; color: #7f8c8d; }
        .nav { margin-top: 30px; }
        .nav a { display: inline-block; margin-right: 15px; padding: 10px 20px; background: #3498db; color: #fff; border-radius: 4px; text-decoration: none; }
        .nav a:hover { background: #2980b9; }
    </style>
</head>
<body>
    <h1>👤 User Dashboard</h1>

    <div class="section">
        <h2>🎯 Triggers</h2>
        <?php foreach ($triggers as $no => $t): ?>
            <div class="card">
                <a href="<?php echo $t['path']; ?>">Trigger <?php echo $no; ?> — <?php echo htmlspecialchars($t['name']); ?></a>
                <div class="member">Responsible: <?php echo htmlspecialchars($t['member']); ?></div>
                <div class="desc"><?php echo htmlspecialchars($t['desc']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="section">
        <h2>⚙️ Stored Procedures</h2>
        <?php foreach ($procedures as $no => $p): ?>
            <div class="card">
                <a href="<?php echo $p['path']; ?>">Procedure <?php echo $no; ?> — <?php echo htmlspecialchars($p['name']); ?></a>
                <div class="member">Responsible: <?php echo htmlspecialchars($p['member']); ?></div>
                <div class="desc"><?php echo htmlspecialchars($p['desc']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="nav">
        <a href="support.php">💬 Support Tickets</a>
        <a href="../admin/" style="background:#e67e22;">🔧 Admin Panel</a>
    </div>
</body>
</html> 