<?php
session_start();
?>
<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="uft-8">
    <title>SignUp</title>
</head>



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
	if (isset($_POST['fname']) && !empty($_POST['fname']) &&
		isset($_POST['lname']) && !empty($_POST['lname']) &&
		isset($_POST['dob']) && !empty($_POST['dob']) &&
		isset($_POST['email']) && !empty($_POST['email']) &&
		isset($_POST['pass']) && !empty($_POST['pass'])
	) {
		$result = $db->prepare("Call RegisterConsumer(?,?,?,?,?)");
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $dob = htmlspecialchars($_POST['dob']);
		$email = htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['pass']);
		$result->bind_param("sssss", $fname, $lname, $dob, $email, $pass);
		$result->execute();
        
        if ($result !== false) {
			$_SESSION['logged_in'] = true;
			header("Location: login.php");
		}
	} else {
		print_r('Error: Must fill all parameters');
	}
	// Added
	$db->close();
}
?>

<?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false): ?>
<h1>Sign Up</h1>
<h3><a href="blockbuster2.php">Home</a></h3>
<form method="POST">
    First Name: <input type="text" name="fname" />
	<br/>
	<br>
	Last Name: <input type="text" name="lname" />
	<br />
	<br>
	Date of Birth: <input type="date" name="dob"/>
	<br/>
	<br>
    Email: <input type="email" name="email" />
	<br />
	<br>
	Password: <input type="password" name="pass" />
	<br />
	<br>
	<input type="submit" value="Sign Up" />
</form>
<?php else: ?>
<h1>You're already logged in</h1>
<?php endif; ?>


