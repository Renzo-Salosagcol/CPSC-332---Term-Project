<!DOCTYPE html>
<html>

<head>
  <title>Professor's page</title>
  <link rel="stylesheet" href="./styles/prof-page-styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="prof-body">
  <header>
    <a href="index.php"><button>Back</button></a>
  </header>
  <div>
    <div class="section-1">
      <p>Want a list of titles, classrooms, meeting days, and time of a professor's classes?</p>
      <p>Please input their social security number: <input type="number" id="professor-ssn"></p>
      <button id="ssn-button">Show List</button>
      <script>
        $(document).ready(function () {
          $("#ssn-button").click(function () {
            var ssn = $('#professor-ssn').val();
            $.ajax({
              url: './query/professor.php',
              type: 'POST',
              data: { ssn: ssn },
              success: function (response) {
                console.log("Returned: " + response);
                $(".classes-query").html(response);
              }
            });
          });
        });
      </script>
      <p class="classes-query"></p> 
    </div>
    <div class="section-2">
      <p>Want a count of students and get each distinct grade?</p>
      <p>Please input the following:</p>
      <p>Course Number: <input type="number" id="course-num"></p>
      <p>Section Number: <input type="number" id="section-num"></p>
      <button id="grades-button">Show Results</button>
      <script>
        $(document).ready(function () {
          $("#grades-button").click(function () {
            var courseNum = $('#course-num').val();
            var sectionNum = $('#section-num').val();
            $.ajax({
              url: './query/grades.php',
              type: 'POST',
              data: { CourseNumber: courseNum, SectionNumber: sectionNum },
              success: function (response) {
                console.log("Returned: " + response);
                $(".grades-query").html(response);
              }
            });
          });
        });
      </script>
      <p class="grades-query"></p> 
    </div>
  </div>
</body>

</html>