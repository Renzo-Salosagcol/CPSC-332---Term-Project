<!DOCTYPE html>
<html>
  <head>
    <title>Student's page</title>
    <link rel="stylesheet" href="./styles/student-page-styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body class="student-body">
    <header>
      <a href="index.php"><button>Back</button></a>
    </header>
    <div>
      <div class="section-1">
        <p>Want the sections of the course, including the classrooms, the
            meeting days and time, and the number of students enrolled in each section?</p>
        <p>Please input the course number: <input type="number" id="course-num"></p>
        <button id="courses-button">Show List</button>
        <script>
          $(document).ready(function () {
            $("#courses-button").click(function () {
              var courseNum = $('#course-num').val();
              $.ajax({
                url: './query/courses.php',
                type: 'POST',
                data: { CourseNumber: courseNum },
                success: function (response) {
                  console.log("Returned: " + response);
                  $(".courses-query").html(response);
                }
              });
            });
          });
        </script>
        <p class="courses-query"></p> 
      </div>
      <div class="section-2">
        <p>Grade and Course lookup: </p>
        <p>Please input the following:</p>
        <p>Student CWID: <input type="number" id="cwid-input"></p>
        <button id="grade-lookup">Show Results</button>
        <script>
          $(document).ready(function () {
            $("#grade-lookup").click(function () {
              var cwid = $('#cwid-input').val();
              $.ajax({
                url: './query/studentgrade.php',
                type: 'POST',
                data: { CWID: cwid },
                success: function (response) {
                  console.log("Returned: " + response);
                  $(".grade-query").html(response);
                }
              });
            });
          });
        </script>
        <p class="grade-query"></p> 
      </div>
    </div>
  </body>
</html>
