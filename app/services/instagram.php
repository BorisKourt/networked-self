<?php 

$query = "SELECT * FROM instagram ORDER BY id DESC LIMIT 1";
$lastInstCall = mysql_query($query);
$lastInst = "";

$num=mysql_numrows($lastInstCall);
$i=0;
while ($i < $num) {
    $lastInst = mysql_result($lastInstCall,$i,"id");
    $i++;
}

$tag = "wtfocad";



$url = 'https://api.instagram.com/v1/tags/' . urlencode($tag) . '/media/recent?access_token=' . $INSTAGRAM_TOKEN . '&min_id=' . $lastInst;

$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
$jaySon = curl_exec ($ch);
curl_close ($ch);

$inselement = json_decode($jaySon, true);

$inselement = $inselement['data'];
$count = count($inselement); //counting the number of status


for($i=0;$i<$count;$i++){

    $ins_id    = $inselement[$i]['id'];
    $ins_image = $inselement[$i]['images']['standard_resolution']['url'];
    $ins_link  = trim($inselement[$i]['link']);
    $ins_user  = sanitize(trim($inselement[$i]['user']['full_name']));
    $ins_date  = $inselement[$i]['created_time'];
    $ins_capt  = sanitize(trim($inselement[$i]['caption']['text']));
    $ins_vote  = 0;
    
    $query = "INSERT INTO instagram VALUES ('" . $ins_id . "','" . $ins_image . "','" . $ins_link . "','" . $ins_user . "','" . $ins_date . "','" . $ins_capt . "','" . $ins_vote . "')";
    print_r($inselement[$i]);
    echo "<br />";
    mysql_query($query);

}

?>