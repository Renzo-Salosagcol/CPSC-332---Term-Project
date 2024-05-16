<?php
function connectDB() {
    $servername = "localhost";
    $username = "cs332e3";
    $password = "BUDGPa9a";
    $dbname = "cs332e3";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// A function that opens the database, performs a query given, and closes.
// Returns a result or an error.
function performQuery($sql) {
    $conn = connectDB();

    $result = $conn->query($sql);
    
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $conn->close();

    return $result;
}
?>