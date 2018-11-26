<html>
<head>
<title>Untitled</title>
<script>

</script>
    <link rel="shortcut icon" href="//assets.beinsports.com/2.6.13/images/favicon.ico" />
    <script src="http://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="moment.min.js"></script>
<script src="moment-timezone-with-data-2010-2020.min.js"></script>
<style>
body{margin:0px;padding:0px;overflow-x: hidden;}
.item{display:inline-block;padding-left:5px;padding-right:5px;font-size:14pt;font-weight:bold;cursor: pointer;text-align:center;}
.item_selected{display:inline-block;padding-left:5px;padding-right:5px;font-size:14pt;font-weight:bold;cursor: pointer;text-align:center;background-color: black;color:#ffffff}
.hour{display:inline-block;padding-left:5px;padding-right:5px;font-size:11pt;font-weight:bold;cursor: pointer;text-align:center;}
.hour_selected{display:inline-block;padding-left:2px;padding-right:2px;font-size:11pt;font-weight:bold;cursor: pointer;text-align:center;background-color: black;color:#ffffff}

.slider{overflow:hidden;width:800px;height:140px;background-color:#fbfbfd;margin-left:auto;margin-right:auto;float:left}
.slider ul{width:10000px;height:140px}
.slider ul li{float:left;list-style:none;width:372px;height:140px;font-size: 18pt;}

</style>

<script>
var myvar='';
var qrystring='';

    $(document).on('click', '.item', function(){

var start=$(this).attr("data-start");
var end=$(this).attr("data-end");
var selected=$(this).attr("id");


$("#loader").html("<img src='http://gnuine.biz/epg/images/ajax-loader.gif' >");

    $.ajax({
        type: "POST",
        url: "epg.php?link=true&cat=false&offset="+qrystring+"",
        data: ({start: start,end: end}),
        success: function(response)
        {
            //alert(url);
            //alert(response);
            document.getElementById("test").innerHTML="<h2>"+ response +"</h2>";
                for(i=0;i<=6;i++)
               {
                 $("#"+i+"").attr('class', 'item'); 
               }
        $("#"+selected+"").attr('class', 'item_selected');
        
        setIframeHeight();
        
        }
        
    });

    });
    
    
$(document).on('click', '.hour', function()
{
var start=$(this).attr("data-start");
var selected=$(this).attr("id");
alert(start);

for(i=1;i<=4;i++)
{
    
}



    });
    
    

    function getuseroffset()
{
	//Get the current UTC moment
	
	var myutc=moment.utc(); 
	var myutc_formatted=myutc.format("YYYY-MM-DDTHH:mm:ssZ");
	var n = moment(myutc_formatted);
    
	var user_timezone=moment.tz.guess();
	n.tz(user_timezone).format('ha z');  	

	var offset=Math.abs(new String(n).split('+')[1].substr(0,2));
    
	if(new String(n).indexOf('+')>0)
	qrystring=new String(offset);
	else
	qrystring='-'+new String(offset);
getepg('epg.php?link=false&&cat=false&offset='+qrystring);    
}
        
   function getepg(url)
   {
    //alert(url);
    $("#test").html("<img src='http://gnuine.biz/epg/images/ajax-loader.gif' >");
    
            $.ajax({
        type: "POST",
        url: url,
        //data: ({start: start,end: end}),
        success: function(response)
        {
            //document.getElementById("test").innerHTML="<h2>"+ response +"</h2>";
            
            $('#test').append(response);
            
            
            var dif = document.documentElement.scrollHeight - document.documentElement.clientHeight;
//alert(document.documentElement.clientHeight);

var height = dif + document.documentElement.scrollHeight +"px";

setIframeHeight();

//alert(document.body.scrollHeight);
        }            
    });

   }
    
    function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}


function setIframeHeight() {
    var ifrm = window.parent.document.getElementById("myframe");
    
    //alert(ifrm);
  
    var doc = ifrm.contentDocument? ifrm.contentDocument: 
        ifrm.contentWindow.document;
    ifrm.style.visibility = 'hidden';
    ifrm.style.height = "10px";
    ifrm.style.height = getDocHeight( doc ) + 50 + "px";
    ifrm.style.visibility = 'visible';
    
    alert(ifrm.style.height);
}

function getDocHeight(doc) {
    doc = doc || document;
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, 
        html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}

    
</script>
</head>

<body onload="getuseroffset();">

<div id=test ></div>
</body>
</html>
