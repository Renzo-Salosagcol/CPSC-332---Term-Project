<?php
require 'db-connect.php';

if(isset($_POST['CourseNumber']) && isset($_POST['SectionNumber']) && (!empty($_POST['CourseNumber'])) && (!empty($_POST['SectionNumber']) )){

    // Get POST data
    $courseNum = $_POST['CourseNumber'];
    $sectionNum = $_POST['SectionNumber'];

    // Check if course and section numbers are greater than zero
    if($courseNum <= 0) {
        echo "<p>Query Result:</p>";
        echo "<p>Please enter a valid course number</p>";
        return;
    } else if($sectionNum <= 0) {
        echo "<p>Query Result:</p>";
        echo "<p>Please enter a valid section number</p>";
        return;
    }

    // Query
    $sql = "SELECT
                Grade,
                COUNT(*) AS Count
            FROM (
                SELECT
                    CASE
                        WHEN Grade >= 97 THEN 'A+'
                        WHEN Grade >= 93 THEN 'A'
                        WHEN Grade >= 90 THEN 'A-'
                        WHEN Grade >= 87 THEN 'B+'
                        WHEN Grade >= 83 THEN 'B'
                        WHEN Grade >= 80 THEN 'B-'
                        WHEN Grade >= 77 THEN 'C+'
                        WHEN Grade >= 73 THEN 'C'
                        WHEN Grade >= 70 THEN 'C-'
                        WHEN Grade >= 67 THEN 'D+'
                        WHEN Grade >= 63 THEN 'D'
                        WHEN Grade >= 60 THEN 'D-'
                        ELSE 'F'
                    END AS Grade
                FROM ENROLLMENT_RECORDS
                WHERE CourseNumber = $courseNum
                AND SectionNumber = $sectionNum
            ) AS GradeGroups
            GROUP BY Grade
            ORDER BY FIELD(Grade, 'A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F')";

    $result = performQuery($sql);

    if ($result->num_rows > 0) {
        echo "<p>Query Result:</p>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["Grade"] . ": " . $row["Count"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>This course and/or section number does not exist</p>";
    }
} else {
    echo "<p>Query Result:</p>";
    echo "<p>Missing course number and/or section number!</p>";
}
?>