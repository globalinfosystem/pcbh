function checkempty()
{
	var organization = document.getElementById("organization");
	var aname = document.getElementById("aname");
	var fname = document.getElementById("fname");
	var address = document.getElementById("address");
	var email = document.getElementById("email");
	var mobile = document.getElementById("mobile");
	
	if(organization.value=="")
	{
		document.getElementById("organization1").style.display="block";
		organization.focus();
		return false;
	}
	else
	{
		document.getElementById("organization1").style.display="none";
	}
	if(aname.value=="")
	{
		document.getElementById("aname1").style.display="block";
		aname.focus();
		return false;
	}
	else
	{
		document.getElementById("aname1").style.display="none";
	}
	if(fname.value=="")
	{
		document.getElementById("fname1").style.display="block";
		fname.focus();
		return false;
	}
	else
	{
		document.getElementById("fname1").style.display="none";
	}
	if(address.value=="")
	{
		document.getElementById("address1").style.display="block";
		address.focus();
		return false;
	}
	else
	{
		document.getElementById("address1").style.display="none";
	}
	if(email.value=="")
	{
		document.getElementById("email1").style.display="block";
		email.focus();
		return false;
	}
	else
	{
		document.getElementById("email1").style.display="none";
	}
	if(mobile.value=="")
	{
		document.getElementById("mobile1").style.display="block";
		mobile.focus();
		return false;
	}
	else
	{
		document.getElementById("mobile1").style.display="none";
	}

return true;
	
}

function checkemptycase()
{
	var letter_number = document.getElementById("letter_number");
	var date = document.getElementById("casedate");
	var subjectone = document.getElementById("subjectone");
	var subjecttwo = document.getElementById("subjecttwo");
	
	if(letter_number.value=="")
	{
		document.getElementById("letter_number1").style.display="block";
		letter_number.focus();
		return false;
	}
	else
	{
		document.getElementById("letter_number1").style.display="none";
	}
	if(date.value=="")
	{
		document.getElementById("date1").style.display="block";
		date.focus();
		return false;
	}
	else
	{
		document.getElementById("date1").style.display="none";
	}
	if(subjectone.value=="")
	{
		document.getElementById("subjectone1").style.display="block";
		subjectone.focus();
		
		return false;
	}
	else
	{
		document.getElementById("subjectone1").style.display="none";
	}
	if(subjecttwo.value=="")
	{
		
	 document.getElementById("subjecttwo1").style.display="block";
	 subjecttwo.focus();
	  return false;
	}
	else
	{
		document.getElementById("subjecttwo1").style.display="none";
	}
	
	if(fileuploaderror==0)
	{
		$("#fileuploaderrormessage").show();
		return false;
	}	
	

return true;
	
}