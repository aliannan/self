<?php

$offset=$_GET["offset"];

$cat=$_GET["cat"];





$link=$_GET["link"];

$real_offset=abs($offset);


$status="true";


//get offset
if (strpos($offset, '-') !== false) 
    $abs="negative";
    else
    $abs="positive";
    
    //echo $offset;
    //exit();
    
    
    //get UTC time
    date_default_timezone_set("UTC");
    $current_utc_time = gmmktime();


$utc_dt = new DateTime();
$utc_string=$utc_dt->format('Y-m-d 00:00:00');
$utchour=$utc_dt->format('H');




$effectiveDate = strtotime("+3 hours", strtotime($utc_string));


if($abs=="negative"){
    //get start date of api url
    $effective_startDate = strtotime("+".$real_offset." hours", strtotime($utc_string));    

  //get end date of api url
    $effective_endDate = strtotime("+24 hours", $effective_startDate);
    $effectiveday_header=strtotime("-".$real_offset." hours", $effective_startDate);

    //current user hour
    $current_user_hour=strtotime("-".$real_offset." hours", $current_utc_time);
    $current_user_hour=date("H", $current_user_hour);

}

if($abs=="positive"){
    //get start date of api url
    $effective_startDate = strtotime("-".$real_offset." hours", strtotime($utc_string));
  //get end date of api url
    $effective_endDate = strtotime("+24 hours", $effective_startDate);   
    //start of day header
    $effectiveday_header=strtotime("+".$real_offset." hours", $effective_startDate);
              
    //current user hour
    $current_user_hour=strtotime("+".$real_offset." hours", $current_utc_time);
    $current_user_hour=date("H", $current_user_hour);

}

//echo "<br>";

//forming the day header

$days="<ul style='margin-left:auto;margin-right:auto;width:500px;text-align:center;'>";
for ($i=0;$i<=6;$i++)
{

    $newstartdate=strtotime("+".($i*24)." hours", $effective_startDate);
    $newenddate=strtotime("+24 hours", $newstartdate);
    
    if($i==0)
    $effectiveday_header=strtotime("+0 hours", $effectiveday_header);
    else
    $effectiveday_header=strtotime("+24 hours", $effectiveday_header);
    if($i==0)
    {
    $days.="<li id=".$i." class=item_selected data-start='".date("Y-m-d H:i:s",$newstartdate)."' data-end='".date("Y-m-d H:i:s",$newenddate)."'>".date("D", $effectiveday_header)."<br>".date("d", $effectiveday_header)."</li>";
    }
    else
    $days.="<li id=".$i." class=item data-start='".date("Y-m-d H:i:s",$newstartdate)."' data-end='".date("Y-m-d H:i:s",$newenddate)."'>".date("D", $effectiveday_header)."<br>".date("d", $effectiveday_header)."</li>";

 }

$days.="</ul>";

//end day header


//time header start

$timer="<ul style='margin-left:auto;margin-right:auto;width:100%;text-align:center;'>";
$index="";
for($x=0;$x<=23;$x++)
{ 
    if($x<10)
    {
        $index="0".$x."";
        if($index==$current_user_hour)
        $timer.="<li id='0".$x."' class=hour_selected  data-start='0".$x."'>0".$x."</li>";
        else
        $timer.="<li id='0".$x."' class=hour  data-start='0".$x."'>0".$x."</li>";
          
    }
    
    else
    {if($x==$current_user_hour)
       $timer.="<li id=".$x." class=hour_selected  data-start=".$x.">".$x."</li>"; 
       else
       $timer.="<li id=".$x." class=hour data-start=".$x.">".$x."</li>";
       
    }
    
    
}
$timer.="</ul>";
//time header end


$ajaxloader="<br><div id=loader style='margin-left:auto;margin-right:auto;text-align:center;'></div>";

$url="";
//start loop for channels

$channels=array("channel_1"=>"5af88141c704ce4f6515f5d9f85605d9","channel_2"=>"cdbc6fa743220b64f3fd7719d5d9999d","channel_3"=>"2cff0d64a70aa55f4ac9cd8d7401cfe1",
"channel_4"=>"af1a4793775f1481c1d64545cb801f2d","channel_5"=>"472a25b4269e4a0d1c9b5f8342ed75ca","channel_6"=>"77689d584faeb94783c2681e5917e0ea",
"channel_7"=>"d5cbd5ea98f193f05b87dd36bccdc718","channel_8"=>"504a4d67afd661fa716d556e091c0860","channel_9"=>"d9588cbedfe3574dadc2f2c770b736f2",
"channel_10"=>"59726d004717c0f1c765a1a3e6dbaff1","channel_11"=>"033e4275d1d27f2e328acaab19a3f5db","channel_12"=>"2e5e17fc828c101beae37967d5006d8a",
"channel_13"=>"aa79c0fab5c22b5be89f37695a29e3ff","channel_14"=>"573e06d0d2f202f540bb37e0a6077c9d","channel_15"=>"20916a41deffa4bf67eb5278f1148484",
"channel_16"=>"2ff60b96078b5eb7b40c0da6e1ea9fab","channel_17"=>"32ad92aafdb7332a117674d20dafa460","channel_18_news"=>"4ba4084a6a1bcf28e33376e3441ab660",
"channel_19_global"=>"0a2ee0bb19fe9b70fad8a3cccc818272","beIN Max 1"=>"d8d38df365b48e87c62a6be35d54a6f3","beIN Max 2"=>"eedb779065bb9964f30a8647bde5914f",
"beIN Max 3"=>"412bf24fa629e8a38dd195a376f9fc8c","beIN Max 4"=>"030fbfcb13fc7bdf7baa136b67dcdf41");

$html.="<div style='border:solid 1px red;width:80%;text-align:center;margin-left:auto;margin-right:auto;height:auto;'>";
$slider_counter=0;
foreach($channels as $key => $val)
{
  $slider_counter++;
  if($link=="true")
{

$start=$_POST["start"];
$end=$_POST["end"];
$api="http://api.beinsports.com/epg_events?broadcastDate[after]=".urlencode($start)."&broadcastDate[before]=".urlencode($end)."&site=4&channel.externalUniqueId=".$val."&site.lang=en&itemsperpage=150&order[broadcastDate]=asc";
}

else
$api="http://api.beinsports.com/epg_events?broadcastDate[after]=".urlencode(date("Y-m-d H:i:s",$effective_startDate))."&broadcastDate[before]=".urlencode(date("Y-m-d H:i:s",$effective_endDate))."&site=4&channel.externalUniqueId=".$val."&site.lang=en&itemsperpage=150&order[broadcastDate]=asc";




$url.=$api."<br><br>";


//get the data
$json = file_get_contents($api);
$obj = json_decode($json,true);
$total=$obj["hydra:member"];


$elementCount  = count($total);


$categories = array( );
$count=1;
//$html="<table width=100%>";


if($elementCount!=0)
    {

$html.="<div id=slider_".$slider_counter." class=slider><ul id=ul_slider_".$slider_counter.">";


if($cat=="true")
{
$sport=$_GET["sport"];
    
    	foreach($obj["hydra:member"] as $event)
	{
	    $title=$event["title"];
		$category=$event["categoryName"];
		$channel=$event["channel"];
		$duration=$event["duration"];
		$starttime=$event["broadcastDate"];
        if($sport==$category)
        {
        $html.="<tr>";	
        $html.="<td>".$title."</td>";
        $html.="<td>".$starttime."</td>";
        $html.="<td>".$sport."</td>";
        $html.="</tr>"; 
        }
                $categories[$count]=$category;
        $count++;
    }
}

else
{
    	foreach($obj["hydra:member"] as $event)
	{
	    $title=$event["title"];
		$category=$event["categoryName"];
		$channel=$event["channel"];
		$duration=$event["duration"];
		$starttime=$event["broadcastDate"];
        $mydate = strtotime($starttime);
        if($abs=="negative")
        {         
            $mystarttime = strtotime("-".$real_offset." hours", $mydate);
        }
        
       
       
       //readng of epg_events
        if($abs=="positive")
        {
            $mystarttime = strtotime("+".$real_offset." hours", $mydate);
        }
        
            $myendtime = strtotime("+".$duration." seconds", $mystarttime);
            $mystarttime_=date("H:i", $mystarttime);
            $myendtime_=date("H:i", $myendtime);            
            $mydatastart=date("H", $mystarttime);
            $mydataend=date("H", $myendtime);
            
            $html.="<li id=slider_".$slider_counter."_item".$count."  data-index=".$count." data-start=".$mydatastart." data-end=".$mydataend.">";
        //$html.="<tr>";	
        $html.="<p>".$title."</p>";
        $html.="<p>".$mystarttime_."----------".$myendtime_."</p>";
        $html.="<p>".$category."</p>";
        $html.="</li>"; 
        	

        $categories[$count]=$category;
        $count++; 
    }
    
    
}
    
    $html.="</ul></div>"; 
    $html.="<div style='background-color:#cccccc;float:left'><img border=0 src=https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMYJuYSoWVlSIAcHMPXYRrfCs_OXoCNnBtMdd6Qs5hXBo3S6P_ width=50 height=50 onclick=next('slider_".$slider_counter."');></div>"; 
    //$html.="</div>"; 
    }
    
    
    
     
}

$html.="</div>";  


    
  //end loop for channels  
    
 $select="<select name='category'>";
 
 for($j=1;$j<=count($categories);$j++)
 {
  $select.="<option value=xxxxxx>".$categories[$j]."</option>";  
 }
   

$select.="</select>";



//select unique items of categories
$array = array_keys(array_flip($categories));

//categories drop down
 $select2="<select id='filter' onchange=getepg('epg.php?link=false&cat=true&offset="  .  $offset   .  "&sport=" . "'+this[this.selectedIndex].value)>";
 for($k=0;$k<=count($array)-1;$k++)
 {
  $select2.="<option value='".($array[$k])."'>".$array[$k]."</option>";  
 }
   

$select2.="</select>";
    
      
    //$output=$days.$timer.$ajaxloader.$html."<br>".count($array)."<br>".$select."<br>".$select2."<h2>".$current_user_hour."</h2>"; 
    $output=$days.$timer.$ajaxloader.$html."<br></h2>";
    //echo $status;   
    echo $output;
?>