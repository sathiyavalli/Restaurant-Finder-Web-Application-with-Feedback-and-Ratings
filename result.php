<?php
echo "<i>Name:</i> <a href='sample.php?city=".$_POST['city']."&restaurant=".$_POST['restaurant']."'>".$_POST['restaurant']."</a><br/>";
echo "<i>Location:</i> ".$_POST['location']."<br/>";
echo "<i>Hours:</i> ".$_POST['timing']."<br/>";
echo "<i>City:</i> ".$_POST['city'];
?>