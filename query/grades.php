<?php
if(isset($_POST['CourseNumber']) && isset($_POST['SectionNumber']) && (!empty($_POST['CourseNumber'])) && (!empty($_POST['SectionNumber']) )){

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

    // THIS MIGHT NOT WORK, NEEDS TO BE CHECKED WITH DATA!
    $sql = "SELECT
                Grade,
                COUNT(*) AS Count
            FROM (
                SELECT
                    CASE
                        WHEN Grade >= 90 THEN 'A'
                        WHEN Grade >= 80 THEN 'B'
                        WHEN Grade >= 70 THEN 'C'
                        WHEN Grade >= 60 THEN 'D'
                        ELSE 'F'
                    END AS Grade
                FROM ENROLLMENT_RECORDS
                WHERE CourseNumber = " . $courseNum . "
                AND SectionNumber = " . $sectionNum . "
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