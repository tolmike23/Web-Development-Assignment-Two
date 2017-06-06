//file booking.js
//Author: John Barraca
//Project: Assignment2
var xhr = createRequest();
function getData(dataSource, divID) 
{	
	//input field data from the form.
	var assign = document.getElementById("assign").value;	
	var search = document.getElementById("search").value;
	//check the type of browser and it will create and xhr request.
	if(xhr) 
	{	
		// var time = new Date('H:i:s');
		var obj = document.getElementById(divID);
		var requestbody ="assign="+encodeURIComponent(assign)+ "&search="+encodeURIComponent(search);

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
	xhr.send(requestbody);		
	// end if
	} 
 // end function getData() 
}