<?php

session_start();

	
for ($i=0; $i < 30; $i++) { 
	$rand=random_int(0, 9);
	$rand1=random_int(0, 9);
	$rand2=random_int(0, 9);
	$rand3=random_int(0, 9);
	$rand4=random_int(0, 9);
	$rand5=random_int(0, 9);
	$rand6=random_int(0, 9)."<br>";

	echo $rand5.$rand1.$rand1.$rand3.$rand4.$rand5.$rand6;
	
}