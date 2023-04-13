
<?php
error_reporting(0);
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'location_db';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);


	if (isset($_POST["submit_address"]))
	{
		$address = $_POST["address"];
		$address = str_replace(" ", "+", $address);
		?>

		<iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>

		<?php
	}
?>
<form method="POST">
<p>
    <input type="text" name="address" placeholder="Enter address">
</p>

<input type="submit" name="submit_address">
</form>
