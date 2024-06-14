<?php
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<a href="main.html">Go to the main page</a>

<head>
    <title>Results of the Query</title>
</head>
<body bgcolor="white">
    <hr>
    <?php
    $type = $_POST['type'];
    $type = mysqli_real_escape_string($conn, $type);


    $query = "SELECT Name, Type, Coordinates, Magnitude, ImagePath
              FROM CelestialObjects
              WHERE Type LIKE '%$type%'";
    ?>

    <p>
    The query:
    <p>
    <?php
    print $query;
    ?>

    <hr>
    <p>
    Result of query:
    <p>

    <?php
    $result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));


    echo "<p><strong>Name</strong> | <strong>Type</strong> | <strong>Coordinates</strong></p><hr>";

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        printf("%s   |    %s    |    %s <br><br>", 
               $row['Name'], $row['Type'], $row['Coordinates']);
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <p>
    <hr>
    <p>
</body>
</html>
