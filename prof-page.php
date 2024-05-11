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
  <?php
  require_once './query/professor.php';
  ?>
  <div>
    <div class="section-1">
      <p>Want a list of titles, classrooms, meeting days, and time of a professor's classes?</p>
      <p>Please input their social security number: <input type="number"></p>
      <button>Show List</button>
      <script>
        $(document).ready(function () {
          $("button").click(function () {
            var ssn = $("input[type='number']").val();
            $.ajax({
              url: './query/professor.php',
              type: 'POST',
              data: { ssn: ssn },
              success: function (response) {
                console.log("Returned: " + response);
                $(".sql-query").html(response);
              }
            });
          });
        });
      </script>
      <p class="sql-query"></p> 
    </div>
    <div class="section-2">
      <p>Want a count of students and get each distinct grade?</p>
      <p>Please input the following:</p>
      <p>Course Number: <input type="number"></p>
      <p>Section Number: <input type="number"></p>
      <button>Show Results</button>
    </div>
  </div>
</body>

</html>