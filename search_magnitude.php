<?php
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<a href="main.html">go to the main page</a>

<head>
  <title>Results of the Query</title>
</head>
<body bgcolor="white">
  <hr>
  <?php
  if(isset($_POST['min_magnitude']) && isset($_POST['max_magnitude'])) {
      $min_magnitude = $_POST['min_magnitude'];
      $max_magnitude = $_POST['max_magnitude'];

      $min_magnitude = mysqli_real_escape_string($conn, $min_magnitude);
      $max_magnitude = mysqli_real_escape_string($conn, $max_magnitude);

      // select celestial objects within a specified magnitude range by the user
      $query = "SELECT Name, Type, Coordinates, Magnitude, ImagePath
                FROM CelestialObjects
                WHERE Magnitude BETWEEN $min_magnitude AND $max_magnitude";

      echo "<p>The query:</p>";
      echo "<pre>$query</pre>";

      $result = mysqli_query($conn, $query)
      or die(mysqli_error($conn));

      // Check number of rows returned
      $num_rows = mysqli_num_rows($result);
      echo "<p>Number of results: $num_rows</p>";

      if ($num_rows > 0) {
          echo "<p><strong>Name</strong> | <strong>Type</strong> | <strong>Magnitude</strong></p><hr>";

          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
          {
              printf("%s | %s | %.2f<br><br>",
                     $row['Name'], $row['Type'], $row['Magnitude']);
          }
      } else {
          echo "<p>No results found for the given magnitude range.</p>";
      }

      mysqli_free_result($result);
  } else {
      echo "<p>Magnitude values are not set.</p>";
  }

  mysqli_close($conn);
  ?>

  <p><hr><p>
</body>
</html>
