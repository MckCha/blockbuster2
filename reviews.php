<?php
session_start();
?>

<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="uft-8">
    <title>Reviews</title>
</head>
<h1>Write a Review</h1>

<h3>
<?php if($_SESSION['logged_in'] == true) : ?>
    <a href="blockbuster2.php">Home</a>
    <a href="logout.php">Logout</a>
<?php else : ?>
    <a href="signup.php">Signup</a>
    <a href="login.php">Login</a>
    <a href="blockbuster2.php">Home</a>
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

    if (isset($_POST) && !empty($_POST)) {

        if (isset($_POST['mname']) && !empty($_POST['mname']) && 
            isset($_POST['score']) && !empty($_POST['score']) && 
            isset($_POST['description']) && !empty($_POST['description'])) 
        {
            $convert = $db->prepare("Call ConvertMovieName(?)");
            $some = htmlspecialchars($_POST['mname']);
            $convert->bind_param("s", $some);
            $convert->execute();
            $some = $convert->get_result();
            //$convert2 = $db->prepare("INSERT INTO Reviews(cID, mID, score, description) VALUES($_POST['mname'],$_POST['score'],$_POST['description'])");
            //$score = htmlspecialchars($_POST['score']);
            //$description = htmlspecialchars($_POST['description']);
            //$convert2->bind_param("is", $score, $description);
            //$convert2->execute();

        }
    
        /*if (isset($_POST['score']) && !empty($_POST['score']) && 
            isset($_POST['description']) && !empty($_POST['description']) )
        {
            //$convert2 = $db->prepare("INSERT INTO Reviews(name, mID, score) VALUES($_POST['mname'] AND $_POST['score'] AND $_POST['description'])");
            //$score = htmlspecialchars($_POST['score']);
            //$description = htmlspecialchars($_POST['description']);
            //$convert2->bind_param("is", $score, $description);
            //$convert2->execute();
        }
        */
    }
            




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

<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<canvas id="myChart" style="width:100%;max-width:700px"></canvas>