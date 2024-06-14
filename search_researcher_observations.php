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
    $researcher = $_POST['researcher'];
    $researcher = mysqli_real_escape_string($conn, $researcher);

    // Query for observations per researcher
    $query = "SELECT 
                s.Name AS ObjectName, 
                o.Info, 
                o.Location, 
                o.Date, 
                o.Time, 
                o.Observer
              FROM 
                Observations o
                JOIN 
                CelestialObjects s ON o.ObjectID = s.ObjectID
              JOIN 
                Researchers r ON o.Observer = r.Name
              WHERE 
                r.Name LIKE '%$researcher%'";

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
        printf("Celestial Object: %s, Info: %s, Location: %s, Date: %s, Time: %s, Observer: %s<br>", 
               $row['ObjectName'], $row['Info'], $row['Location'], $row['Date'], $row['Time'], $row['Observer']);
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <p>
    <hr>
    <p>
</body>
</html>