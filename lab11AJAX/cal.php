<?php
	$mango = $_GET["mango"];
	$som = $_GET["som"];
    $banana = $_GET["banana"];
	echo "<b>ยอดขาย</b>";
	echo $mango*30 + $som*70 + $banana*30;
    echo "<b>บาท</b>"; 
?>