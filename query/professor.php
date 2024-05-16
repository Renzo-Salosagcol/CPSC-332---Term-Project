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
        echo "<table>";
        echo "<tr><th>Course Title</th><th>Classroom</th><th>Meeting Day</th><th>Start Time</th><th>End Time</th></tr>";

        while($row = $result->fetch_assoc()) {
            $courseTitle = htmlspecialchars($row["CourseTitle"]);
            $classroom = htmlspecialchars($row["Classroom"]);
            $meetingDays = htmlspecialchars($row["MeetingDays"]);
            $startTime = htmlspecialchars($row["StartTime"]);
            $endTime = htmlspecialchars($row["EndTime"]);

            echo "<tr>";
            echo "<td>$courseTitle</td>";
            echo "<td>$classroom</td>";
            echo "<td>$meetingDays</td>";
            echo "<td>$startTime</td>";
            echo "<td>$endTime</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No classes found for the professor's SSN.</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Please enter a valid SSN.</p>";
}
?>
