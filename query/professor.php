<?php
if(isset($_POST['ssn'])){

    // Database connection function
    function connectDB() {
        $servername = "mariadb";
        $username = "cs332e3";
        $password = "BUDGPa9a";
        $dbname = "cs332e3";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Query function
    function performQuery($sql) {
        $conn = connectDB();

        // Perform query
        $result = $conn->query($sql);

        // Check for errors
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Close connection
        $conn->close();

        return $result;
    }

    // Get SSN from POST data
    $ssn = $_POST['ssn'];

    // Your SQL query
    $sql = "SELECT c.Title AS CourseTitle,
    s.Classroom,
    s.MeetingDays,
    s.StartTime,
    s.EndTime
    FROM SECTIONS s
    JOIN COURSES c ON s.CourseNumber = c.CourseNumber
    WHERE s.ProfessorSSN = " . $ssn;

    // Perform the query
    $result = performQuery($sql);

    // Display the SQL query result
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<p>SQL Query:</p>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>Title: " . $row["title"]. " - Classroom: " . $row["classroom"]. " - Meeting Day: " . $row["meeting_day"]. " - Time: " . $row["time"]. "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No classes found for the professor's SSN.</p>";
    }
}
?>
