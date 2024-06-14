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
    $missionName = $_POST['missionName'];
    $missionName = mysqli_real_escape_string($conn, $missionName);

    // Query to search for rovers by Mission Name
    $query = "SELECT mm.Name AS MissionName, r.Name AS RoverName, r.Status, r.LandingSite
              FROM MarsMissions mm
              JOIN Rovers r ON mm.MissionID = r.MissionID
              WHERE mm.Name = '$missionName'";

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

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        printf("Mission Name: %s, Rover Name: %s, Status: %s, Landing Site: %s<br>", 
               $row['MissionName'], $row['RoverName'], $row['Status'], $row['LandingSite']);
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <p>
    <hr>
    <p>
</body>
</html>
