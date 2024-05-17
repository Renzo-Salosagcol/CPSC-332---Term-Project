<!DOCTYPE html>
<html>

<head>
  <title>Professor's page</title>
  <link rel="stylesheet" href="./styles/prof-page-styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="prof-body" style="
  background-color: lightblue;
  margin: 0;
  background-image: url('https://www.fullerton.edu/it/_resources/_resources/fall22zoom_01.png');
  background-repeat:no-repeat;
  background-size: cover;
">
  <header style="
    margin-left: 5px;
    margin-top: 5px;
  ">
    <a href="index.php"><button class="main-button" style="
      position: fixed;
      top: 0;
      font-size: 20px;
      font-family: 'Comic Sans MS';
      padding: 15px 50px;
      border-radius: 30px;
      border-width: 6px;
      border-color: orange;
      color: orange;
      background-color: #0000ff;
      box-shadow: none;
    ">Back  to home</button></a>
  </header>
  <div>
    <div class="section-1" style="
      background-color: lightsalmon;
      margin-top: 20%;
      font-weight: bold;
      padding: 10px 20px;
      margin: 15%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
      border-width:2px;
      border-style:solid;
      border-color:black;
      border-radius: 30px;
      background-color: lightsalmon;
      margin-top: 20%;
      font-weight: bold;
      padding: 10px 20px;
      margin: 15%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    ">
      <p>Want a list of titles, classrooms, meeting days, and time of a professor's classes?</p>
      <p>Please input their social security number: <input type="text" id="professor-ssn"></p>
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
    <div class="section-2" style="
      background-color: lightgreen;
      width: 400px;
      display: block;
      font-weight: bold;
      padding: 10px 20px;
      margin: 15%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
      border-width:2px;
      border-style:solid;
      border-color:black;
      border-radius: 30px;
      background-color: #BDBEBF;
      display: block;
      font-weight: bold;
      padding: 10px 20px;
      margin: 15%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    ">
      <p>Want a count of students and get each distinct grade?</p>
      <p>Please input the following:</p>
      <p>Course Number: <input type="text" id="course-num"></p>
      <p>Section Number: <input type="text" id="section-num"></p>
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