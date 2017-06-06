<!--file adminAssign.php -->
<?php	
	require_once("settings.php");
		
	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
		);

	// Checks if connection is successful
	if (!$conn) {
	echo "<p>Database connection failure</p>";
	}
	else
	{	
		// Get validated data from the uri
		$assign = $_POST['assign'];
		$assignedValue = 'assign';

		// Set up the SQL command to add the data into the table
		$query1 = "update Cabs set status = '$assignedValue' where bookRef = '$assign' ";
		// executes the query
		$result1 = mysqli_query($conn, $query1);
		//checks if the execution was successful
		if(!$result1) {
			//If query was unsuccessful.
			echo "<p>Something is wrong with ",	$query1, "</p>";
		}
		else
		{	
			//send result to the cliend side booking.html
			echo "The booking request $assign has been properly assigned";
		} 
	// if successful query operation
	// close the database connection	
	mysqli_close($conn);	
	} 
?>