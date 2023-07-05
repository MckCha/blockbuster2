<?php
session_start();
?>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="uft-8">
    <title> Login Page </title>
</head>
<h1> Welcome to the Login Page! </h1>

<h3><a href="blockbuster2.php">Home</a></h3>

<?php

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

$db = get_connection();

?>
<?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): ?>
	<h2> You are not logged in!</h2>
	<br>
    <?php else: ?>
	<h2> You are logged in! </h2>
    <?php
        if ($_SESSION['logged_in'] == true) {
			header("Location: blockbuster2.php");
	    }
    ?>

    <?php endif; ?>

<?php
if (isset($_POST) && !empty($_POST)) {
	$email = htmlspecialchars($_POST['email']);
	$pass = htmlspecialchars($_POST['pass']);

	$stmt = $db->prepare("SELECT * FROM Consumer WHERE email = ? AND pass = ?");
	$stmt->bind_param("ss", $email,$pass);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows == 1) {

		$_SESSION['logged_in'] = true;
	}
	$result->free();
    header("Location: blockbuster2.php");
}
?>
<form method = "POST">
    Email: <input type="email" name="email" />
    <br>
	<br>
    Password: <input type="password" name="pass" />
    <br>
	<br>
    <input type="submit" value="Login" />
</form>