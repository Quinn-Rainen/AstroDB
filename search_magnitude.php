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
  $min_magnitude = $_POST['min_magnitude'];
  $max_magnitude = $_POST['max_magnitude'];

  $min_magnitude = mysqli_real_escape_string($conn, $min_magnitude);
  $max_magnitude = mysqli_real_escape_string($conn, $max_magnitude);

  // select celestial objects within a specified magnitude range by the user
  $query = "SELECT Name, Type, Coordinates, Magnitude, ImagePath
            FROM CelestialObjects
            WHERE Magnitude BETWEEN $min_magnitude AND $max_magnitude";

  ?>

  <p>The query:</p>
  <?php
  print $query;
  ?>

  <hr>
  <p>Result of query:</p>

  <?php
  $result = mysqli_query($conn, $query)
  or die(mysqli_error($conn));

  echo "<p><strong>Name</strong> | <strong>Type</strong> | <strong>Magnitude</strong></p><hr>";

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        printf("%s | %s | %s | %.2f<br><br>",
                $row['Name'], $row['Type'], $row['Magnitude']);
    }
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>

  <p><hr><p>
</body>
</html>
