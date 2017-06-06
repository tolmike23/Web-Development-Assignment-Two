<!--file admin.php -->
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
		$search = $_POST['search'];
		date_default_timezone_set("Pacific/Auckland");
		$nowtime = date("H:i:s");
		
		$dateComp = date('H:i:s', strtotime('+ 120 minute'));
		
		// Set up the SQL command to add the data into the table
		// 
		$query = "select * from Cabs where status = '$search' AND time BETWEEN '$nowtime' AND '$dateComp'";
		// $query = "select * from Cabs where status = '$search' AND time >= (NOW() + INTERVAL 3 HOUR)";
		// executes the query
		$result = mysqli_query($conn, $query);
		//check row result
		$numberOfRows = mysqli_num_rows($result);
		//checks if the execution was successful
		if(!$result) {
			//If query was unsuccessful.
			echo "<p>Something is wrong with ",	$query, "</p>";
		}
		else if($numberOfRows === 0){
			echo "<p>No Match found</p>";
			$echNowTime = date('h:i:a', strtotime($nowtime));
			$echNowTime2 = date('h:i:a', strtotime($dateComp));
			echo "Current Time: $echNowTime And Time in 2hours: $echNowTime2";
			echo "<br>";
			echo "There is no booking time within 2hours maybe check later";
		}
		else
		{	//send result to the cliend side booking.html
			// Display the retrieved records in table
			echo "<table border=\"1\">";
			echo "<tr>\n"
				 ."<th scope=\"col\">Booking Reference #</th>\n"
			     ."<th scope=\"col\">Customer Name</th>\n"
				 ."<th scope=\"col\">Contact Phone</th>\n"
				 ."<th scope=\"col\">Pick Up Address</th>\n"
				 ."<th scope=\"col\">Destination Address</th>\n"
				 ."<th scope=\"col\">Pick Up Date</th>\n"
				 ."<th scope=\"col\">Pick Up Time</th>\n"
				 ."</tr>\n";
			while ($row = mysqli_fetch_assoc($result))
			{
				//table data that will populate the table.
				echo "<tr>";
				echo "<td>",$row["bookRef"],"</td>";
				echo "<td>",$row["custName"],"</td>";
				echo "<td>",$row["contact"],"</td>";
				echo "<td>",$row["unit"],",",$row["street"],",",$row["suburb"],",",$row["city"],$row["postcode"],"</td>";
				echo "<td>",$row["destAddress"],"</td>";
				$dateO = $row["date"];
				$echDate = date('d F Y', strtotime($dateO));
				echo "<td>",$echDate,"</td>";
				$timeO = $row["time"];
				$echTime = date('h:i:a', strtotime($timeO));
				echo "<td>",$echTime,"</td>";
				echo "</tr>";
			}
			echo "</table>";
			// Frees up the memory, after using the result pointer
			mysqli_free_result($result);
		}
	// if successful query operation
	// close the database connection	
	mysqli_close($conn);	
	} 
?>