

<script src="moment.min.js"></script>
<script src="moment-timezone-with-data-2010-2020.min.js"></script>

<script>
function getuseroffset()
{
	//Get the current UTC moment
	var qrystring='';
	var myutc=moment.utc(); 
	var myutc_formatted=myutc.format("YYYY-MM-DDTHH:mm:ssZ");
	var n = moment(myutc_formatted);
    
	var user_timezone=moment.tz.guess();
	n.tz(user_timezone).format('ha z');  	

	var offset=Math.abs(new String(n).split('+')[1].substr(0,2));
    
	if(new String(n).indexOf('+')>0)
	qrystring='+'+new String(offset);
	else
	qrystring='-'+new String(offset);

alert(n);

//window.location.href='write.php?offset='+qrystring+'';

	///loaders('utctime.php?offset='+qrystring,1);
    
    
    var api="http://api-pp.beinsports.com/epg_events?broadcastDate%5Bafter%5D=2016-07-20%2021:00:00&broadcastDate%5Bbefore%5D=2016-07-21%2021:00:00&site=4&channel.externalUniqueId=5af88141c704ce4f6515f5d9f85605d9&site.lang=en&itemsperpage=150";
    
}

</script>

<?php

/**
 * @author lolkittens
 * @copyright 2016
 */



?>

<body onload="getuseroffset();">

</body>