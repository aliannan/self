<?php

$users=array();

    $users[0] = 'TelRev';
    $users[1] = 'Skellington';
    $users[2] = 'CapnBlack';
    $users[3] = 'CapnBlack';
    $users[4] = 'TelRev';
    $users[5] = 'wwww';
$result=array_flip($users);
print_r($result);


$sport=$_GET["sport"];
echo $sport;

?>

<html>
<head>
<script>
function getepg(url)
{
    alert(url);
}
</script>
</head>
<body>
    <div class="container-center-center">
        <div class="mrs mls mlr-case">
            <main>
                <h2>TV Guide</h2>
                <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                <script type="text/javascript" src="https://api.beinsports-social.com/js/oembed.js"></script>
                <div id="bein_elem" data-href="https://api.beinsports-social.com/views/epg?region=mena&lang=en" rel="nofollow"></div>
            </main>
        </div>
    </div>
</body>
</html>