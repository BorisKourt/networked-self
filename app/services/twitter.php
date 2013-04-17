<?php 

$query = "SELECT * FROM twitter ORDER BY id DESC LIMIT 1";
$lastTweetCall = mysql_query($query);
$lastTweet = "";

$num=mysql_numrows($lastTweetCall);
$i=0;
while ($i < $num) {
    $lastTweet = mysql_result($lastTweetCall,$i,"id");
    $i++;
}

$hash_tag = "#wtfOCAD";

$url = 'http://search.twitter.com/search.json?q=' . urlencode($hash_tag) . '&since_id=' . urlencode($lastTweet);
$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
$jaySon = curl_exec ($ch);
curl_close ($ch);

$twelement = json_decode($jaySon, true);
$twelement = $twelement['results'];

$count = count($twelement); //counting the number of status

for($i=0;$i<$count;$i++){

    $ins_id    = $twelement[$i]['id'];
    $ins_text  = sanitize(trim($twelement[$i]['text']));
    $ins_name  = sanitize(trim($twelement[$i]['from_user_name']));
    $ins_time  = strtotime($twelement[$i]['created_at']);
    $ins_link  = trim($twelement[$i]['profile_image_url']);
    $ins_vote  = 0;
    
    $query = "INSERT INTO twitter VALUES ('" . $ins_id . "','" . $ins_text . "','" . $ins_name . "','" . $ins_time . "','" . $ins_link . "','" . $ins_vote . "')";

    mysql_query($query);

}
  


?>