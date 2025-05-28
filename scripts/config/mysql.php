<?php
// MySQL connection settings
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '2003');
define('MYSQL_DATABASE', 'military_intelligence');
define('MYSQL_PORT', 3306);

// Helper function to get MySQL PDO connection
function getMySQLConnection() {
    try {
        $dsn = "mysql:host=" . MYSQL_HOST . ";port=" . MYSQL_PORT . ";dbname=" . MYSQL_DATABASE . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
        return $pdo;
        
    } catch (PDOException $e) {
        // Log the full error for debugging
        error_log("MySQL PDO Connection Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")");
        
        // Display a more user-friendly error
        die("MySQL Connection Error: Could not connect to the database. <br>Details: " . 
            htmlspecialchars($e->getMessage()) . 
            " (Code: " . $e->getCode() . "). <br>" .
            "Host: " . MYSQL_HOST . ", User: " . MYSQL_USER . ", DB: " . MYSQL_DATABASE . 
            "<br>Please check if the MySQL server is running and the connection details are correct.");
    }
}
?> 