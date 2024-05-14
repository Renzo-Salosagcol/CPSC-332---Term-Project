<?php
require 'db-connect.php';

if(isset($_POST['ssn']) && (!empty($_POST['ssn']))){

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
    s.EndTime,
    s.ProfessorSSN
    FROM SECTIONS s
    JOIN COURSES c ON s.CourseNumber = c.CourseNumber
    WHERE s.ProfessorSSN = '$ssn'";

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
