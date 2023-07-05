<?php
session_start();
?>

<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="uft-8">
    <title>Reviews</title>
</head>
<h1>Reviews</h1>

<h3>
<?php if($_SESSION['logged_in'] == true) : ?>
        <a href="blockbuster2.php">Home</a>
        <a href="logout.php">Logout</a>
<?php else : ?>
        <a href="blockbuster2.php">Home</a>
        <a href="login.php">Login</a>
<?php endif; ?>
</h3>


<?php

function get_connection() {
    static $connection;
    
    if (!isset($connection)) {
        // Connect to the cmps3420 database using username demo3420, password 3420.
        $connection = mysqli_connect('localhost', 'blockbuster2', 
            'Quq3$Biylq','blockbuster2') 
            or die(mysqli_connect_error());
    }
    if ($connection === false) {
        echo "Unable to connect to database<br/>";
        echo mysqli_connect_error();
    }
	else if ($connection === true) {
		echo "Server connected";
	}
  
    return $connection;
}

    $db = get_connection();

    
?>
<form action="search.php" method="POST">
    Create a Review for Movies <br>
    <label>Movie Name: <input type="text" name="mname"></label>
    <br>
    <label>Score: <input type="number" name="score" min="1" max="10"></label>
    <br>
    <label>Description: <input type="text" name="description"></label>
    <input type="submit" value="Submit">
</form>
