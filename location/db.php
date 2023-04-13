
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Create database --------------------------------------------------------
	$sql = "CREATE DATABASE location_db";

	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully<br>";
	} else {
	    echo "Error creating database: " . mysqli_error($conn) . "<br>";
	}

	$dbname = 'location_db';
	mysqli_select_db ( $conn , $dbname);

	if (!$conn) {
	    die("select db connection failed: " . mysqli_connect_error());
	}

	//create location table -------------------------------------------------------
	$sql = "CREATE TABLE `location_tab` (
	  `locationLatitude` VARCHAR(50) NOT NULL,
	  `locationLongitude` VARCHAR(50) NOT NULL,
	  `ID` INT NOT NULL AUTO_INCREMENT,
	  PRIMARY KEY (`ID`))";

	if(mysqli_query($conn, $sql)){
	    echo "Table location created successfully<br>";
	} else {
	    echo "Error creating location table: " . mysqli_error($conn). "<br>";
	}	
			
	mysqli_close($conn);
?>