<?php
// MongoDB connection settings
define('MONGODB_HOST', 'localhost');
define('MONGODB_PORT', '27017');
define('MONGODB_DATABASE', 'cs306');
define('MONGODB_COLLECTION', 'tickets');

// Helper function to get MongoDB connection
function getMongoDBConnection() {
    try {
        $manager = new MongoDB\Driver\Manager("mongodb://" . MONGODB_HOST . ":" . MONGODB_PORT);
        return $manager;
    } catch (Exception $e) {
        throw new Exception("MongoDB connection failed: " . $e->getMessage());
    }
}

// Helper function to insert a document
function insertDocument($collection, $document) {
    $manager = getMongoDBConnection();
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($document);
    
    try {
        $manager->executeBulkWrite(MONGODB_DATABASE . '.' . $collection, $bulk);
        return true;
    } catch (MongoDB\Driver\Exception\Exception $e) {
        return false;
    }
}

// Helper function to find documents
function findDocuments($collection, $filter = [], $options = []) {
    $manager = getMongoDBConnection();
    $query = new MongoDB\Driver\Query($filter, $options);
    
    try {
        $cursor = $manager->executeQuery(MONGODB_DATABASE . '.' . $collection, $query);
        return $cursor->toArray();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        return [];
    }
}

// Helper function to update a document
function updateDocument($collection, $filter, $update) {
    $manager = getMongoDBConnection();
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, ['$set' => $update]);
    
    try {
        $manager->executeBulkWrite(MONGODB_DATABASE . '.' . $collection, $bulk);
        return true;
    } catch (MongoDB\Driver\Exception\Exception $e) {
        return false;
    }
}

// Helper function to delete a document
function deleteDocument($collection, $filter) {
    $manager = getMongoDBConnection();
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete($filter);
    
    try {
        $manager->executeBulkWrite(MONGODB_DATABASE . '.' . $collection, $bulk);
        return true;
    } catch (MongoDB\Driver\Exception\Exception $e) {
        return false;
    }
}

function createTicket($username, $message) {
    try {
        $manager = getMongoDBConnection();
        
        $document = [
            'username' => $username,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => true,
            'comments' => []
        ];
        
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($document);
        
        $result = $manager->executeBulkWrite(MONGODB_DATABASE . '.'. MONGODB_COLLECTION, $bulk);
        return $result->getInsertedCount() > 0;
        
    } catch (Exception $e) {
        throw new Exception("Failed to create ticket: " . $e->getMessage());
    }
}

function addComment($ticketId, $comment, $commenter = 'user') {
    try {
        $manager = getMongoDBConnection();
        
        $filter = ['_id' => new MongoDB\BSON\ObjectId($ticketId)];
        $update = [
            '$push' => [
                'comments' => [
                    'comment' => $comment,
                    'commenter' => $commenter,
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]
        ];
        
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update($filter, $update);
        
        $result = $manager->executeBulkWrite(MONGODB_DATABASE . '.'. MONGODB_COLLECTION, $bulk);
        return $result->getModifiedCount() > 0;
        
    } catch (Exception $e) {
        throw new Exception("Failed to add comment: " . $e->getMessage());
    }
}

function resolveTicket($ticketId) {
    try {
        $manager = getMongoDBConnection();
        
        $filter = ['_id' => new MongoDB\BSON\ObjectId($ticketId)];
        $update = ['$set' => ['status' => false]];
        
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update($filter, $update);
        
        $result = $manager->executeBulkWrite(MONGODB_DATABASE . '.'. MONGODB_COLLECTION, $bulk);
        return $result->getModifiedCount() > 0;
        
    } catch (Exception $e) {
        throw new Exception("Failed to resolve ticket: " . $e->getMessage());
    }
}
?> 