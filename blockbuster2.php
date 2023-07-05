<?php
session_start();
?>

<html> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>blockbuster2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>BLOCKBUSTER 2</h1>


<h3>
<?php if($_SESSION['logged_in'] == true) : ?>
        <a href="reviews.php">Reviews</a>
        <a href="logout.php">Logout</a>
<?php else : ?>
        <a href="signup.php">Signup</a>
        <a href="login.php">Login</a>
        <a href="reviews.php">Reviews</a>
<?php endif; ?>
</h3>

<h4>
    Platforms
    <br>
    <a href="https://www.amazon.com">Amazon</a>
    <a href="https://www.disneyplus.com">Disney Plus</a>
    <a href="https://www.hbomax.com">HBO Max</a>
    <a href="https://www.hulu.com">Hulu</a>
    <a href="https://www.netflix.com">Netflix</a>
    <a href="https://www.paramountplus.com">Paramount Plus</a>
    <a href="https://www.peacocktv.com">Peacock TV</a>
</h4>

<?php

$db = get_connection();

function get_connection() {
    static $connection;
    
    if (!isset($connection)) {
        // Connect to the database
        $connection = mysqli_connect('localhost', 'blockbuster2', 
            'Quq3$Biylq','blockbuster2') 
            or die(mysqli_connect_error());
    }
    if ($connection === false) {
        echo "Unable to connect to database<br/>";
        echo mysqli_connect_error();
    }
  
    return $connection;
}


?>
<hr>
<h2>Critically Acclaimed Movies / TV Shows</h2>

<?php

#require_once "connect.php"

date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("display_errors", 1);

// Get a connection, prepare a query, and execute it

$query = $db->prepare("SELECT name FROM Entertainment WHERE IMDB > 7"); 
$query->execute();

// Getting the results will bring the results from the database into PHP.
// This lets you view each row as an associative array
$result = $query->get_result();
ob_start();
$rows = [];

while ($row = $result->fetch_assoc()) {
    // Do name with each row: add it to an array, render HTML, etc.
    $rows []= $row;

    // This example just iterates over the columns of the rows and builds a string
    $rowtext = "";
    
    foreach($row as $column) {
        $rowtext = $rowtext . "$column ";
    }
        
    
    echo "$rowtext <br>";
    

}

?>

<hr>
<form action="blockbuster2.php" method="POST">
    <br>
    <label>Search by Movie Name: <input type="text" name="something"></label>
    <input type="submit" value="Search">
    <br>
    <label>Search by IMDB Rating: <input type="number" name="imdb" min="1" max="10"></label>
    <input type="submit" value="Search">
    <br>
    <input type="radio" id="amazonid" name="platform" value="https://www.amazon.com">Amazon Video
    <input type="radio" id="disneyid" name="platform" value="https://www.disneyplus.com">Disney+
    <input type="radio" id="hboid" name="platform" value="https://www.hbomax.com">HBO Max
    <input type="radio" id="huluid" name="platform" value="https://www.hulu.com">Hulu
    <input type="radio" id="netflixid" name="platform" value="https://www.netflix.com">Netflix
    <input type="radio" id="paramountid" name="platform" value="https://www.paramountplus.com">Paramount Plus
    <input type="radio" id="peacockid" name="platform" value="https://www.peacocktv.com">Peacock TV
    <input type="submit" value="Search">
</form>

<?php 

    if (isset($_POST) && !empty($_POST)) {

        if (isset($_POST['something']) && !empty($_POST['something']))
        {
            $search = $db->prepare("Call SearchMovie(?)");
            $some = htmlspecialchars($_POST['something']);
            $search->bind_param("s", $some);
            $search->execute();
            $results = $search->get_result();
            while ($row = $results->fetch_assoc()) {
                $rows []= $row;
                // This example just iterates over the columns of the rows and builds a string
                $rowtext = "";

                foreach($row as $column) {
                $rowtext = $rowtext . "$column";
                }

                echo "$rowtext <br>";
            }
        }

        if (isset($_POST['imdb']) && !empty($_POST['imdb']))
        {
            $search = $db->prepare("Call SearchIMDB(?)");
            $IMDB = htmlspecialchars($_POST['imdb']);
            $search->bind_param("i", $IMDB);
            $search->execute();
            $results = $search->get_result();

            while ($row = $results->fetch_assoc()) {
                $rows []= $row;
                $rowtext = "";
                
                foreach($row as $column) {
                    $rowtext = $rowtext . "$column ";
                }

                echo "$rowtext <br>";
            }
        
        }

        if (isset($_POST['platform']) && !empty($_POST['platform']))
        {
            $search = $db->prepare("Call SearchPlatform(?)");
            $platform = htmlspecialchars($_POST['platform']);
            $search->bind_param("s", $platform);
            $search->execute();
            $results = $search->get_result();

            while ($row = $results->fetch_assoc()) {
                $rows []= $row;
                $rowtext = "";

                foreach($row as $column) {
                    $rowtext = $rowtext . "$column ";
                }

                echo "$rowtext <br>";
            }
        }
    }
?>

</body>



</html>
