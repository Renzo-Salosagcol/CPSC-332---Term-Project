<?php
if(isset($_POST['ssn']) && (!empty($_POST['ssn']))){

    // ======== START FUNCTION DECLARATIONS ========
    // Connects to the database using Matt's credentials
    function connectDB() {
        $servername = "mariadb";
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

    // ======== END FUNCTION DECLARATIONS ========
    // ===========================================
    // ============== SCRIPT  START ==============

    // Get SSN from POST data
    $ssn = $_POST['ssn'];

    // If SSN is equal to or less than zero, return.
    if($ssn <= 0) {
        echo "<p>Query Result:</p>";
        echo "<p>Please enter a valid SSN.</p>";
        return;
    }

    // Get class titles, rooms, meeting days, start/end time, an courses associated with professor.
    $sql = "SELECT c.Title AS CourseTitle,
    s.Classroom,
    s.MeetingDays,
    s.StartTime,
    s.EndTime
    FROM SECTIONS s
    JOIN COURSES c ON s.CourseNumber = c.CourseNumber
    WHERE s.ProfessorSSN = " . $ssn;

    // Perform the query and result result. Return results in an unordered list otherwise, return "no classes found"
    $result = performQuery($sql);

    if ($result->num_rows > 0) {
        echo "<p>Query Result:</p>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>Title: " . $row["CourseTitle"]. " - Classroom: " . $row["Classroom"]. " - Meeting Day: " . $row["MeetingDays"]. " - Time: " . $row["StartTime"]. " - " . $row["EndTime"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No classes found for the professor's SSN.</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Please enter a valid SSN.</p>";
}
?>
