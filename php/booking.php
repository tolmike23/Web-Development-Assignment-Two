<!--file booking.php -->
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
		$custName = $_POST['name'];
		$mobileNum = $_POST['mobileNum'];
		$unit = $_POST['unit'];
		$street = $_POST['street'];
		$picksub = $_POST['picksub'];
		$city = $_POST['city'];
		$postcode = $_POST['postcode'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$formatedTime = date('H:i:s', strtotime($time));
		$destSub = $_POST['destSub'];
		$us = $_POST['us'];
		//generate uniqID for booking reference
		$bookingRefernece = uniqid();

		// Set up the SQL command to add the data into the table
		$query = "insert into Cabs"
		."(custName, contact, unit, street, suburb, city, postcode, date, time, destAddress, status, bookRef)"
		. "values"
		."('$custName', '$mobileNum','$unit','$street','$picksub','$city','$postcode', '$date', '$formatedTime', '$destSub', '$us', '$bookingRefernece')";
		// executes the query
		$result = mysqli_query($conn, $query);
		//checks if the execution was successful
		if(!$result) {
			//If execution was successfule due to table doesn't exist it creates a new table.
			$query1 = "CREATE TABLE Cabs ('custName varchar(100) not null', 'contact int(11) not null','unit varchar(100) not null', 'street varchar(100) not null', 'suburb varchar(100) not null', 'city varchar(100) not null','postcode varchar(100) not null', 'date DATE not null', 'time TIME not null', 'destAddress varchar(100) not null', 'status varchar(50) not null', 'bookRef varchar(100) not null','primary key(bookRef)')";
			$result1 = mysqli_query($conn,$query1);
		}
		else
		{	//send result to the cliend side booking.html
			echo "<h4>Thank You!"." <i>$custName</i>". "</h4>";
			echo "Booking reference number: "."<b>$bookingRefernece</b>"."<br>";
			echo "You will be pick on this address: "."<b>$unit, $street, $picksub, $city, $postcode</b>"."<br>";
			$timeFormat = date('h:i A', strtotime($time));
			$echDat = date('l jS \of F Y', strtotime($date));
			echo "Pick up time is: "."<b>$timeFormat</b>"."<br>";
			echo "Pick up date is: "."<b>$echDat</b>";
		}
	//close mysqli connection	
	mysqli_close($conn);	
	} 
?>