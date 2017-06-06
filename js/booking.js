//file booking.js
//Author: John Barraca
//Project: Assignment2
var xhr = createRequest();
function getData(dataSource, divID) 
{	
	//input field data from the form.
	var custName = document.getElementById("custName").value;
	var mobileNum = document.getElementById("mobileNum").value;	
	var unit = document.getElementById("address_line_1").value;
	var street = document.getElementById("address_line_2").value;
	var picksub = document.getElementById("pickSuburb").value;	
	var city = document.getElementById("city").value;	
	var postcode = document.getElementById("postcode").value;
	var date = document.getElementById("date").value;	
	var time = document.getElementById("time").value;	
	var destSub = document.getElementById("destSuburb").value;
	//check the type of browser and it will create and xhr request.
	if(xhr) 
	{	
		//regular expression use to handle validation of input from the user
		var regex = /[0-9]/;
		var regexContact = /[0-9]{10}/;
		//validate if the user left name field empty.
		//if so it will alert the user.
		if( custName === '')
		{
			alert('Name field is empty');
		}
		else if( mobileNum === '')
		{
			alert('Mobile Number field is empty');
		}
		//validate if the user include numeric input.
		//if so it will alert the user.
		else if((custName).match(regex))
		{
			alert('Name field is invalid');
		}
		//validate if the user include numeric input.
		//if so it will alert the user.
		else if(!regexContact.test(mobileNum))
		{
			alert('Contact field is invalid');
		}
		//validate if the user left unit/flat field empty.
		//if so it will alert the user.
		else if(unit === '')
		{
			alert('Unit field is empty');
		}
		//validate if the user left unit/ flat field empty.
		//if so it will alert the user.
		else if(street === '')
		{
			alert('Street field is empty');
		}
		//validate if the user left street field empty.
		//if so it will alert the user.
		else if(picksub === '')
		{
			alert('Pick-up Suburb field is empty');
		}
		//validate if the user left city field empty.
		//if so it will alert the user.
		else if(city === '')
		{
			alert('City field is empty');
		}
		//validate if the user left postcode field empty.
		//if so it will alert the user.
		else if(postcode === '')
		{
			alert('Postcode field is empty');
		}
		//validate if the user left date field empty.
		//if so it will alert the user.
		else if(date === '')
		{
			alert('Date field is empty');
		}
		//validate if the user left time field empty.
		//if so it will alert the user.
		else if(time === '')
		{
			alert('Time field is empty');
		}
		//validate if the user left destinationAddress field empty.
		//if so it will alert the user.
		else if(destSub === '')
		{
			alert('Destination Address field is empty');
		}
		else
		{	//variable to be use for storing status booking 
			var us = 'unassign';

			var obj = document.getElementById(divID);
			var requestbody = "name="+encodeURIComponent(custName)+ "&mobileNum="+encodeURIComponent(mobileNum)+ "&unit="+encodeURIComponent(unit)+ "&street="+encodeURIComponent(street)+ "&picksub="+encodeURIComponent(picksub)
			+ "&city="+encodeURIComponent(city)+ "&postcode="+encodeURIComponent(postcode)+ "&date="+encodeURIComponent(date)+ "&time="+encodeURIComponent(time)
			+ "&destSub="+encodeURIComponent(destSub)+ "&us="+encodeURIComponent(us);

			xhr.open("POST", dataSource, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			
			xhr.onreadystatechange = function() 
			{
				alert(xhr.readyState); // to let us see the state of the computation
				if (xhr.readyState == 4 && xhr.status == 200) 
				{
					obj.innerHTML = xhr.responseText;
				}// end if
			} // end anonymous call-back function
		}
		xhr.send(requestbody);		
		// end if
	} 
 // end function getData() 
}