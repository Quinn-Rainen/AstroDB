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
    $researcher = $_POST['researcher'];
    $researcher = mysqli_real_escape_string($conn, $researcher);

    // Modified query to include user input
    $query = "SELECT p.Name AS ProjectName, r.Name AS LeadResearcher
              FROM Projects p
              JOIN Researchers r ON p.LeadResearcherID = r.ResearcherID
              WHERE p.Status = 'Active' AND r.Name LIKE '%$researcher%'";

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
        printf("Project Name: %s, Lead Researcher: %s<br>", $row['ProjectName'], $row['LeadResearcher']);
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <p>
    <hr>
    <p>
</body>
</html>
