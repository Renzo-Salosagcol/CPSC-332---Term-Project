<!DOCTYPE html>
<html>
  <head>
    <title>Student's page</title>
    <link rel="stylesheet" href="./styles/student-page-styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body class="student-body" style="
    background-color: rgb(0, 109, 192);
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
        background-color: rgb(253, 102, 42);
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
        background-color: #F27830;
        margin-top: 20%;
        font-weight: bold;
        padding: 10px 20px;
        margin: 15%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      ">
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
      <div class="section-2" style="
        background-color: rgb(218, 71, 241);
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
        background-color: #549D9D;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        padding: 10px 20px;
        margin: 15%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      ">
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
