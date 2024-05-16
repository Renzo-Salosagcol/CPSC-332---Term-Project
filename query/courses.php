<?php
require 'db-connect.php';

if(isset($_POST['CourseNumber']) && (!empty($_POST['CourseNumber']) )){

    // Get POST data
    $courseNum = $_POST['CourseNumber'];

    // Check if course and section numbers are greater than zero
    if($courseNum <= 0) {
        echo "<p>Query Result:</p>";
        echo "<p>Please enter a valid course number</p>";
        return;
    }

    // Query
    $sql = "SELECT c.Title AS CourseTitle,
                s.SectionNumber,
                s.Classroom,
                s.MeetingDays,
                s.StartTime,
                s.EndTime,
                COUNT(e.CWID) AS NumStudentsEnrolled
            FROM SECTIONS s
            JOIN COURSES c ON s.CourseNumber = c.CourseNumber
            LEFT JOIN ENROLLMENT_RECORDS e ON s.SectionNumber = e.SectionNumber
                                        AND s.CourseNumber = e.CourseNumber
            WHERE s.CourseNumber = $courseNum
            GROUP BY
                c.Title,
                s.SectionNumber,
                s.Classroom,
                s.MeetingDays,
                s.StartTime,
                s.EndTime";

    $result = performQuery($sql);

    if ($result->num_rows > 0) {
        echo "<p>Query Result:</p>";
        echo "<table>";
        echo "<tr><th>Course Title</th><th>Section Number</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th><th>Enrolled</th></tr>";

        while($row = $result->fetch_assoc()) {
            $courseTitle = htmlspecialchars($row["CourseTitle"]);
            $sectionNumber = htmlspecialchars($row["SectionNumber"]);
            $classroom = htmlspecialchars($row["Classroom"]);
            $meetingDays = htmlspecialchars($row["MeetingDays"]);
            $startTime = htmlspecialchars($row["StartTime"]);
            $endTime = htmlspecialchars($row["EndTime"]);
            $enrollCount = htmlspecialchars($row["NumStudentsEnrolled"]);

            echo "<tr>";
            echo "<td>$courseTitle</td>";
            echo "<td>$sectionNumber</td>";
            echo "<td>$classroom</td>";
            echo "<td>$meetingDays</td>";
            echo "<td>$startTime</td>";
            echo "<td>$endTime</td>";
            echo "<td>$enrollCount</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>This course does not exist</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Missing course number!</p>";
}
?>