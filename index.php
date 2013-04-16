<?php include("app/credentials/db.cred.php");
      include("app/functions.php"); ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>I[ -]This</title>

  <link rel="stylesheet" href="assets/css/normalize.css" /> 
  <link rel="stylesheet" href="assets/css/soda.css" />
  <link rel="stylesheet" href="assets/css/d.css" />
  
  <script src="http://cdnjs.cloudflare.com/ajax/libs/headjs/0.99/head.min.js"></script>
  
  <script type="text/javascript">
  
    head.js(
       {  modern:     "assets/js/modernzr.js"},
       {  jquery:     "http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"},
       {  foundation: "http://cdnjs.cloudflare.com/ajax/libs/foundation/4.0.9/js/foundation.min.js"},
       {  main:       "assets/js/main.js"}
    );
    
  </script>
  
</head>
<body>

<?php 

  $query="(SELECT * FROM twitter ORDER BY time DESC LIMIT 0, 16)";
  $result=mysql_query($query);
  $num=mysql_numrows($result);

  $i=0;
  while ($i < $num) {
      
      $ins_id    = mysql_result($result,$i,"id");
      $ins_text  = mysql_result($result,$i,"text");
      $ins_text  = preg_replace('#@([\\d\\w]+)#', '<a class="radius secondary label" target="blank_" href="http://twitter.com/$1">$0</a>', $ins_text);
      $ins_text  = preg_replace('/#([\\d\\w]+)/', '<a target="blank_" href="http://twitter.com/search?q=%23$1">$0</a>', $ins_text);
      $ins_name  = mysql_result($result,$i,"name");
      $ins_time  = mysql_result($result,$i,"time");
      $ins_link  = mysql_result($result,$i,"link");
      $ins_vote  = mysql_result($result,$i,"vote");
      
      ?>
      
      <?php
      
      $i++;
      
  }

  $query="(SELECT * FROM instagram ORDER BY date DESC LIMIT 0, 16)";
  $result=mysql_query($query);
  $num=mysql_numrows($result);

  $i=0;
  while ($i < $num) {

      $ins_id    = mysql_result($result,$i,"id");
      $ins_image = mysql_result($result,$i,"image");
      $ins_link  = mysql_result($result,$i,"link");
      $ins_user  = mysql_result($result,$i,"user");
      $ins_date  = mysql_result($result,$i,"date");
      $ins_capt  = mysql_result($result,$i,"caption");
      $ins_vote  = mysql_result($result,$i,"vote");

      ?>

      <?php

  $i++;
  }

  mysql_close();

?>

</body>
</html>