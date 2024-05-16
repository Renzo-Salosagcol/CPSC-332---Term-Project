<?php
require 'db-connect.php';

if(isset($_POST['CWID']) && (!empty($_POST['CWID']))){

    // Get SSN from POST data
    $CWID = $_POST['CWID'];

    // If SSN is equal to or less than zero, return.
    if($CWID <= 0) {
        echo "<p>Query Result:</p>";
        echo "<p>Please enter a valid CWID.</p>";
        return;
    }

    // Get class titles, rooms, meeting days, start/end time, an courses associated with professor.
    $sql = "SELECT 
                c.Title AS CourseTitle,
                s.SectionNumber,
                er.Grade
            FROM 
                ENROLLMENT_RECORDS er
            JOIN 
                SECTIONS s ON er.SectionNumber = s.SectionNumber
            JOIN 
                COURSES c ON s.CourseNumber = c.CourseNumber
            WHERE 
                er.CWID = $CWID";

    // Perform the query and return result
    $result = performQuery($sql);

    if ($result->num_rows > 0) {
        echo "<p>Query Result:</p>";
        echo "<table>";
        echo "<tr><th>Course Title</th><th>Section Number</th><th>Grade</th></tr>";

        while($row = $result->fetch_assoc()) {
            $courseTitle = htmlspecialchars($row["CourseTitle"]);
            $sectionNumber = htmlspecialchars($row["SectionNumber"]);
            $grade = htmlspecialchars($row["Grade"]);

            echo "<tr>";
            echo "<td>$courseTitle</td>";
            echo "<td>$sectionNumber</td>";
            echo "<td>$grade</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>This student is not enrolled in any courses.</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Please enter a valid CWID.</p>";
}
?>
