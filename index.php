<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Dogdemy: Welcome! Woof!</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="shortcut icon" href="favicon.png" />
	</head>
	<body>

		<header>
			<h1>Welcome to Dogdemy!</h1>
			<nav>
				
			</nav>
		</header>
		<main>
			<article>

			<?php
$servername = "localhost";
$username = "silf";
$password = "woof";
$dbname = "jojemdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, word FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Word: " . $row["word"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 

			</article>
			<aside>
				
			</aside>

		</main>
		<footer>
		&copy; <?php echo date('Y');?> Dogdemy Local
		</footer>

	</body>
</html>