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
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["CourseTitle"] . ", Section " . $row["SectionNumber"] . ": " . $row["Classroom"] . " on ". $row["MeetingDays"] . ", " . $row["StartTime"] . " to " . $row["EndTime"] . " (" .$row["NumStudentsEnrolled"] ." are enrolled in this section)</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>This course does not exist</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Missing course number!</p>";
}
?>