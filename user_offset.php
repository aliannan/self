
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.0/jquery.scrollTo.min.js"></script>

<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="moment.min.js"></script>
<script src="moment-timezone-with-data-2010-2020.min.js"></script>

<script type="text/javascript">
$.mobile.ajaxEnabled=false;
$.mobile.loading().hide();

function getuseroffset()
{
	//Get the current UTC moment
	var qrystring='';
	var myutc=moment.utc();

	var myutc_formatted=myutc.format("YYYY-MM-DDTHH:mm:00");
        //alert(myutc_formatted);
    //return;
    
	var n1 = moment(myutc_formatted);
	alert(n1);
return;
		//get current user moment from the user settings of mobile without using guess time zone
		var userdate = new Date();
        //alert(userdate);
		var usertime_milliseconds = userdate.getTime();//to get milliseconds
        //alert(usertime_milliseconds);
		var usertime=moment(usertime_milliseconds);
        //alert(usertime);
		var usertime_formatted=usertime.format("YYYY-MM-DDTHH:mm:00");
        alert(usertime_formatted);
		var n2=moment(usertime_formatted);
		alert(n2);
		var duration = moment.duration(n2.diff(n1));
        //alert(duration);
		var hours = Math.round(duration.asHours() * 100) / 100;
		qrystring+=hours;
	
//	loaders('utctime_ar.php?offset='+qrystring,1);
alert(qrystring);
}

</script>
</head>
<body onload="getuseroffset();" leftmargin=0>
<div class="mainloaddiv"  id="loader">
	<div class="mainloadinnerdiv"><img class="loaderimage" src="images/ajax-loader.gif"></div>
</div>
<div id="schedule"></div>
</body>
</html>